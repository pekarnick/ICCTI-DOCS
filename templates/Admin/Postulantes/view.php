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
                $docfaltantes[$proyec->id . " - " . $proyec->razon_social . " - " . $proyec->proyecto_titulo][] = $tipo->nombre;
            }
        }
    }
}
$tblock = [
    "" => 'NO',
    0 => 'NO',
    1 => 'SI',
]
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="postulantes view content">
            <h3><?= h($postulante->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Cuit') ?></th>
                    <td><?= h($postulante->cuit) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($postulante->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Apellido') ?></th>
                    <td><?= h($postulante->apellido) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telefono') ?></th>
                    <td><?= h($postulante->telefono) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($postulante->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($postulante->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($postulante->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4>Proyectos</h4>
                <?php if (!empty($proyectos)) : ?>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Bloqueado</th>
                                    <th>ID</th>
                                    <th>Razón Social</th>
                                    <th>CUIT</th>
                                    <th>Titulo de proyecto</th>
                                    <th>Tipo de Proyecto</th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($proyectos as $proyecto): ?>
                                    <tr>
                                        <td><span class="button button-black button-outline"><?= $tblock[$proyecto->bloqueado] ?></span></td>
                                        <td><?= $this->Number->format($proyecto->id) ?></td>
                                        <td><?= h($proyecto->razon_social) ?></td>
                                        <td><?= $this->Number->format($proyecto->cuit) ?></td>
                                        
                                        <td><?= h($proyecto->proyecto_titulo) ?></td>
                                        <td><?= h($proyecto->proyecto_tipo) ?></td>
                                        
                                        <td class="actions">
                                            <?= $this->Html->link('Detalles', ['controller' => 'proyectos','action' => 'view', $proyecto->id], ['class' => 'button button-outline']) ?>
                                            <?= ($proyecto->bloqueado=="" || $proyecto->bloqueado == 0) ?
                                                $this->Html->link('Bloquear', ['controller' => 'proyectos','action' => 'bloquear', $proyecto->id, $proyecto->postulante_id], ['class' => 'button', 'style' => 'color: #FFF;']) :
                                                $this->Html->link('Desbloquear', ['controller' => 'proyectos','action' => 'desbloquear', $proyecto->id, $proyecto->postulante_id], ['class' => 'button', 'style' => 'color: #FFF;'])
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            <div class="related">
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

            <div class="related">
                <h4>Documentos</h4>
                <?php if (!empty($postulante->documentos)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Proyecto') ?></th>
                                <th><?= __('Nombre') ?></th>
                                <th><?= __('Detalles') ?></th>
                                <th><?= __('Observaciones') ?></th>
                                <th><?= __('Created') ?></th>
                                <th><?= __('Modified') ?></th>
                                <th><?= __('Estado') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($postulante->documentos as $documentos) : ?>
                                <tr>
                                    <td><?= h($documentos->id) ?></td>
                                    <td><?= $this->Html->link(h($documentos->proyecto_id) . " - " . h($documentos->proyecto->razon_social), ['controller' => 'Proyectos', 'action' => 'view', $documentos->proyecto_id]) ?></td>
                                    <td><?= $this->Html->link($documentos->nombre, ['prefix' => false, 'controller' => 'Postulantes', 'action' => 'downloadfile', $documentos->file]) ?></td>
                                    <td><?= h($documentos->detalles) ?></td>
                                    <td><?= nl2br($documentos->observaciones) ?></td>
                                    <td><?= h($documentos->created) ?></td>
                                    <td><?= h($documentos->modified) ?></td>
                                    <td><span class="<?= strtolower($documentos->estado) ?>"><?= h($documentos->estado) ?></span></td>
                                    <td class="actions">
                                        <?= $this->Html->link('Cambiar estado', ['controller' => 'Postulantes', 'action' => 'devolucion', $documentos->id], ['class' => 'button button-outline']) ?>
                                        <?= $this->Html->link('Vista previa', ['controller' => 'Documentos', 'action' => 'preview', $documentos->id], ['class' => 'button button-outline', 'target' => '_blank']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
