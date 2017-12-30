<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Email\Email;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Colectivos Controller
 *
 * @property \App\Model\Table\ColectivosTable $Colectivos
 */
class ColectivosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
       
         $this->paginate = [
            'conditions'=>array('and'=>array('Colectivos.estado'=>1)),
            'order'=>['Colectivos.id DESC'],
            'limit'=>25
        ];
        $colectivos = $this->paginate($this->Colectivos);

        $this->set(compact('colectivos'));
        $this->set('_serialize', ['colectivos']);
    }

    /**
     * View method
     *
     * @param string|null $id Colectivo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $colectivo = $this->Colectivos->get($id, [
            'contain' => []
        ]);

        $this->set('colectivo', $colectivo);
        $this->set('_serialize', ['colectivo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $colectivo = $this->Colectivos->newEntity();
        if ($this->request->is('post')) {
            $colectivo = $this->Colectivos->patchEntity($colectivo, $this->request->data);
            if ($this->Colectivos->save($colectivo)) {
                $this->Flash->success(__('The colectivo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The colectivo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('colectivo'));
        $this->set('_serialize', ['colectivo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Colectivo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $colectivo = $this->Colectivos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $colectivo = $this->Colectivos->patchEntity($colectivo, $this->request->data);
            if ($this->Colectivos->save($colectivo)) {
                $this->Flash->success(__('The colectivo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The colectivo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('colectivo'));
        $this->set('_serialize', ['colectivo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Colectivo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $colectivo = $this->Colectivos->get($id);
        if ($this->Colectivos->delete($colectivo)) {
            $this->Flash->success(__('The colectivo has been deleted.'));
        } else {
            $this->Flash->error(__('The colectivo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /********************************* SERVICES**********************************************/

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addEntity()
    {

        //$usuario = $this->Usuarios->newEntity();

        if ($this->request->is('post')) {

            try{

                $colectivo = $this->Colectivos->newEntity($this->request->data);

                if ($this->Colectivos->save($colectivo)) {
                    $mensaje = "ok";
                } else {
                    $mensaje = "error";
                }

            }catch (\PDOException $e)
            {

                $mensaje = "error";
                $this->Flash->error(__('Error al guardar. vuelva a intentar.').$e);
            }
        }

        $this->set([
            'mensaje' => $mensaje,
            'colectivo' => $colectivo,
            '_serialize' => ['mensaje', 'colectivo']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }

     /**
     * Edit method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editEntity($id = null)
    {

        $colectivo =$this->Colectivos->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            try{

                $colectivo = $this->Colectivos->patchEntity($colectivo, $this->request->data);
                if ($this->Colectivos->save($colectivo)) {
                    $mensaje = "ok.";
                } else {
                    $mensaje = "error";
                }

            }catch (\PDOException $e)
            {

                $mensaje = "error.";
                $this->Flash->error(__('Error al editar. vuelva a intentar.'));
            }


        }

        $this->set([
            'mensaje' => $mensaje,
            'colectivo' => $colectivo,
            '_serialize' => ['mensaje', 'colectivo']
        ]);
        $this->viewClass = 'Json';
        $this->render();
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function getEntity($id = null)
    {

        $colectivo = $this->Colectivos->find('all',
            array('conditions'=>array('Colectivos.id'=>$id)));

        $this->set([
             'colectivo' => $colectivo,
            '_serialize' => ['colectivo']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function deleteEntity($id = null)
    {
        $message = "";
        try{

            $colectivo = TableRegistry::get('Colectivos');
            $query = $colectivo->query();
            $query->update()
                ->set(['estado' => 0])
                ->where(['id' => $id])
                ->execute();
            if($query){
                $message = "dato borrado correctamente.";
            }else{
                $message = "no se pudo borrar el registro.";
            }

         }catch (\PDOException $e)
        {

            $mensaje = "error al eliminar.";
            $this->Flash->error(__('Error al eliminar. vuelva a intentar.'));
        }

        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }


}
