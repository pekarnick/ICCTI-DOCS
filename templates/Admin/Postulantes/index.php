<div class="postulantes index content">
    <!--<?= $this->Html->link(__('New Postulante'), ['action' => 'add'], ['class' => 'button float-right']) ?>-->
    <h3><?= __('Postulantes') ?></h3>
    <div>
        <input class="form-control" id="buscar" name="buscar" type="text" />
        <a href="#" onclick="irabuscar();" class="button">Buscar</a>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <!--<th><?= $this->Paginator->sort('id') ?></th>-->
                    <th><?= $this->Paginator->sort('cuit') ?></th>
                    <th><?= $this->Paginator->sort('nombre') ?></th>
                    <th><?= $this->Paginator->sort('apellido') ?></th>
                    <th><?= $this->Paginator->sort('telefono') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($postulantes as $postulante): ?>
                    <tr>
                        <!--<td><?= $this->Number->format($postulante->id) ?></td>-->
                        <td><?= h($postulante->cuit) ?></td>
                        <td><?= h($postulante->nombre) ?></td>
                        <td><?= h($postulante->apellido) ?></td>
                        <td><?= h($postulante->telefono) ?></td>
                        <td><?= h($postulante->email) ?></td>
                        <td><?= h($postulante->created) ?></td>
                        <td><?= h($postulante->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('Detalles', ['action' => 'view', $postulante->id], ['class' => 'button button-outline']) ?>
                            <?= $this->Html->link('Editar', ['action' => 'edit', $postulante->id], ['class' => 'button button-outline']) ?>
                            <?= $this->Form->postLink('Borrar', ['action' => 'delete', $postulante->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postulante->id), 'class' => 'button', 'style' => 'color: #FFF']) ?>
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
<script type="text/javascript">
function irabuscar() {
    let param = document.getElementById("buscar").value;
    window.location.href = `https://iccti.chaco.gob.ar/regs/fontech/admin/postulantes/index/${param}`;
}
</script>