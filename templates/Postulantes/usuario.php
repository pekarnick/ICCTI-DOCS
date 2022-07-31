<?php
$docnombre = [];
$docfaltantes = [];
foreach ($tipos as $tipo) {
    $docnombre[$tipo->nombre] = $tipo->nombre;
    if ($tipo->obligatorio == 'SI') {
        foreach ($proyectos as $proyec) {
            $esta = false;
            foreach ($proyec->documentos as $docenviados) {
                if ($tipo->nombre == $docenviados['nombre']) {
                    $esta = true;
                }
            }
            if (!$esta) {
                $docfaltantes[$proyec->id . "-" . $proyec->razon_social][] = $tipo->nombre;
            }
        }
    }
}
$testados = [
    "" => 'Abierto',
    0 => 'Abierto',
    1 => 'Cerrado'
]
?>
<div class="row">

</div>
<div>&nbsp;</div>
<div class="row">
    <div class="column-responsive column-34">
        <div class="documentos form content">
            <?= $this->Form->create($documento, ['enctype' => 'multipart/form-data']) ?>
            <fieldset>
                <legend>Enviar documento</legend>
                <?php
                echo $this->Form->control('proyecto_id', ['empty' => '--Seleccione--', 'options' => $proyectosl]);
                echo $this->Form->control('nombre', ['label' => 'Nombre del archivo', 'type' => 'select', 'empty' => '--Seleccione--', 'options' => $docnombre]);
                echo $this->Form->control('detalles');
                echo $this->Form->control('file', ['type' => 'file', 'label' => 'Archivo']);
                ?>
            </fieldset>
            <?= $this->Form->button('Enviar') ?>
            <?= $this->Form->end() ?>
        </div>
        <div style="height: 15px"></div>
        <div class="content">
            <?php if (!empty($docfaltantes)): ?>
                <?php $doctotales = count($docnombre); ?>
                <?php foreach ($docfaltantes as $key => $value): ?>
                    <blockquote>
                        <dl>
                            <dt>
                                <h4>
                                    <b><?php echo $key; ?></b><br>
                                    <span style="color: cadetblue">Estado de entrega: <?php echo number_format((100 - ((count($value) / $doctotales) * 100)), 2); ?>%</span><br>
                                    Documentos faltantes: 
                                </h4>
                            </dt>
                            <?php foreach ($value as $docx): ?>
                                <dd style="color: crimson; font-weight: bold;"><?php echo $docx ?></dd>
                            <?php endforeach; ?>
                        </dl>
                    </blockquote>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
    <div class="column-responsive column-66">
        <div class="table-responsive content">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Estado</th>
                        <th>Razon Social</th>
                        <th>Titulo del proyecto</th>
                        <th>CUIT</th>
                        <th>Creado</th>
                        <th class="actions">#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proyectos as $proyecto): ?>
                        <tr>
                            <td><?= h($proyecto->id) ?></td>
                            <td>
                                <span class="button button-black button-outline"><?= $testados[$proyecto->bloqueado] ?></span><br>
                                <?php echo (strtoupper($testados[$proyecto->bloqueado]) == 'ABIERTO') ? $this->Html->link('Confirmar envio definitivo del proyecto', ['action' => 'confirmar', $proyecto->id], ['class' => 'button button-black', 'style' => 'color: #FFF;', 'confirm' => "Esta seguro de confirmar el envio definitivo del proyecto: \"{$proyecto->proyecto_titulo}\" ? No podra adjuntar ni editar ningun documento."]) : '<span class="button button-black button-outline">El proyecto ya fué confirmado</span>' ?>
                            </td>
                            <td><?= h($proyecto->razon_social) ?></td>
                            <td><?= h($proyecto->proyecto_titulo) ?></td>
                            <td><?= h($proyecto->cuit) ?></td>
                            <td><?= h($proyecto->created) ?></td>
                            <td class="actions">
                                <?php echo $this->Html->link('Detalles', ['action' => 'proyectodetalles', $proyecto->id], ['class' => 'button button-outline']) ?>
                                <?php // echo $this->Html->link('Editar', ['action' => 'proyectoeditar', $proyecto->id], ['class' => 'button button-outline', 'disabled' => 'disabled', 'onclick' => 'return false']) ?>
                                <?php // echo $this->Form->postLink('Borrar', ['action' => 'proyectoborrar', $proyecto->id], ['class' => 'button', 'style' => 'color: #FFF;', 'confirm' => 'Esta seguro que quiere borrar el proyecto: ' . $proyecto->razon_social, 'disabled' => 'disabled', 'onclick' => 'return false']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?= $this->Html->link('PROYECTO NUEVO', ['action' => 'nuevoproyecto'], ['class' => 'button float-right']) ?>
        <div class="clearfix">&nbsp;</div>
        <div class="postulantes view content">
            <div class="related">
                <h4>Documentos enviados</h4>
                <?php if (!empty($documentos)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th>Devoluciones</th>
                                <th>
                                    Datos
                                </th>
                                <th class="actions">#</th>
                            </tr>
                            <?php foreach ($documentos as $documento) : ?>
                                <tr>
                                    <td><?= nl2br($documento->observaciones) ?></td>
                                    <td>
                                        <b><?= h($documento->proyecto->id." - ".$documento->proyecto->razon_social." - ".$documento->proyecto->proyecto_titulo) ?></b><br>
                                        <span class="<?= ($documento->estado == "Aprobado") ? "verde" : "rojo"; ?>"><?= h($documento->estado) ?></span><br>
                                        <?= h($documento->nombre) ?><br>
                                        <?= h($documento->detalles) ?><br>
                                        <?= $this->Html->link('Descargar documento', ['controller' => 'Postulantes', 'action' => 'downloadfile', $documento->file]) ?><br>
                                        <?= h("Enviado: " . $documento->created) ?><br>
                                        <?= h("Modificado: " . $documento->modified) ?><br>
                                    </td>
                                    <td class="actions">
                                        <?= $this->Html->link('Editar envío', ['controller' => 'Postulantes', 'action' => 'editfile', $documento->id], ['class' => 'button button-outline']) ?><br>
                                        <?= $this->Form->postLink('Borrar', ['controller' => 'Postulantes', 'action' => 'deletedocument', $documento->id], ['class' => 'button', 'style' => 'color: #FFF;', 'confirm' => __('Esta seguro de borrar el documento: {0}?', $documento->nombre)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="paginator">
                        <ul class="pagination">
                            <?= $this->Paginator->first('<< ' . 'primera') ?>
                            <?= $this->Paginator->prev('< ' . 'anterior') ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next('siguiente' . ' >') ?>
                            <?= $this->Paginator->last('ultima' . ' >>') ?>
                        </ul>
                        <p><?= $this->Paginator->counter('Página {{page}} de {{pages}}') ?></p>
                    </div>
                <?php else: ?>
                    <h2>No ha enviado archivos aún</h2>
                    <?php // pr($documentos);  ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
