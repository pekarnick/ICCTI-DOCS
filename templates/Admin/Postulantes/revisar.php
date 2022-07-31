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
?>
<style type="text/css">
    label, legend {
        margin-top: 2rem;
        margin-bottom: 0;
    }
</style>
<div class="row">
    <div class="column-responsive column-100">
        <div class="postulantes view content">
            <h3>Postulante N°<?= h($postulante->id) ?> - <?= $postulante->cuit; ?> - <?= $postulante->nombre . " " . $postulante->apellido; ?></h3>
            <div class="related">
                <h4>Documentos</h4>
                <?php if (!empty($postulante->documentos)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Nombre') ?></th>
                                <th><?= __('Detalles') ?></th>
                                <th><?= __('Archivo') ?></th>
                                <th><?= __('Tipo de archivo') ?></th>
                                <th><?= __('Devoluciones') ?></th>
                                <th><?= __('Ultima modificación') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($postulante->documentos as $documentos) : ?>
                                <tr>
                                    <td><?= h($documentos->nombre) ?></td>
                                    <td><?= h($documentos->detalles) ?></td>
                                    <td>
                                        <?= $this->Html->link('Descargar', ['prefix' => false, 'controller' => 'Postulantes', 'action' => 'downloadfile', $documentos->file], ['class' => 'button button-outline']) ?>
                                        <?= $this->Html->link('Vista previa', ['controller' => 'Documentos', 'action' => 'preview', $documentos->id], ['class' => 'button button-outline', 'target' => '_blank']) ?>
                                    </td>
                                    <td>
                                        <?php
                                        $filearr = explode(".", $documentos->file);
                                        echo $filearr[1];
                                        ?>
                                    </td>
                                    <td><?= nl2br($documentos->observaciones) ?></td>
                                    <td><?= h($documentos->modified) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link('Escribir devolución', ['controller' => 'Postulantes', 'action' => 'devolucion', $documentos->id], ['class' => 'button button-outline']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            
            <br /><br />
            <div class="related">
                <blockquote>
                    <legend>Devolución general</legend>
                    <div class="documentos form content">
                        <?= $this->Form->create() ?>
                        <?php
                        echo $this->Form->control('postulante_id', ['type' => 'hidden', 'value' => $postulante->id]);
                        echo $this->Form->control('estado', ['type' => 'select', 'options' => $estados, 'empty' => '--Seleccione--', 'required' => 'required']);
                        echo $this->Form->control('observaciones', ['label' => 'Escribir devolución', 'type' => 'textarea', 'required' => 'required']);
                        ?>
                        </fieldset>
                        <?= $this->Form->button('Guardar') ?>
                        <?= $this->Form->end() ?>
                    </div>
                </blockquote>
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
            <br /><br />
            <table>
                <tr>
                    <th><?= __('Cuit') ?></th>
                    <td><?= h($postulante->cuit) ?></td>
                </tr>
                <tr>
                    <th><?= __('Razon social') ?></th>
                    <td><?= h($postulante->razon_social) ?></td>
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
                    <th><?= __('Localidad') ?></th>
                    <td><?= h($postulante->localidad) ?></td>
                </tr>
                <tr>
                    <th><?= __('Provincia') ?></th>
                    <td><?= h($postulante->provincia) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($postulante->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dni') ?></th>
                    <td><?= $this->Number->format($postulante->dni) ?></td>
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
            <div class="text">
                <strong><?= __('Direccion') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($postulante->direccion)); ?>
                </blockquote>
            </div>
            

        </div>
    </div>
</div>