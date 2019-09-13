<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Email\Email;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;


/**
 * Lugares Controller
 *
 * @property \App\Model\Table\LugaresTable $Lugares
 */
class LugaresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $this->paginate = [
            'conditions'=>array('and'=>array('Lugares.estado'=>1)),
            'order'=>['Lugares.id DESC'],
            'limit'=>100
        ];
        $lugares = $this->paginate($this->Lugares);

        $this->set(compact('lugares'));
        $this->set('_serialize', ['lugares']);
    }

    /**
     * View method
     *
     * @param string|null $id Lugare id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lugare = $this->Lugares->get($id, [
            'contain' => []
        ]);

        $this->set('lugare', $lugare);
        $this->set('_serialize', ['lugare']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lugare = $this->Lugares->newEntity();
        if ($this->request->is('post')) {
            $lugare = $this->Lugares->patchEntity($lugare, $this->request->data);
            if ($this->Lugares->save($lugare)) {
                $this->Flash->success(__('The lugare has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lugare could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('lugare'));
        $this->set('_serialize', ['lugare']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Lugare id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lugare = $this->Lugares->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lugare = $this->Lugares->patchEntity($lugare, $this->request->data);
            if ($this->Lugares->save($lugare)) {
                $this->Flash->success(__('The lugare has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lugare could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('lugare'));
        $this->set('_serialize', ['lugare']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lugare id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lugare = $this->Lugares->get($id);
        if ($this->Lugares->delete($lugare)) {
            $this->Flash->success(__('The lugare has been deleted.'));
        } else {
            $this->Flash->error(__('The lugare could not be deleted. Please, try again.'));
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

                $lugar = $this->Lugares->newEntity($this->request->data);

                if ($this->Lugares->save($lugar)) {
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
            'lugar' => $lugar,
            '_serialize' => ['mensaje', 'lugar']
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

        $lugar =$this->Lugares->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            try{

                $colectivo = $this->Lugares->patchEntity($lugar, $this->request->data);
                if ($this->Lugares->save($lugar)) {
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
            'lugar' => $lugar,
            '_serialize' => ['mensaje', 'lugar']
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

        $lugar = $this->Lugares->find('all',
            array('conditions'=>array('Lugares.id'=>$id)));

        $this->set([
            'lugar' => $lugar,
            '_serialize' => ['lugar']
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

            $lugar = TableRegistry::get('Lugares');
            $query = $lugar->query();
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

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function getEntityAllByTerm($term = null)
    {

        $results=null;
        $connection = ConnectionManager::get('default');
        $id_empresa = $this->request->session()->read('id_empresa');

        //CLIENTES
        $results = $connection->execute(
            "SELECT id,descripcion FROM lugares WHERE estado=1 and
            (descripcion like '%".$term."%')");

        $resultado_lugar = array();
        foreach ($results as $value){
            $resultado_lugar[] = array("id"=>$value['id'],
                "descripcion"=> $value['descripcion']);

        }

        $des = "No existe";
        if( count($results)<=0 ) {
            $resultado_lugar[] = array("id"=>"00",
                "descripcion"=> "Agregar lugar");
        }

        $lugares = $resultado_lugar;
        $this->set([
            'lugares' => $lugares,
            '_serialize' => ['lugares']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }



}

