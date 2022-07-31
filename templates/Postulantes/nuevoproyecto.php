<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proyecto $proyecto
 * @var \Cake\Collection\CollectionInterface|string[] $postulantes
 */
?>
<style type="text/css">
    label {
        margin-bottom: 0;
    }
</style>
<div class="row">
    <div class="column column-80 column-offset-10">
        <div class="proyectos form content">
            <?= $this->Form->create($proyecto) ?>
            <fieldset>
                <h2>Datos de la Razón Social</h2>
                <?php
                echo $this->Form->control('razon_social');
                echo $this->Form->control('cuit', ['placeholder' => 'Sin guiones y sin puntos, ej: 20364832150']);
                echo $this->Form->control('domicilio_fiscal');
                echo $this->Form->control('telefono', ['label' => 'Teléfono']);
                echo $this->Form->control('localidad', ['type' => 'select', 'empty' => '--Localidad--', 'options' => $localidades]);
                echo $this->Form->control('actividad_principal');
                echo $this->Form->control('cantidad_total_de_empleados');
                echo $this->Form->control('categoria_mypyme', ['type' => 'select', 'empty' => '--Seleccione--', 'options' => ['Mi' => 'Mi', 'P' => 'P', 'Me1' => 'Me1', 'Me2' => 'Me2', 'G' => 'G']]);
                ?>
                <hr />
                <h2>Datos de Representante Legal</h2>
                <?php
                echo $this->Form->control('representante_legal_nombre', ['label' => 'Nombre Completo del Representante Legal']);
                echo $this->Form->control('representante_legal_cuit_cuil', ['label' => 'CUIT o CUIL del Representante Legal', 'placeholder' => 'Sin guiones y sin puntos, ej: 20364832150']);
                echo $this->Form->control('representante_legal_telefono', ['label' => 'Teléfono del Representante Legal']);
                ?>
                <hr />
                <h2>Datos del Proyecto</h2>
                <?php
                echo $this->Form->control('proyecto_titulo', ['label' => 'Título del Proyecto']);
                echo $this->Form->control('proyecto_tipo', ['label' => 'Tipo de Proyecto', 'type' => 'select', 'empty' => '--Seleccione--', 'options' => ['I+D' => 'I+D', 'Moderniz. Tecno.' => 'Moderniz. Tecno.']]);
                echo $this->Form->control('proyecto_localidad', ['label' => 'Localidad del Proyecto', 'type' => 'select', 'empty' => '--Localidad--', 'options' => $localidades]);
                echo $this->Form->control('proyecto_nombre_director', ['label' => 'Nombre Completo del Director del Proyecto']);
                echo $this->Form->control('proyecto_monto_solicitado', ['label' => 'Monto solicitado a FONTECH']);
                ?>
            </fieldset>
            <?= $this->Form->button('Guardar') ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
