<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Documentos Controller
 *
 * @property \App\Model\Table\DocumentosTable $Documentos
 * @method \App\Model\Entity\Documento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocumentosController extends AppController {

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
    public function index() {
        $this->paginate = [
            'contain' => ['Postulantes'],
        ];
        $documentos = $this->paginate($this->Documentos);

        $this->set(compact('documentos'));
    }

    /**
     * View method
     *
     * @param string|null $id Documento id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $documento = $this->Documentos->get($id, [
            'contain' => ['Postulantes'],
        ]);

        $this->set(compact('documento'));
    }
    
    public function preview($id = null) {
        $documento = $this->Documentos->get($id, [
            'contain' => ['Postulantes'],
        ]);

        $this->set(compact('documento'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $documento = $this->Documentos->newEmptyEntity();
        if ($this->request->is('post')) {
            $documento = $this->Documentos->patchEntity($documento, $this->request->getData());
            if ($this->Documentos->save($documento)) {
                $this->Flash->success(__('The documento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The documento could not be saved. Please, try again.'));
        }
        $postulantes = $this->Documentos->Postulantes->find('list', ['limit' => 200])->all();
        $this->set(compact('documento', 'postulantes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Documento id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $documento = $this->Documentos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $documento = $this->Documentos->patchEntity($documento, $this->request->getData());
            if ($this->Documentos->save($documento)) {
                $this->Flash->success(__('The documento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The documento could not be saved. Please, try again.'));
        }
        $postulantes = $this->Documentos->Postulantes->find('list', ['limit' => 200])->all();
        $this->set(compact('documento', 'postulantes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Documento id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $documento = $this->Documentos->get($id);
        if ($this->Documentos->delete($documento)) {
            $this->Flash->success(__('The documento has been deleted.'));
        } else {
            $this->Flash->error(__('The documento could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
