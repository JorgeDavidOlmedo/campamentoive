<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DetallePerfil Controller
 *
 * @property \App\Model\Table\DetallePerfilTable $DetallePerfil
 */
class DetallePerfilController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $detallePerfil = $this->paginate($this->DetallePerfil);

        $this->set(compact('detallePerfil'));
        $this->set('_serialize', ['detallePerfil']);
    }

    /**
     * View method
     *
     * @param string|null $id Detalle Perfil id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $detallePerfil = $this->DetallePerfil->get($id, [
            'contain' => []
        ]);

        $this->set('detallePerfil', $detallePerfil);
        $this->set('_serialize', ['detallePerfil']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $detallePerfil = $this->DetallePerfil->newEntity();
        if ($this->request->is('post')) {
            $detallePerfil = $this->DetallePerfil->patchEntity($detallePerfil, $this->request->data);
            if ($this->DetallePerfil->save($detallePerfil)) {
                $this->Flash->success(__('The detalle perfil has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The detalle perfil could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('detallePerfil'));
        $this->set('_serialize', ['detallePerfil']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Detalle Perfil id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $detallePerfil = $this->DetallePerfil->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $detallePerfil = $this->DetallePerfil->patchEntity($detallePerfil, $this->request->data);
            if ($this->DetallePerfil->save($detallePerfil)) {
                $this->Flash->success(__('The detalle perfil has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The detalle perfil could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('detallePerfil'));
        $this->set('_serialize', ['detallePerfil']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Detalle Perfil id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $detallePerfil = $this->DetallePerfil->get($id);
        if ($this->DetallePerfil->delete($detallePerfil)) {
            $this->Flash->success(__('The detalle perfil has been deleted.'));
        } else {
            $this->Flash->error(__('The detalle perfil could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
