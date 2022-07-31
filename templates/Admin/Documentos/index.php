<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Documento[]|\Cake\Collection\CollectionInterface $documentos
 */
?>
<div class="documentos index content">
    <?= $this->Html->link(__('New Documento'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Documentos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('postulante_id') ?></th>
                    <th><?= $this->Paginator->sort('nombre') ?></th>
                    <th><?= $this->Paginator->sort('observaciones') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('estado') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documentos as $documento): ?>
                <tr>
                    <td><?= $this->Number->format($documento->id) ?></td>
                    <td><?= $documento->has('postulante') ? $this->Html->link($documento->postulante->id, ['controller' => 'Postulantes', 'action' => 'view', $documento->postulante->id]) : '' ?></td>
                    <td><?= h($documento->nombre) ?></td>
                    <td><?= nl2br($documento->observaciones) ?></td>
                    <td><?= h($documento->created) ?></td>
                    <td><?= h($documento->modified) ?></td>
                    <td><?= h($documento->estado) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $documento->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $documento->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $documento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $documento->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
