<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Configuracion Controller
 *
 * @property \App\Model\Table\ConfiguracionTable $Configuracion
 */
class ConfiguracionController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $configuracion = $this->paginate($this->Configuracion);

        $this->set(compact('configuracion'));
        $this->set('_serialize', ['configuracion']);
    }

    /**
     * View method
     *
     * @param string|null $id Configuracion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $configuracion = $this->Configuracion->get($id, [
            'contain' => []
        ]);

        $this->set('configuracion', $configuracion);
        $this->set('_serialize', ['configuracion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $configuracion = $this->Configuracion->newEntity();
        if ($this->request->is('post')) {
            $configuracion = $this->Configuracion->patchEntity($configuracion, $this->request->data);
            if ($this->Configuracion->save($configuracion)) {
                $this->Flash->success(__('The configuracion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The configuracion could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('configuracion'));
        $this->set('_serialize', ['configuracion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Configuracion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $configuracion = $this->Configuracion->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $configuracion = $this->Configuracion->patchEntity($configuracion, $this->request->data);
            if ($this->Configuracion->save($configuracion)) {
                $this->Flash->success(__('The configuracion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The configuracion could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('configuracion'));
        $this->set('_serialize', ['configuracion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Configuracion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $configuracion = $this->Configuracion->get($id);
        if ($this->Configuracion->delete($configuracion)) {
            $this->Flash->success(__('The configuracion has been deleted.'));
        } else {
            $this->Flash->error(__('The configuracion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
