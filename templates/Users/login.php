<div class="row">
    <div class="column column-50 column-offset-25">
        <div class="postulantes form content">
            <?= $this->Flash->render() ?>
            <?= $this->Form->create() ?>
            <fieldset>
                <?= $this->Form->control('username', ['required' => true, 'label' => 'CUIT (Sólo números)']) ?>
                <?= $this->Form->control('password', ['required' => true, 'label' => 'Contraseña']) ?>
            </fieldset>
            <?= $this->Form->submit(__('Login')); ?>
            <?= $this->Form->end() ?>
            <?= $this->Html->link('Registrarse', ['controller' => 'Postulantes', 'action' => 'registro']); ?>
        </div>
    </div>
</div>
