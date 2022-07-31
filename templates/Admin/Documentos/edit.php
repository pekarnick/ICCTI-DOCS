<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Documento $documento
 * @var string[]|\Cake\Collection\CollectionInterface $postulantes
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $documento->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $documento->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Documentos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documentos form content">
            <?= $this->Form->create($documento) ?>
            <fieldset>
                <legend><?= __('Edit Documento') ?></legend>
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
