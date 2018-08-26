<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EquipoTmp Controller
 *
 * @property \App\Model\Table\EquipoTmpTable $EquipoTmp
 */
class EquipoTmpController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $equipoTmp = $this->paginate($this->EquipoTmp);

        $this->set(compact('equipoTmp'));
        $this->set('_serialize', ['equipoTmp']);
    }

    /**
     * View method
     *
     * @param string|null $id Equipo Tmp id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $equipoTmp = $this->EquipoTmp->get($id, [
            'contain' => []
        ]);

        $this->set('equipoTmp', $equipoTmp);
        $this->set('_serialize', ['equipoTmp']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $equipoTmp = $this->EquipoTmp->newEntity();
        if ($this->request->is('post')) {
            $equipoTmp = $this->EquipoTmp->patchEntity($equipoTmp, $this->request->data);
            if ($this->EquipoTmp->save($equipoTmp)) {
                $this->Flash->success(__('The equipo tmp has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The equipo tmp could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('equipoTmp'));
        $this->set('_serialize', ['equipoTmp']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Equipo Tmp id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $equipoTmp = $this->EquipoTmp->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $equipoTmp = $this->EquipoTmp->patchEntity($equipoTmp, $this->request->data);
            if ($this->EquipoTmp->save($equipoTmp)) {
                $this->Flash->success(__('The equipo tmp has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The equipo tmp could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('equipoTmp'));
        $this->set('_serialize', ['equipoTmp']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Equipo Tmp id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $equipoTmp = $this->EquipoTmp->get($id);
        if ($this->EquipoTmp->delete($equipoTmp)) {
            $this->Flash->success(__('The equipo tmp has been deleted.'));
        } else {
            $this->Flash->error(__('The equipo tmp could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
