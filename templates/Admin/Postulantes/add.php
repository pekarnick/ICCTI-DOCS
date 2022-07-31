<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Postulante $postulante
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Postulantes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="postulantes form content">
            <?= $this->Form->create($postulante) ?>
            <fieldset>
                <legend><?= __('Add Postulante') ?></legend>
                <?php
                    echo $this->Form->control('cuit');
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('apellido');
                    echo $this->Form->control('telefono');
                    echo $this->Form->control('email');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
