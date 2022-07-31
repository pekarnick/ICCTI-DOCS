<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Proyectos Controller
 *
 * @property \App\Model\Table\ProyectosTable $Proyectos
 * @method \App\Model\Entity\Proyecto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProyectosController extends AppController {

    public function beforeFilter(\Cake\Event\EventInterface $event) {
        parent::beforeFilter($event);
        if ($this->Authentication->getIdentity()) {
            $rol = $this->Authentication->getIdentity()->get('rol');
            if ($rol != 0) {
                return $this->redirect(['prefix' => false, 'controller' => 'postulantes', 'action' => 'inicio']);
            }
        }
    }

    public function bloquear($proyecto_id, $postulante_id) {
        $proyecto = $this->Proyectos->get($proyecto_id, [
            'contain' => [],
        ]);
        $proyecto->bloqueado = 1;
        $this->Proyectos->save($proyecto);
        
        $this->Flash->success('Proyecto bloqueado');
        return $this->redirect(['controller' => 'Postulantes','action' => 'view', $postulante_id]);
    }

    public function desbloquear($proyecto_id, $postulante_id) {
        $proyecto = $this->Proyectos->get($proyecto_id, [
            'contain' => [],
        ]);
        $proyecto->bloqueado = "";
        $this->Proyectos->save($proyecto);
        
        $this->Flash->success('Proyecto desbloqueado');
        return $this->redirect(['controller' => 'Postulantes','action' => 'view', $postulante_id]);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Postulantes'],
        ];
        $proyectos = $this->paginate($this->Proyectos);

        $this->set(compact('proyectos'));
    }

    /**
     * View method
     *
     * @param string|null $id Proyecto id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $proyecto = $this->Proyectos->get($id, [
            'contain' => ['Postulantes', 'Documentos'],
        ]);

        $this->set(compact('proyecto'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $proyecto = $this->Proyectos->newEmptyEntity();
        if ($this->request->is('post')) {
            $proyecto = $this->Proyectos->patchEntity($proyecto, $this->request->getData());
            if ($this->Proyectos->save($proyecto)) {
                $this->Flash->success(__('The proyecto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The proyecto could not be saved. Please, try again.'));
        }
        $postulantes = $this->Proyectos->Postulantes->find('list', ['limit' => 200])->all();
        $this->set(compact('proyecto', 'postulantes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Proyecto id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $proyecto = $this->Proyectos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proyecto = $this->Proyectos->patchEntity($proyecto, $this->request->getData());
            if ($this->Proyectos->save($proyecto)) {
                $this->Flash->success(__('The proyecto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The proyecto could not be saved. Please, try again.'));
        }
        $postulantes = $this->Proyectos->Postulantes->find('list', ['limit' => 200])->all();
        $this->set(compact('proyecto', 'postulantes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Proyecto id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $proyecto = $this->Proyectos->get($id);
        if ($this->Proyectos->delete($proyecto)) {
            $this->Flash->success(__('The proyecto has been deleted.'));
        } else {
            $this->Flash->error(__('The proyecto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
