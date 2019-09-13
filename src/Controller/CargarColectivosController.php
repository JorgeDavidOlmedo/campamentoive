<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CargarColectivos Controller
 *
 * @property \App\Model\Table\CargarColectivosTable $CargarColectivos
 */
class CargarColectivosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $cargarColectivos = $this->paginate($this->CargarColectivos);

        $this->set(compact('cargarColectivos'));
        $this->set('_serialize', ['cargarColectivos']);
    }

    /**
     * View method
     *
     * @param string|null $id Cargar Colectivo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cargarColectivo = $this->CargarColectivos->get($id, [
            'contain' => []
        ]);

        $this->set('cargarColectivo', $cargarColectivo);
        $this->set('_serialize', ['cargarColectivo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cargarColectivo = $this->CargarColectivos->newEntity();
        if ($this->request->is('post')) {
            $cargarColectivo = $this->CargarColectivos->patchEntity($cargarColectivo, $this->request->data);
            if ($this->CargarColectivos->save($cargarColectivo)) {
                $this->Flash->success(__('The cargar colectivo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cargar colectivo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cargarColectivo'));
        $this->set('_serialize', ['cargarColectivo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cargar Colectivo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cargarColectivo = $this->CargarColectivos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cargarColectivo = $this->CargarColectivos->patchEntity($cargarColectivo, $this->request->data);
            if ($this->CargarColectivos->save($cargarColectivo)) {
                $this->Flash->success(__('The cargar colectivo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cargar colectivo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cargarColectivo'));
        $this->set('_serialize', ['cargarColectivo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cargar Colectivo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cargarColectivo = $this->CargarColectivos->get($id);
        if ($this->CargarColectivos->delete($cargarColectivo)) {
            $this->Flash->success(__('The cargar colectivo has been deleted.'));
        } else {
            $this->Flash->error(__('The cargar colectivo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
