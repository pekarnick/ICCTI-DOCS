<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html lang="es_ES">
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            ICCTI - Fontech
        </title>
        <link rel="icon" href="https://iccti.chaco.gob.ar/wp-content/uploads/2022/01/cropped-icon-32x32.png" sizes="32x32" />
        <link rel="icon" href="https://iccti.chaco.gob.ar/wp-content/uploads/2022/01/cropped-icon-192x192.png" sizes="192x192" />
        <link rel="apple-touch-icon" href="https://iccti.chaco.gob.ar/wp-content/uploads/2022/01/cropped-icon-180x180.png" />
        <meta name="msapplication-TileImage" content="https://iccti.chaco.gob.ar/wp-content/uploads/2022/01/cropped-icon-270x270.png" />

        <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

        <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
        <nav class="top-nav">
            <div class="top-nav-title">
                <a href="<?= $this->Url->build('/') ?>">
                    <img src="https://iccti.chaco.gob.ar/wp-content/uploads/2022/01/logoh.png" class="img-responsive" alt="ICCTI" loading="lazy" itemprop="logo">
                </a>
            </div>
            <div class="top-nav-links">
                <?php
                if ($this->Identity->isLoggedIn()) {
                    $rol = $this->Identity->get('rol');
                    if ($rol == 0) {
                        echo $this->Html->link("Inicio", ['prefix' => 'Admin', 'controller' => 'Postulantes', 'action' => 'inicio'], ['class' => 'button button-clear']);
                        echo $this->Html->link("Postulantes", ['prefix' => 'Admin', 'controller' => 'Postulantes', 'action' => 'index'], ['class' => 'button button-clear']);
                        echo $this->Html->link("Tipos de documentos", ['prefix' => 'Admin', 'controller' => 'Tipos', 'action' => 'index'], ['class' => 'button button-clear']);
                        echo $this->Html->link("Fecha limite", ['prefix' => 'Admin', 'controller' => 'Miscelaneas', 'action' => 'edit', 3], ['class' => 'button button-clear']);
//                        echo $this->Html->link("Documentos", ['prefix' => 'Admin', 'controller' => 'Documentos', 'action' => 'index'], ['class' => 'button button-clear']);
//                        echo $this->Html->link("Usuarios", ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'index']);
                    } else {
                        echo $this->Html->link("Inicio", ['prefix' => false, 'controller' => 'Postulantes', 'action' => 'usuario'], ['class' => 'button button-clear']);
                    }
                    echo $this->Html->link("Salir", ['prefix' => false, 'controller' => 'users', 'action' => 'logout'], ['class' => 'button button-clear']);
                } else {
                    echo $this->Html->link("Login", ['prefix' => false, 'controller' => 'users', 'action' => 'login'], ['class' => 'button button-clear']);
                }
                ?>
            </div>
        </nav>
        <main class="main">
            <div class="container">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </main>
        <footer>
            <div style="height: 20px"></div>
            <div class="content">&nbsp;</div>
        </footer>
    </body>
</html>
