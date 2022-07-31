<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Documento $documento
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Documento'), ['action' => 'edit', $documento->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Documento'), ['action' => 'delete', $documento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $documento->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Documentos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Documento'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documentos view content">
            <h3><?= h($documento->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Postulante') ?></th>
                    <td><?= $documento->has('postulante') ? $this->Html->link($documento->postulante->id, ['controller' => 'Postulantes', 'action' => 'view', $documento->postulante->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($documento->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Observaciones') ?></th>
                    <td><?= h($documento->observaciones) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado') ?></th>
                    <td><?= h($documento->estado) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($documento->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($documento->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($documento->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Detalles') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($documento->detalles)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('File') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($documento->file)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
