<div class="row">
    <div class="column-responsive column-100">
        <div class="documentos form content">
            <?= $this->Form->create($documento) ?>
            <fieldset>
                <p><?= $documento->nombre ?></p>
                <hr>
                <p><?= $documento->detalles ?></p>
                <hr>
                <p><?= $this->Html->link('Descargar archivo', ['prefix' => false, 'controller' => 'Postulantes', 'action' => 'downloadfile', $documento->file]) ?></p>
                <hr>
                <p>Estado actual: <?= $documento->estado ?></p>
                <hr>
                <?php echo "Devoluciones anteriores: <br />" . nl2br($documento->observaciones); ?>
                <hr>
                <?php
                echo $this->Form->control('observaciones', ['type' => 'hidden']);
                echo $this->Form->control('estado', ['type' => 'select', 'options' => $estados, 'empty' => '--Seleccione--', 'required' => 'required']);
                echo $this->Form->control('new_observaciones', ['label' => 'Escribir devolución', 'type' => 'textarea', 'required' => 'required']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>