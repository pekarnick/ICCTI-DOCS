<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proyecto $proyecto
 */
?>
<style type="text/css">
    dl dd {
        color: #000;
    }
    dl dt {
        font-style: italic;
        text-decoration: underline;
    }
</style>
<div class="row">
    <div class="column-responsive column-100">
        <div class="proyectos view content">
            <h2><?= h($proyecto->razon_social) ?></h2>
            <div class="row">
                <div class="column-responsive column-33">
                    <blockquote>
                        <h4><em><b>Datos de la Razón Social</b></em></h4>
                        <dl>
                            <dt>Razón Social</dt>
                            <dd><?= h($proyecto->razon_social) ?></dd>

                            <dt>CUIT/CUIL</dt>
                            <dd><?= h($proyecto->cuit) ?></dd>

                            <dt>Domicilio Fiscal</dt>
                            <dd><?= $this->Text->autoParagraph(h($proyecto->domicilio_fiscal)); ?></dd>

                            <dt>Teléfono</dt>
                            <dd><?= h($proyecto->telefono) ?></dd>

                            <dt>Localidad</dt>
                            <dd><?= h($proyecto->localidad) ?></dd>

                            <dt>Actividad Principal</dt>
                            <dd><?= h($proyecto->actividad_principal) ?></dd>

                            <dt>Cantidad Total De Empleados</dt>
                            <dd><?= $this->Number->format($proyecto->cantidad_total_de_empleados) ?></dd>

                            <dt>Categoria Mypyme</dt>
                            <dd><?= h($proyecto->categoria_mypyme) ?></dd>      

                        </dl>
                    </blockquote>
                </div>
                <div class="column-responsive column-33">
                    <blockquote>
                        <h4><em><b>Datos de Representante Legal</b></em></h4>
                        <dl>
                            <dt>Nombre Completo del Representante Legal</dt>
                            <dd><?= h($proyecto->representante_legal_nombre) ?></dd>

                            <dt>Teléfono del Representante LegalCUIT o CUIL del Representante Legal</dt>
                            <dd><?= h($proyecto->representante_legal_cuit_cuil) ?></dd>

                            <dt>Teléfono del Representante Legal</dt>
                            <dd><?= h($proyecto->representante_legal_telefono) ?></dd>
                        </dl>
                    </blockquote>
                </div>
                <div class="column-responsive column-33">
                    <blockquote>
                        <h4><em><b>Datos del Proyecto</b></em></h4>
                        <dl>
                            <dt>Título del Proyecto</dt>
                            <dd><?= h($proyecto->proyecto_titulo) ?></dd>

                            <dt>Tipo de Proyecto</dt>
                            <dd><?= h($proyecto->proyecto_tipo) ?></dd>

                            <dt>Localidad del Proyecto</dt>
                            <dd><?= h($proyecto->proyecto_localidad) ?></dd>

                            <dt>Nombre Completo del Director del Proyecto</dt>
                            <dd><?= h($proyecto->proyecto_nombre_director) ?></dd>

                            <dt>Monto solicitado a FONTECH</dt>
                            <dd><?= $this->Number->format($proyecto->proyecto_monto_solicitado) ?></dd>
                        </dl>
                    </blockquote>
                </div>
            </div>
            <div class="related">
                <h4>Documentos</h4>
                <?php if (!empty($proyecto->documentos)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Postulante Id') ?></th>
                                <th><?= __('Nombre') ?></th>
                                <th><?= __('Detalles') ?></th>
                                <th><?= __('Observaciones') ?></th>
                                <th><?= __('Created') ?></th>
                                <th><?= __('Modified') ?></th>
                                <th><?= __('Estado') ?></th>
                                <!--<th class="actions"><?= __('Actions') ?></th>-->
                            </tr>
                            <?php foreach ($proyecto->documentos as $documentos) : ?>
                                <tr>
                                    <td><?= h($documentos->id) ?></td>
                                    <td><?= h($documentos->postulante_id) ?></td>
                                    <td><?= $this->Html->link($documentos->nombre, ['prefix' => false, 'controller' => 'Postulantes', 'action' => 'downloadfile', $documentos->file]) ?></td>
                                    <td><?= h($documentos->detalles) ?></td>
                                    <td><?= nl2br($documentos->observaciones) ?></td>
                                    <td><?= h($documentos->created) ?></td>
                                    <td><?= h($documentos->modified) ?></td>
                                    <td><?= h($documentos->estado) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
