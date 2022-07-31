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
class MiscelaneasController extends AppController {

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
            'contain' => [],
        ];
        $miscelaneas = $this->paginate($this->Miscelaneas);

        $this->set(compact('miscelaneas'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $miscelanea = $this->Miscelaneas->newEmptyEntity();
        if ($this->request->is('post')) {
            $miscelanea = $this->Miscelaneas->patchEntity($miscelanea, $this->request->getData());
            if ($this->Miscelaneas->save($miscelanea)) {
                $this->Flash->success('Clave guardada correctamente');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Error al guardar la clave');
        }
        $this->set(compact('miscelanea'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Documento id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $miscelanea = $this->Miscelaneas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $miscelanea = $this->Miscelaneas->patchEntity($miscelanea, $this->request->getData());
            if ($this->Miscelaneas->save($miscelanea)) {
                $this->Flash->success('Clave actualizada');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Error al intentar actualizar la clave');
        }
        $this->set(compact('miscelanea'));
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
        $miscelanea = $this->Miscelaneas->get($id);
        if ($this->Miscelaneas->delete($miscelanea)) {
            $this->Flash->success('Clave eliminada');
        } else {
            $this->Flash->error('Error al borrar la clave');
        }

        return $this->redirect(['action' => 'index']);
    }

}
