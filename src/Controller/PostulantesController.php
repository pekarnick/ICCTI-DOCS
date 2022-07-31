<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Mailer\Mailer;

/**
 * Postulantes Controller
 *
 * @property \App\Model\Table\PostulantesTable $Postulantes
 * @method \App\Model\Entity\Postulante[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostulantesController extends AppController {

    //Setear los correos y nombres de host para el mensaje
    public $mail = "icctitest@gmail.com";
    public $mailadmin = "financiamientoiccti@gmail.com";
    public $servidor = "https://iccti.chaco.gob.ar/regs/fontech";

    public function beforeFilter(\Cake\Event\EventInterface $event) {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['registro', 'inicio', 'download']);
    }

    private function _estadoproyecto($proyecto_id) {
        $proyecto = $this->Postulantes->Proyectos->get($proyecto_id, [
            'contain' => [],
        ]);
        if ($proyecto->bloqueado == 1) {
            return false;
        }
        return true;
    }

    public function confirmar($proyecto_id) {
        $proyecto = $this->Postulantes->Proyectos->get($proyecto_id, [
            'contain' => ['Postulantes'],
        ]);
        $proyecto->bloqueado = 1;
        $this->Postulantes->Proyectos->save($proyecto);

        $respuesta['proyecto'] = "{$proyecto->razon_social} - {$proyecto->cuit} - {$proyecto->proyecto_titulo}";
        $respuesta['postulante'] = "{$proyecto->postulante->nombre} {$proyecto->postulante->apellido}";
        $respuesta['link'] = $this->servidor . "/admin/postulantes/revisar/{$proyecto->postulante->id}";

        $mailer = new Mailer('default');
        $mailer->setFrom([$this->mail => 'ICCTI - FONTECH'])
                ->setTo($this->mailadmin)
                ->setSubject("Envio definitivo y cierre del proyecto - {$respuesta['proyecto']}")
                ->deliver("<p>El postulante <b>{$respuesta['postulante']}</b> confirmo el envio definitivo de los documentos para el proyecto {$respuesta['proyecto']}</b></p>"
                        . "<p>Desde el siguiente enlace puede acceder al area para evaluar los documetos: {$respuesta['link']}</p>"
                        . '<p>ICCTI - FONTECH</p>');

        $this->Flash->success("El postulante {$respuesta['postulante']} confirmo el envio definitivo de los documentos para el proyecto \"{$respuesta['proyecto']}\"");
        return $this->redirect(['controller' => 'Postulantes', 'action' => 'usuario']);
    }

    public function index() {
        return $this->redirect(['prefix' => false, 'controller' => 'Users', 'action' => 'login']);
    }

    public function registro() {
//        $result = $this->Authentication->getIdentity();
//        pr($result && $result->get('id'));
//        pr($result->get('id'));
        $postulante = $this->Postulantes->newEmptyEntity();
        $user = $this->Postulantes->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $pass = $this->request->getData('contraseña');
            $repass = $this->request->getData('repetir_contraseña');
            $username = $this->request->getData('cuit');
            $email = $this->request->getData('email');
            if ($pass == $repass) {
                $checkusername = $this->Postulantes->Users->findAllByUsernameOrEmail($username, $email);
                $cantidad = $checkusername->count();
                if ($cantidad == 0) {
                    $postulante = $this->Postulantes->patchEntity($postulante, $this->request->getData());
                    if ($this->Postulantes->save($postulante)) {
                        $user->postulante_id = $postulante->id;
                        $user->password = $pass;
                        $user->username = $username;
                        $user->email = $email;
                        $user->rol = 1;
                        if (!$this->Postulantes->Users->save($user)) {
                            $this->Flash->error('Ocurrio un error al crear el usuario');
                        }
                        $this->Flash->success('Su registro fue enviado correctamente. Su usuario es el CUIT ingresado y la contraseña la que escribió en el formurario de registro', 'success');

                        return $this->redirect(['prefix' => false, 'controller' => 'Users', 'action' => 'login']);
                    }
                } else {
                    $this->Flash->error('El CUIT o el correo electrónico se encuentra registrado');
                }
                $this->Flash->error('Ocurrio un error de registro, intentelo de nuevo');
            } else {
                $this->Flash->error('Las contraseñas deben ser iguales, intentelo de nuevo');
            }
        }
//        $proyectos = $this->Postulantes->Proyectos->find('list')->all();
        $this->set(compact('postulante'));
    }

    public function inicio() {
        return $this->redirect($this->servidor . '/users/login');
    }

    public function download($nombre) {
        $this->autoRender = false;
        $output = WWW_ROOT . "documentacion/" . $nombre;
        $response = $this->response->withFile(
                $output,
                ['download' => true, 'name' => $nombre]
        );
        return $response;
    }

    public function usuario() {
        $documento = $this->Postulantes->Documentos->newEmptyEntity();
        $query = $this->Postulantes->Documentos->find('all', [
            'conditions' => ['Documentos.postulante_id' => $this->Authentication->getIdentity()->get('postulante_id')],
            'order' => ['Documentos.modified DESC'],
            'contain' => ['Proyectos']
        ]);
        if ($this->request->is('post')) {
            $proyecto_id = $this->request->getData('proyecto_id');
            if ($this->_estadoproyecto($proyecto_id)) {
                $documento = $this->Postulantes->Documentos->patchEntity($documento, $this->request->getData());

                $file = $this->request->getData('file');
                $bytes = random_bytes(20);
                $name = bin2hex($bytes);
                $path = $file->getClientFilename();
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $targetPath = WWW_ROOT . 'files' . DS . 'documentos' . DS . $name . "." . $ext;
                $file->moveTo($targetPath);

//            $detalles = $this->request->getData('detalles');
//            if($detalles == "") {
//                $documento->detalles = "-";
//            }

                $documento->postulante_id = $this->Authentication->getIdentity()->get('postulante_id');
                $documento->file = $name . "." . $ext;
                $documento->estado = 'Enviado';
                if ($this->Postulantes->Documentos->save($documento)) {
                    $this->_avisaraladmin();
//                    $this->_avisarposaviso($documento->id);
                    $this->Flash->success('Documento adjuntado correctamente');
                    return $this->redirect(['action' => 'usuario']);
                }
                $this->Flash->error('Error al adjuntar el documento');
            } else {
                $this->Flash->error('El proyecto se encuentra bloqueado por el administrador');
            }
        }
        $proyectosl = $this->Postulantes->Proyectos->find('list', [
            'conditions' => ['Proyectos.postulante_id' => $this->Authentication->getIdentity()->get('postulante_id')],
            'keyField' => 'id',
            'valueField' => 'full_name'
        ]);
        $proyectos = $this->Postulantes->Proyectos->find('all', [
            'conditions' => ['Proyectos.postulante_id' => $this->Authentication->getIdentity()->get('postulante_id')],
            'contain' => ['Documentos' => ['fields' => ['Documentos.proyecto_id', 'Documentos.nombre', 'Documentos.estado']]]
        ]);
        $querytipos = $this->getTableLocator()->get('Tipos');
        $tipos = $querytipos->find()->all();

        $this->set(compact('documento', 'proyectos', 'proyectosl', 'tipos'));
        $this->set('documentos', $this->paginate($query));
    }

    private function _avisarposaviso($documento_id) {
        $query = $this->Postulantes->Documentos->find();
        $query->where(['Documentos.id' => $documento_id]);
        $query->contain(['Proyectos', 'Postulantes']);
        $documento = $query->first();
        if ($documento->proyecto->reportado == "SI") {
            $respuesta['proyecto'] = "{$documento->proyecto->razon_social} - {$documento->proyecto->cuit} - {$documento->proyecto->representante_legal_nombre}";
            $respuesta['postulante'] = "{$documento->postulante->nombre} {$documento->postulante->apellido}";
            $respuesta['link'] = $this->servidor . "/admin/postulantes/revisar/{$documento->postulante->id}";

            $mailer = new Mailer('default');
            $mailer->setFrom([$this->mail => 'ICCTI - FONTECH'])
                    ->setTo($this->mailadmin)
                    ->setSubject("Actualización de documento - {$respuesta['proyecto']}")
                    ->deliver("<p>El postulante: <b>{$respuesta['postulante']}</b> adjunto un nuevo documento para el proyecto: <b>{$respuesta['proyecto']}</b></p>"
                            . "<p>Desde el siguiente enlace puede acceder al area para evaluar los documetos: {$respuesta['link']}</p>"
                            . '<p>ICCTI - FONTECH</p>');
        }
    }

    private function _avisaraladmin() {
        $postulante_id = $this->Authentication->getIdentity()->get('postulante_id');
        $usuario = $this->Postulantes->get($postulante_id, [
            'contain' => [],
        ]);
        $proyectos = $this->Postulantes->Proyectos->find('all', [
            'conditions' => [
                'Proyectos.postulante_id' => $postulante_id,
                "Proyectos.reportado" => "NO",
            ],
            'contain' => ['Documentos' => ['fields' => ['Documentos.proyecto_id', 'Documentos.nombre', 'Documentos.estado']]]
        ]);
        $querytipos = $this->getTableLocator()->get('Tipos');
        $tipos = $querytipos->find()->all();

        $docnombre = [];
        $docfaltantes = [];
        foreach ($tipos as $tipo) {
            $docnombre[$tipo->nombre] = $tipo->nombre;
            if ($tipo->obligatorio == 'SI') {
                foreach ($proyectos as $proyec) {
                    $esta = false;
                    foreach ($proyec->documentos as $docenviados) {
                        if ($tipo->nombre == $docenviados['nombre']) {
                            $esta = true;
                        }
                    }
                    if (!$esta) {
                        $docfaltantes[$proyec->id . "-" . $proyec->razon_social][] = $tipo->nombre;
                    } else {
                        $docfaltantes[$proyec->id . "-" . $proyec->razon_social] = null;
                    }
                }
            }
        }
        $doctotales = count($docnombre);
        foreach ($docfaltantes as $key => $value) {
            $porcentaje = (intval($value)) ? (100 - ((count($value) / $doctotales) * 100)) : 100;
            if ($porcentaje == 100) {
                /*
                 * Nombre y apellido del postulante
                 * Nombre del proyecto
                 * Enlace a ver y evaluar los documentos
                 */
                $respuesta['proyecto'] = $key;
                $respuesta['postulante'] = "{$usuario->nombre} {$usuario->apellido}";
                $respuesta['link'] = $this->servidor . "/admin/postulantes/revisar/{$postulante_id}";

                $mailer = new Mailer('default');
                $mailer->setFrom([$this->mail => 'ICCTI - FONTECH'])
                        ->setTo($this->mailadmin)
                        ->setSubject("Documentación completa - {$respuesta['proyecto']}")
                        ->deliver("<p>El postulante: <b>{$respuesta['postulante']}</b> completo el 100% de la documentación requerida para el proyecto <b>{$respuesta['proyecto']}</b></p>"
                                . "<p>Desde el siguiente enlace puede acceder al area para evaluar los documetos: {$respuesta['link']}</p>"
                                . '<p>ICCTI - FONTECH</p>');
                $pryname = explode("-", $respuesta['proyecto']);
                $pry = $this->Postulantes->Proyectos->get($pryname[0]);
                $pry->reportado = "SI";
                $this->Postulantes->Proyectos->save($pry);
            }
        }
    }

    public function deletedocument($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $documento = $this->Postulantes->Documentos->get($id);
        if ($this->_estadoproyecto($documento->proyecto_id)) {
            if ($documento->postulante_id == $this->Authentication->getIdentity()->get('postulante_id')) {
                if ($documento->estado == 'Enviado') {
                    if ($this->Postulantes->Documentos->delete($documento)) {
                        unlink(WWW_ROOT . 'files' . DS . 'documentos' . DS . $documento->file);
                        $this->Flash->success('Documento eliminado correctamente');
                    } else {
                        $this->Flash->error('Error al intentar eliminar el documento');
                    }
                } else {
                    $this->Flash->error('Se está evaluando el documento, no se puede eliminar');
                }
            }
        } else {
            $this->Flash->error('El proyecto se encuentra bloqueado por el administrador');
            return $this->redirect(['controller' => 'Postulantes', 'action' => 'usuario']);
        }
        return $this->redirect(['action' => 'usuario']);
    }

    public function downloadfile($nombre) {
        $this->autoRender = false;
        $output = WWW_ROOT . "files/documentos/" . $nombre;
        $documento = $this->Postulantes->Documentos->find('all', [
            'conditions' => ['Documentos.file' => $nombre],
            'fields' => ['nombre']
        ]);
        $row = $documento->first();
        $ext = pathinfo($nombre, PATHINFO_EXTENSION);
        $response = $this->response->withFile(
                $output,
                ['download' => true, 'name' => $row->nombre . "." . $ext]
        );
        return $response;
    }

    public function editfile($id = null) {
        $documento = $this->Postulantes->Documentos->get($id, [
            'contain' => [],
        ]);
        if ($this->_estadoproyecto($documento->proyecto_id)) {
            if ($documento->postulante_id == $this->Authentication->getIdentity()->get('postulante_id')) {
                if ($this->request->is(['patch', 'post', 'put'])) {
                    $documento = $this->Postulantes->Documentos->patchEntity($documento, $this->request->getData());

                    $file = $this->request->getData('file');
                    $old_file = $this->request->getData('old_file');
                    $error = $file->getError();
                    if ($error == 0) {
                        $bytes = random_bytes(20);
                        $name = bin2hex($bytes);
                        $path = $file->getClientFilename();
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $targetPath = WWW_ROOT . 'files' . DS . 'documentos' . DS . $name . "." . $ext;
                        $file->moveTo($targetPath);
                        $documento->file = $name . "." . $ext;
                        unlink(WWW_ROOT . 'files' . DS . 'documentos' . DS . $old_file);
                        $documento->estado = "Enviado";
                    } else {
                        $documento->file = $old_file;
                    }
                    if ($this->Postulantes->Documentos->save($documento)) {
                        $this->Flash->success('Documento actualizado correctamente');

                        return $this->redirect(['controller' => 'Postulantes', 'action' => 'usuario']);
                    }
                    $this->Flash->error('Error al intentar actualizar');
                }
            } else {
                $this->Flash->error('Documento no encontrado');
                return $this->redirect(['controller' => 'Postulantes', 'action' => 'usuario']);
            }
        } else {
            $this->Flash->error('El proyecto se encuentra bloqueado por el administrador');
            return $this->redirect(['controller' => 'Postulantes', 'action' => 'usuario']);
        }
        $querytipos = $this->getTableLocator()->get('Tipos');
        $tipos = $querytipos->find()->all();

        $this->set(compact('documento', 'tipos'));
    }

    public function nuevoproyecto() {
        $proyecto = $this->Postulantes->Proyectos->newEmptyEntity();
        if ($this->request->is('post')) {
            $proyecto = $this->Postulantes->Proyectos->patchEntity($proyecto, $this->request->getData());
            $proyecto->postulante_id = $this->Authentication->getIdentity()->get('postulante_id');
            $proyecto->reportado = "NO";
            if ($this->Postulantes->Proyectos->save($proyecto)) {
                $this->Flash->success(__('The proyecto has been saved.'));

                return $this->redirect(['action' => 'usuario']);
            }
            $this->Flash->error(__('The proyecto could not be saved. Please, try again.'));
        }
        $localidades1 = $this->getTableLocator()->get('Localidades');
        $localidades = $localidades1->find('list', [
            'keyField' => 'localidad',
            'valueField' => 'localidad'
        ]);
//        $localidades = $this->Localidades->find('list')->all();
        $this->set(compact('proyecto', 'localidades'));
    }

    public function proyectodetalles($id = null) {
        $proyecto = $this->Postulantes->Proyectos->get($id, [
            'contain' => ['Postulantes', 'Documentos'],
        ]);
        if ($proyecto->postulante_id == $this->Authentication->getIdentity()->get('postulante_id')) {
            $this->set(compact('proyecto'));
        } else {
            return $this->redirect(['controller' => 'Postulantes', 'action' => 'usuario']);
        }
    }

}
