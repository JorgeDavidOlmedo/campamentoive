<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Inscripciones Controller
 *
 * @property \App\Model\Table\InscripcionesTable $Inscripciones
 */
class InscripcionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $this->paginate = [
            'contain'=>array('Personas','Colectivos'),
            'conditions'=>array('and'=>array('Inscripciones.estado'=>1)),
            'order'=>['Inscripciones.id DESC'],
            'limit'=>25
        ];

        $inscripciones = $this->paginate($this->Inscripciones);

        $this->set(compact('inscripciones'));
        $this->set('_serialize', ['inscripciones']);
    }

    /**
     * View method
     *
     * @param string|null $id Inscripcione id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inscripcione = $this->Inscripciones->get($id, [
            'contain' => []
        ]);

        $this->set('inscripcione', $inscripcione);
        $this->set('_serialize', ['inscripcione']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $inscripcione = $this->Inscripciones->newEntity();
        if ($this->request->is('post')) {
            $inscripcione = $this->Inscripciones->patchEntity($inscripcione, $this->request->data);
            if ($this->Inscripciones->save($inscripcione)) {
                $this->Flash->success(__('The inscripcione has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The inscripcione could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('inscripcione'));
        $this->set('_serialize', ['inscripcione']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Inscripcione id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $inscripcione = $this->Inscripciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $inscripcione = $this->Inscripciones->patchEntity($inscripcione, $this->request->data);
            if ($this->Inscripciones->save($inscripcione)) {
                $this->Flash->success(__('The inscripcione has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The inscripcione could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('inscripcione'));
        $this->set('_serialize', ['inscripcione']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Inscripcione id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $inscripcione = $this->Inscripciones->get($id);
        if ($this->Inscripciones->delete($inscripcione)) {
            $this->Flash->success(__('The inscripcione has been deleted.'));
        } else {
            $this->Flash->error(__('The inscripcione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
