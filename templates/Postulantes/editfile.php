<?php
$docnombre = [];
foreach ($tipos as $tipo) {
    $docnombre[$tipo->nombre] = $tipo->nombre;
}
?>
<div class="row">
    <div class="column column-25">
        <div class="content">
            <h3>Observaciones / correcciones requeridas</h3>
            <p><?= ($documento->observaciones != "") ? nl2br($documento->observaciones) : "No se han agregado observaciones a este documento"; ?></p>
        </div>
    </div>
    <div class="column column-75">
        <div class="documentos form content">
            <?= $this->Form->create($documento, ['enctype' => 'multipart/form-data']) ?>
            <fieldset>
                <legend>Editar archivo adjunto</legend>
                <?php
                echo $this->Form->control('nombre',['label' => 'Nombre del archivo', 'type' => 'select', 'empty' => '--Seleccione--', 'options' => $docnombre, 'default' => $documento->nombre]);
                echo $this->Form->control('detalles');
                echo $this->Form->control('file', ['type' => 'file', 'label' => 'Archivo', 'required' => false]);
                echo $this->Form->control('old_file', ['type' => 'hidden', 'value' => $documento->file]);
                echo "Archivo actual: " . $this->Html->link($documento->nombre, ['controller' => 'postulantes', 'action' => 'downloadfile', $documento->file]);
                ?>
            </fieldset>
            <?= $this->Form->button('Enviar') ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
