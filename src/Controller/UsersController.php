<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    public function beforeFilter(\Cake\Event\EventInterface $event) {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function login() {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $userloguedin = $this->Authentication->getIdentity();
            switch ($userloguedin->get("rol")) {
                case 0:
                    $redirect = $this->request->getQuery('redirect', [
                        'prefix' => 'Admin',
                        'controller' => 'Postulantes',
                        'action' => 'inicio',
                    ]);

                    break;

                default:
                    $querymisc = $this->getTableLocator()->get('Miscelaneas');
                    $fechalimite = $querymisc
                            ->find()
                            ->where(['clave' => 'fecha_limite'])
                            ->first();
                    $fecha_limite = new \DateTime($fechalimite->valor);
                    $fecha_actual = new \DateTime(date('Y-m-d'));
                    if ($fecha_limite < $fecha_actual) {
                        return $this->redirect(['action' => 'logout',"cerrado"]);
                    } else {
                        $redirect = $this->request->getQuery('redirect', [
                            'prefix' => false,
                            'controller' => 'Postulantes',
                            'action' => 'usuario',
                        ]);
                    }
                    break;
            }
            // redirect to /articles after login success


            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('CUIT o contraseña incorrecta');
        }
    }

    public function logout($mensaje = "") {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            if ($mensaje == "cerrado") {
                $this->Flash->error("El formulario se encuentra cerrado");
            }
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

}
