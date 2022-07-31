<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Postulante $postulante
 */
?>
<div class="row">
    <div class="column column-80 column-offset-10">
        <div class="postulantes form content">
            <?= $this->Form->create($postulante) ?>
            <fieldset>
                <p>La presente convocatoria busca financiar parcialmente propuestas innovadoras con potencial de comercialización e internacionalización, que promuevan la generación de empleos de calidad, brindando nuevos productos o servicios intensivos en conocimiento y tecnología.</p>
                <p>&nbsp;</p>
                <?php
                echo $this->Form->control('cuit', ['placeholder' => 'Solo números ej: 20254451580', 'name' => 'cuit']);
                echo $this->Form->control('nombre');
                echo $this->Form->control('apellido');
                echo $this->Form->control('telefono');
                echo $this->Form->control('email', ['placeholder' => 'Escriba su EMAIL, si se encuentra otro usuario con el mismo email no se creara el usuario']);
                echo $this->Form->control('contraseña', ['type' => 'password']);
                echo $this->Form->control('repetir_contraseña', ['type' => 'password']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Enviar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
