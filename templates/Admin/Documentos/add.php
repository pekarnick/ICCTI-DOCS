<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Documento $documento
 * @var \Cake\Collection\CollectionInterface|string[] $postulantes
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Documentos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documentos form content">
            <?= $this->Form->create($documento) ?>
            <fieldset>
                <legend><?= __('Add Documento') ?></legend>
                <?php
                    echo $this->Form->control('postulante_id', ['options' => $postulantes]);
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('detalles');
                    echo $this->Form->control('file');
                    echo $this->Form->control('observaciones');
                    echo $this->Form->control('estado');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
