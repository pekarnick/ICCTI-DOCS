<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
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

    private function _estados() {
        return $estados = [
            'En Revisión' => 'En Revisión',
            'Corregir' => 'Corregir',
            'Admitido' => 'Admitido',
            'Admitido con observaciones' => 'Admitido con observaciones',
            'No Admitido' => 'No Admitido'
        ];
    }

    public function beforeFilter(\Cake\Event\EventInterface $event) {
        parent::beforeFilter($event);
        if ($this->Authentication->getIdentity()) {
            $rol = $this->Authentication->getIdentity()->get('rol');
            if ($rol != 0) {
                return $this->redirect(['prefix' => false, 'controller' => 'postulantes', 'action' => 'inicio']);
            }
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function inicio($estado = "Enviado") {

        if ($estado == "Todos") {
            $query = $this->Postulantes->find('all', [
                'contain' => ['Documentos' => [
                        'fields' => ['Documentos.postulante_id', 'Documentos.id']
                    ]]
            ]);
        } else {
            $query = $this->Postulantes->find('all', [
                'contain' => ['Documentos' => [
                        'conditions' => ['Documentos.estado' => $estado],
                        'fields' => ['Documentos.postulante_id', 'Documentos.id']
                    ]]
            ]);
        }
        $postulantes = $query->all();
        $this->set(compact('postulantes', 'estado'));
    }

    public function revisar($id) {
        if ($this->request->is(['patch', 'post', 'put'])) {
            pr($this->request->getData());
            $documentos = $this->_getpostulanterevisar($this->request->getData('postulante_id'))->documentos;
            $estado = $this->request->getData('estado');
            $observaciones = $this->request->getData('observaciones');
            $postulante_id = $this->request->getData('postulante_id');
            foreach ($documentos as $documento) {
                /*
                 * 1 - buscar el documento
                 * 2 - agarrar lo que tenga observaciones
                 * 3 - concatenar con la nueva observacion general
                 * 4 - cambiar el estado de los documentos
                 * 5 - guardar las nuevas observaciones
                 */
                $docquery = $this->Postulantes->Documentos->get($documento->id, [
                    'contain' => [],
                ]);
                $docquery->observaciones .= "-------------------------------\n";
                $docquery->observaciones .= "---" . date('d/m/Y') . "---\n";
                $docquery->observaciones .= $this->request->getData('observaciones');
                $docquery->observaciones .= "\n-------------------------------\n";
                $docquery->estado = $this->request->getData('estado');
                $this->Postulantes->Documentos->save($docquery);
            }
            /*
             * 6 - enviar correo electronico al terminar de actualizar el estado de los documentos
             */
            $respuesta = $this->_respuestageneral($estado, $observaciones, $postulante_id);
            if ($respuesta) {
                $mailer = new Mailer('default');
                $mailer->setFrom([$this->mail => 'ICCTI - FONTECH'])
//                        ->setTo('guillerohde@gmail.com')
                        ->setTo($respuesta['destinatario'])
                        ->setSubject(strip_tags($respuesta['mensaje']))
                        ->deliver("<p>Estimado {$respuesta['postulante']}</p>"
                                . "<p>{$respuesta['mensaje']}</p>"
                                . "<p>Las observaciones agregadas son las siguientes:</p>"
                                . "<p><b>" . nl2br(trim($respuesta['observaciones'])) . "</b></p>"
                                . "<p>Puede acceder desde el siguiente enlace: {$respuesta['link']}</p>"
                                . '<p>ICCTI - FONTECH</p>');
            }
            $this->Flash->success('Devolución guardada correctamente');

            return $this->redirect(['action' => 'inicio']);
        }
        $proyectosl = $this->Postulantes->Proyectos->find('list', [
            'conditions' => ['Proyectos.postulante_id' => $id],
            'keyField' => 'id',
            'valueField' => 'razon_social'
        ]);
        $proyectos = $this->Postulantes->Proyectos->find('all', [
            'conditions' => ['Proyectos.postulante_id' => $id],
            'contain' => ['Documentos' => ['fields' => ['Documentos.proyecto_id', 'Documentos.nombre', 'Documentos.estado']]]
        ]);
        $querytipos = $this->getTableLocator()->get('Tipos');
        $tipos = $querytipos->find()->all();

        $postulante = $this->_getpostulanterevisar($id);
        $this->set(compact('postulante', 'tipos', 'proyectos', 'proyectosl'));
        $this->set('estados', $this->_estados());
    }

    private function _getpostulanterevisar($id) {
        $query = $this->Postulantes->find('all', [
            'contain' => ['Documentos' => [
                    'conditions' => ['Documentos.estado' => 'Enviado'],
                    'fields' => ['Documentos.postulante_id', 'Documentos.id', 'Documentos.file', 'Documentos.nombre', 'Documentos.detalles', 'Documentos.observaciones', 'Documentos.modified']
                ]],
            'conditions' => ['Postulantes.id' => $id]
        ]);

        return $query->first();
    }

    public function devolucion($documento_id) {
        $documento = $this->Postulantes->Documentos->get($documento_id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $observaciones = $this->request->getData('observaciones') . "\n";
            $observaciones .= "-------------------------------\n";
            $observaciones .= "---" . date('d/m/Y') . "---\n";
            $observaciones .= $this->request->getData('new_observaciones');
            $observaciones .= "\n-------------------------------\n";
            $documento = $this->Postulantes->Documentos->patchEntity($documento, $this->request->getData());
            $documento->observaciones = $observaciones;
            $estado = $documento->estado;
            if ($this->Postulantes->Documentos->save($documento)) {

                $respuesta = $this->_respuesta($estado, $documento);
                if ($respuesta) {
                    $mailer = new Mailer('default');
                    $mailer->setFrom([$this->mail => 'ICCTI - FONTECH'])
//                            ->setTo('guillerohde@gmail.com')
                            ->setTo($respuesta['destinatario'])
                            ->setSubject(strip_tags($respuesta['mensaje']))
                            ->deliver("<p>Estimado {$respuesta['postulante']}</p>"
                                    . "<p>{$respuesta['mensaje']}</p>"
                                    . "<p>Las observaciones agregadas al documentos son las siguientes:</p>"
                                    . "<p>" . nl2br(trim($respuesta['observaciones'])) . "</p>"
                                    . "<p>Puede acceder a editar el documento desde el siguiente enlace: {$respuesta['link']}</p>"
                                    . '<p>ICCTI - FONTECH</p>');
                }
                $this->Flash->success('Devolución guardada correctamente');

                return $this->redirect(['action' => 'inicio']);
            }
            $this->Flash->error('Error al intentar guardar la devolución');
        }
        $this->set(compact('documento'));
        $this->set('estados', $this->_estados());
    }

    private function _respuesta($estado, $documento) {
        $respuesta = [];
        $respuesta['link'] = $this->servidor . "/postulantes/editfile/{$documento->id}";
        $respuesta['observaciones'] = $documento->observaciones;
        switch ($estado) {
            case "Revisión":
                $respuesta['mensaje'] = "Su documento \"{$documento->nombre}\" <b>se encuentra en revisión</b>";
                break;
            case "Corregir":
                $respuesta['mensaje'] = "Su documento \"{$documento->nombre}\" <b>requiere correciones</b>";
                break;
            case "Rechazado":
                $respuesta['mensaje'] = "Su documento \"{$documento->nombre}\" <b>fue rechazado</b>";
                break;
            case "Aprobado":
                $respuesta['mensaje'] = "Su documento \"{$documento->nombre}\" <b>fue aprobado</b>";
                break;

            default:
                return false;
        }

        $usuario = $this->Postulantes->get($documento->postulante_id, [
            'contain' => [],
        ]);

        $respuesta['postulante'] = "{$usuario->nombre} {$usuario->apellido}";
        $respuesta['destinatario'] = $usuario->email;

        return $respuesta;
    }

    private function _respuestageneral($estado, $observaciones, $postulante_id) {
        $respuesta = [];
        $respuesta['link'] = $this->servidor . "/users/login";
        $respuesta['observaciones'] = $observaciones;
        switch ($estado) {
            case "Revisión":
                $respuesta['mensaje'] = "Sus documentos <b>se encuentran en revisión</b>";
                break;
            case "Corregir":
                $respuesta['mensaje'] = "Sus documentos <b>requieren correciones</b>";
                break;
            case "Rechazado":
                $respuesta['mensaje'] = "Sus documentos <b>fueron rechazado</b>";
                break;
            case "Aprobado":
                $respuesta['mensaje'] = "Sus documentos <b>fueron aprobado</b>";
                break;

            default:
                return false;
        }

        $usuario = $this->Postulantes->get($postulante_id, [
            'contain' => [],
        ]);

        $respuesta['postulante'] = "{$usuario->nombre} {$usuario->apellido}";
        $respuesta['destinatario'] = $usuario->email;

        return $respuesta;
    }

    public function index($buscar = null) {
        if ($buscar != null) {
            $this->paginate = [
                'conditions' => [
                    'OR' => [
                        "Postulantes.cuit LIKE '%{$buscar}%'",
                        "Postulantes.nombre LIKE '%{$buscar}%'",
                        "Postulantes.apellido LIKE '%{$buscar}%'",
                        "Postulantes.email LIKE '%{$buscar}%'",
                    ]
                ]
            ];
        }
        $postulantes = $this->paginate($this->Postulantes);
        $this->set(compact('postulantes'));
    }

    /**
     * View method
     *
     * @param string|null $id Postulante id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $postulante = $this->Postulantes->get($id, [
            'contain' => [
                'Documentos' => [
                    'Proyectos',
                ],
                'Users'
            ],
        ]);
        $proyectosl = $this->Postulantes->Proyectos->find('list', [
            'conditions' => ['Proyectos.postulante_id' => $id],
            'keyField' => 'id',
            'valueField' => 'razon_social'
        ]);
        $proyectos = $this->Postulantes->Proyectos->find('all', [
            'conditions' => ['Proyectos.postulante_id' => $id],
            'contain' => ['Documentos' => ['fields' => ['Documentos.proyecto_id', 'Documentos.nombre', 'Documentos.estado']]]
        ]);
        $querytipos = $this->getTableLocator()->get('Tipos');
        $tipos = $querytipos->find()->all();

        $this->set(compact('postulante', 'tipos', 'proyectos', 'proyectosl'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $postulante = $this->Postulantes->newEmptyEntity();
        if ($this->request->is('post')) {
            $postulante = $this->Postulantes->patchEntity($postulante, $this->request->getData());
            if ($this->Postulantes->save($postulante)) {
                $this->Flash->success(__('The postulante has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The postulante could not be saved. Please, try again.'));
        }
        $this->set(compact('postulante'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Postulante id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $postulante = $this->Postulantes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postulante = $this->Postulantes->patchEntity($postulante, $this->request->getData());
            if ($this->Postulantes->save($postulante)) {
                $this->Flash->success(__('The postulante has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The postulante could not be saved. Please, try again.'));
        }
        $this->set(compact('postulante'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Postulante id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $postulante = $this->Postulantes->get($id);
        if ($this->Postulantes->delete($postulante)) {
            $this->Flash->success(__('The postulante has been deleted.'));
        } else {
            $this->Flash->error(__('The postulante could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
