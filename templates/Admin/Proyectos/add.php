<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proyecto $proyecto
 * @var \Cake\Collection\CollectionInterface|string[] $postulantes
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Proyectos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="proyectos form content">
            <?= $this->Form->create($proyecto) ?>
            <fieldset>
                <legend><?= __('Add Proyecto') ?></legend>
                <?php
                    echo $this->Form->control('razon_social');
                    echo $this->Form->control('cuit');
                    echo $this->Form->control('domicilio_fiscal');
                    echo $this->Form->control('telefono');
                    echo $this->Form->control('localidad');
                    echo $this->Form->control('actividad_principal');
                    echo $this->Form->control('cantidad_total_de_empleados');
                    echo $this->Form->control('representante_legal_nombre');
                    echo $this->Form->control('representante_legal_cuit_cuil');
                    echo $this->Form->control('representante_legal_telefono');
                    echo $this->Form->control('proyecto_titulo');
                    echo $this->Form->control('proyecto_tipo');
                    echo $this->Form->control('proyecto_localidad');
                    echo $this->Form->control('proyecto_nombre_director');
                    echo $this->Form->control('proyecto_monto_solicitado');
                    echo $this->Form->control('postulante_id', ['options' => $postulantes, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
