<div class="postulantes index content">
    <div class="table-responsive">
        <div>
            <select name="estado" required="required" id="buscar">
                <option value="">--Seleccione--</option>
                <option value="Enviado">Enviados para revisar</option>
                <option value="En Revisión">En Revisión</option>
                <option value="Corregir">Corregir</option>
                <option value="Admitido">Admitido</option>
                <option value="Admitido con observaciones">Admitido con observaciones</option>
                <option value="No Admitido">No Admitido</option>
                <option value="Todos">Todos</option>
            </select>
            <a href="#" onclick="irabuscar();" class="button">Buscar</a>
            <br /><h3><?= ($estado == "Todos") ? "Todos los postulantes que enviaron documentación" : "Documentos con el estado <b>{$estado}</b>"; ?></h3>
        </div>
        <table>
            <thead>
                <tr>
                    <!--<th><?= $this->Paginator->sort('id') ?></th>-->
                    <th><?= $this->Paginator->sort('cuit') ?></th>
                    <th><?= $this->Paginator->sort('full_name') ?></th>
                    <th>Cantidad de Documentos</th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($postulantes as $postulante): ?>
                    <?php
                    $cantidad = count($postulante->documentos);
                    ?>
                    <?php if ($cantidad > 0): ?>
                        <tr>
                            <!--<td><?= $this->Number->format($postulante->id) ?></td>-->
                            <td><?= h($postulante->cuit) ?></td>
                            <td><?= h($postulante->full_name) ?></td>
                            <td>
                                <?php echo $cantidad; ?>
                            </td>
                            <td class="actions">
                                <?= ($estado == 'Enviado') ? $this->Html->link('Revisar', ['action' => 'revisar', $postulante->id], ['class' => 'button button-outline']) : $this->Html->link('Detalles', ['controller' => 'Postulantes','action' => 'view', $postulante->id], ['class' => 'button button-outline']) ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
<script type="text/javascript">
function irabuscar() {
    let param = document.getElementById("buscar");
    window.location.href = `https://iccti.chaco.gob.ar/regs/fontech/admin/postulantes/inicio/${param.options[param.selectedIndex].value}`;
}
</script>