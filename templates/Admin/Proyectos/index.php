<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Proyecto[]|\Cake\Collection\CollectionInterface $proyectos
 */
?>
<div class="proyectos index content">
    <?= $this->Html->link(__('New Proyecto'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Proyectos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('razon_social') ?></th>
                    <th><?= $this->Paginator->sort('cuit') ?></th>
                    <th><?= $this->Paginator->sort('telefono') ?></th>
                    <th><?= $this->Paginator->sort('localidad') ?></th>
                    <th><?= $this->Paginator->sort('actividad_principal') ?></th>
                    <th><?= $this->Paginator->sort('cantidad_total_de_empleados') ?></th>
                    <th><?= $this->Paginator->sort('representante_legal_nombre') ?></th>
                    <th><?= $this->Paginator->sort('representante_legal_cuit_cuil') ?></th>
                    <th><?= $this->Paginator->sort('representante_legal_telefono') ?></th>
                    <th><?= $this->Paginator->sort('proyecto_titulo') ?></th>
                    <th><?= $this->Paginator->sort('proyecto_tipo') ?></th>
                    <th><?= $this->Paginator->sort('proyecto_localidad') ?></th>
                    <th><?= $this->Paginator->sort('proyecto_nombre_director') ?></th>
                    <th><?= $this->Paginator->sort('proyecto_monto_solicitado') ?></th>
                    <th><?= $this->Paginator->sort('postulante_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyectos as $proyecto): ?>
                <tr>
                    <td><?= $this->Number->format($proyecto->id) ?></td>
                    <td><?= h($proyecto->razon_social) ?></td>
                    <td><?= $this->Number->format($proyecto->cuit) ?></td>
                    <td><?= h($proyecto->telefono) ?></td>
                    <td><?= h($proyecto->localidad) ?></td>
                    <td><?= h($proyecto->actividad_principal) ?></td>
                    <td><?= $this->Number->format($proyecto->cantidad_total_de_empleados) ?></td>
                    <td><?= h($proyecto->representante_legal_nombre) ?></td>
                    <td><?= $this->Number->format($proyecto->representante_legal_cuit_cuil) ?></td>
                    <td><?= h($proyecto->representante_legal_telefono) ?></td>
                    <td><?= h($proyecto->proyecto_titulo) ?></td>
                    <td><?= h($proyecto->proyecto_tipo) ?></td>
                    <td><?= h($proyecto->proyecto_localidad) ?></td>
                    <td><?= h($proyecto->proyecto_nombre_director) ?></td>
                    <td><?= $this->Number->format($proyecto->proyecto_monto_solicitado) ?></td>
                    <td><?= $proyecto->has('postulante') ? $this->Html->link($proyecto->postulante->id, ['controller' => 'Postulantes', 'action' => 'view', $proyecto->postulante->id]) : '' ?></td>
                    <td><?= h($proyecto->created) ?></td>
                    <td><?= h($proyecto->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $proyecto->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $proyecto->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $proyecto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $proyecto->id)]) ?>
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
