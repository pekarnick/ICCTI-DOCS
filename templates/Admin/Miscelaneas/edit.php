<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Documento $documento
 * @var string[]|\Cake\Collection\CollectionInterface $postulantes
 */
?>
<div class="row">
    <div class="column-responsive column-100">
        <div class="documentos form content">
            <?= $this->Form->create($miscelanea) ?>
            <fieldset>
                <legend><?= __('Edit Tipo') ?></legend>
                <?php
                    echo $this->Form->control('clave');
                    echo $this->Form->control('valor');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
