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
            <?= $this->Html->link('Lista de tipos', ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documentos form content">
            <?= $this->Form->create($tipo) ?>
            <fieldset>
                <legend><?= __('Add Tipo') ?></legend>
                <?php
                    echo $this->Form->control('nombre');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
