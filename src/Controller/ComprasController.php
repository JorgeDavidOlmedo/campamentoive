<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

/**
 * Compras Controller
 *
 * @property \App\Model\Table\ComprasTable $Compras
 */
class ComprasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $id_empresa = $this->request->session()->read('id_empresa');
        
        $this->paginate = [
            'contain' => ['Proveedores'],
            'conditions'=>array('and'=>array('Compras.estado'=>1),
                array('Compras.id_empresa'=>$id_empresa)),
            'order'=>['Compras.id DESC'],
            'limit'=>25
        ];

        $compras = $this->paginate($this->Compras);

        $this->set(compact('compras'));
        $this->set('_serialize', ['compras']);
    }

    /**
     * View method
     *
     * @param string|null $id Compra id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $id_empresa = $this->request->session()->read('id_empresa');

        $compra = $this->Compras->get($id, [
            'contain' => ['Proveedores','DetallesCompras','DetallesCompras.Productos'],
            'conditions'=>array("Compras.id_empresa"=>$id_empresa)
        ]);

        $this->set('compra', $compra);
        $this->set('_serialize', ['compra']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $compra = $this->Compras->newEntity();
        if ($this->request->is('post')) {
            $compra = $this->Compras->patchEntity($compra, $this->request->data);
            if ($this->Compras->save($compra)) {
                $this->Flash->success(__('The compra has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The compra could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('compra'));
        $this->set('_serialize', ['compra']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Compra id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $compra = $this->Compras->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $compra = $this->Compras->patchEntity($compra, $this->request->data);
            if ($this->Compras->save($compra)) {
                $this->Flash->success(__('The compra has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The compra could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('compra'));
        $this->set('_serialize', ['compra']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Compra id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $compra = $this->Compras->get($id);
        if ($this->Compras->delete($compra)) {
            $this->Flash->success(__('The compra has been deleted.'));
        } else {
            $this->Flash->error(__('The compra could not be deleted. Please, try again.'));
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
        
        if ($this->request->is('post')) {


            $conn = ConnectionManager::get('default');
            $conn->begin();
           
            try{
                $compra = $this->Compras->newEntity($this->request->data);
               
                if ($this->Compras->save($compra)) {
                    
                    $mensaje = "ok.";
                    $conn->commit();
                    //$this->Flash->success(__('La Compra se guardo correctamente.'));

                } else {
                    $mensaje = "error.";
                    $conn->rollback();
                }

            }catch (\PDOException $e)
            {

                $mensaje = "error.".$e;
                $conn->rollback();
                $this->Flash->error(__('Error al guardar. vuelva a intentar.'.$e));
            }
        }

        $this->set([
            'mensaje' => $mensaje,
            'compra' => $compra,
            '_serialize' => ['mensaje', 'compra']
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

        $usuario =$this->Usuarios->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            try{

                $usuario = $this->Usuarios->patchEntity($usuario, $this->request->data);
                if ($this->Usuarios->save($usuario)) {
                    $mensaje = "Usuario modificado.";
                } else {
                    $mensaje = "error al modificar.";
                }

            }catch (\PDOException $e)
            {

                $mensaje = "error al editar.";
                $this->Flash->error(__('Error al editar. vuelva a intentar.'));
            }


        }

        $this->set([
            'mensaje' => $mensaje,
            'usuario' => $usuario,
            '_serialize' => ['mensaje', 'usuario']
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

        $usuario = $this->Usuarios->find('all',
            array('conditions'=>array('Usuarios.id'=>$id)));

        $this->set([
            'usuario' => $usuario,
            '_serialize' => ['usuario']
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
            $conn = ConnectionManager::get('default');
            $conn->begin();

            $id_empresa = $this->request->session()->read('id_empresa');

            $this->loadModel("Stock");
            $stock = TableRegistry::get('Stock');
            $query_stock = $stock->query();
            $query_stock->update()
                ->set(['estado' => 0])
                ->where(['id_compra' => $id])
                ->execute();

            $compra = TableRegistry::get('Compras');
            $query = $compra->query();
            $query->update()
                ->set(['estado' => 0])
                ->where(['id' => $id])
                ->execute();


            if($query){
              
                    $conn->commit();
                    $message = "ok";
             
            }else{
                $conn->rollback();
                $message = "error";
            }

        }catch (\PDOException $e)
        {

            $message = "error al eliminar.";

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
    public function getEntityAll()
    {

        $usuarios = $this->Usuarios->find('all',array('conditions'=>array('estado'=>1),'order'=>array("id desc")));

        $this->set([
            'usuarios' => $usuarios,
            '_serialize' => ['usuarios']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }

   
    /**
     * limitedSearch method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function limitedSearch()
    {
        if ($this->request->is('ajax')) {

            $valor = $_POST['valor'];

            $resultado = $this->Usuarios->find("all",array("conditions"=>array("nombre LIKE "=>"%$valor%"),"limit"=>50));

            $usuarios = [];

            foreach ($resultado as $value){

                $usuarios[]=[
                    'value'=>$value->id,
                    'label'=>$value->nombre
                ];
            }

            $this->set([
                'usuarios' => $usuarios,
                '_serialize' => ['usuarios']
            ]);
            $this->viewClass = 'Json';
            $this->render();

        }

    }

    /*****************consultar Compras por tiempo*********************/
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function comprasForTime(){


        if ($this->request->is('ajax')) {


            $id_empresa = $this->request->session()->read('id_empresa');
            $desde = $_POST['desde'];
            $hasta = $_POST['hasta'];

            $results=null;
            $connection = ConnectionManager::get('default');


            $results = $connection->execute("SELECT if(a.tipo_cambio>1,sum((a.total*a.tipo_cambio)),sum(a.total)) as suma, a.fecha as fecha FROM compras a WHERE (a.fecha >= '".$desde."' and a.fecha <= '".$hasta."') and a.id_empresa=".$id_empresa." and a.estado=1 GROUP BY a.fecha");


            $miarray=array();
            $sumatoria=0;


            foreach ($results as $value) {
                $sumatoria=$sumatoria+1;

                $miarray[] = array('label'=> date('d/m/Y',strtotime($value['fecha'])),
                    'y'=>intval($value['suma'])
                );
            }

            $this->RequestHandler->respondAs('json');
            $this->autoRender = false;
            echo json_encode ( $miarray );
        }

    }

   
      /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function getEntityByTerm($term = null)
    {

        $results=null;
        $connection = ConnectionManager::get('default');
        $id_empresa = $this->request->session()->read('id_empresa');

        //PROVEEDORES
        $results = $connection->execute(
            "SELECT id,documento,fecha,total
            FROM compras 
            WHERE id_empresa=".$id_empresa." and estado=1 and 
            (documento like '%".$term."%')");

        $resultado_valor = array();
        foreach ($results as $value){
            $resultado_valor[] = array("id"=>$value['id'],
                "documento"=> $value['documento'],
                "fecha"=> date('d/m/Y',strtotime($value['fecha'])),
                "total"=>number_format($value['total']));
        }

        $result = $resultado_valor;
        $this->set([
            'result' => $result,
            '_serialize' => ['result']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }

   
}
