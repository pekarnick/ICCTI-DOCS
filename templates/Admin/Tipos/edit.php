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
            <?= $this->Form->postLink('Borrar',
                ['action' => 'delete', $tipo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tipo->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link('Lista de tipos', ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documentos form content">
            <?= $this->Form->create($tipo) ?>
            <fieldset>
                <legend><?= __('Edit Tipo') ?></legend>
                <?php
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('oldnombre', ['type' => 'hidden', 'value' => $tipo->nombre]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
