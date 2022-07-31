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
class TiposController extends AppController {

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
        $tipos = $this->paginate($this->Tipos);

        $this->set(compact('tipos'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $tipo = $this->Tipos->newEmptyEntity();
        if ($this->request->is('post')) {
            $tipo = $this->Tipos->patchEntity($tipo, $this->request->getData());
            if ($this->Tipos->save($tipo)) {
                $this->Flash->success(__('The tipo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo could not be saved. Please, try again.'));
        }
        $this->set(compact('tipo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Documento id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $tipo = $this->Tipos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nomarch = $this->request->getData('nombre');
            $oldname = $this->request->getData('oldnombre');
            $tipo = $this->Tipos->patchEntity($tipo, $this->request->getData());
            if ($this->Tipos->save($tipo)) {
                $this->_actualizarnombres($nomarch, $oldname);

                $this->Flash->success(__('The tipo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo could not be saved. Please, try again.'));
        }
        $this->set(compact('tipo'));
    }

    private function _actualizarnombres($name, $oldname) {
        $querydocs = $this->getTableLocator()->get('Documentos');
        $docs = $querydocs->query()
                ->update()
                ->set(['nombre' => $name])
                ->where(['nombre' => $oldname])
                ->execute();
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
        $tipo = $this->Tipos->get($id);
        if ($this->Tipos->delete($tipo)) {
            $this->Flash->success(__('The tipo has been deleted.'));
        } else {
            $this->Flash->error(__('The tipo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
