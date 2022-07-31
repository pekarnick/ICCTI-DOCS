<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Documento[]|\Cake\Collection\CollectionInterface $documentos
 */
?>
<div class="documentos index content">
    <?= $this->Html->link('Nuevo tipo', ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Tipos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('nombre') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tipos as $tipo): ?>
                <tr>
                    <td><?= h($tipo->nombre) ?></td>
                    <td><?= h($tipo->created) ?></td>
                    <td><?= h($tipo->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('Editar', ['action' => 'edit', $tipo->id], ['class' => 'button button-outline']) ?>
                        <?= $this->Form->postLink('Borrar', ['action' => 'delete', $tipo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tipo->id),'class' => 'button','style' => 'color: #FFF']) ?>
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
