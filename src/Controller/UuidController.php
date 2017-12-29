<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Uuid Controller
 *
 * @property \App\Model\Table\UuidTable $Uuid
 */
class UuidController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $uuid = $this->paginate($this->Uuid);

        $this->set(compact('uuid'));
        $this->set('_serialize', ['uuid']);
    }

    /**
     * View method
     *
     * @param string|null $id Uuid id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $uuid = $this->Uuid->get($id, [
            'contain' => []
        ]);

        $this->set('uuid', $uuid);
        $this->set('_serialize', ['uuid']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $uuid = $this->Uuid->newEntity();
        if ($this->request->is('post')) {
            $uuid = $this->Uuid->patchEntity($uuid, $this->request->data);
            if ($this->Uuid->save($uuid)) {
                $this->Flash->success(__('The uuid has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The uuid could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('uuid'));
        $this->set('_serialize', ['uuid']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Uuid id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $uuid = $this->Uuid->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $uuid = $this->Uuid->patchEntity($uuid, $this->request->data);
            if ($this->Uuid->save($uuid)) {
                $this->Flash->success(__('The uuid has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The uuid could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('uuid'));
        $this->set('_serialize', ['uuid']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Uuid id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $uuid = $this->Uuid->get($id);
        if ($this->Uuid->delete($uuid)) {
            $this->Flash->success(__('The uuid has been deleted.'));
        } else {
            $this->Flash->error(__('The uuid could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
