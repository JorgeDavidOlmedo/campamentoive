<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

/**
 * Empresas Controller
 *
 * @property \App\Model\Table\EmpresasTable $Empresas
 */
class EmpresasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        

         $this->paginate = [
            'order'=>['Empresas.id DESC']
        ];

        $empresas = $this->paginate($this->Empresas);

        $this->set(compact('empresas'));
        $this->set('_serialize', ['empresas']);
    }

    /**
     * View method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $id_empresa = $this->request->session()->read('id_empresa');
        $empresa = $this->Empresas->get($id, [
            'contain' => [],
            'conditions'=>['estado'=>1]
        ]);

        $this->set('empresa', $empresa);
        $this->set('_serialize', ['empresa']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $empresa = $this->Empresas->newEntity();
        if ($this->request->is('post')) {
            $empresa = $this->Empresas->patchEntity($empresa, $this->request->data);
            if ($this->Empresas->save($empresa)) {
                $this->Flash->success(__('The empresa has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The empresa could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('empresa'));
        $this->set('_serialize', ['empresa']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $empresa = $this->Empresas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $empresa = $this->Empresas->patchEntity($empresa, $this->request->data);
            if ($this->Empresas->save($empresa)) {
                $this->Flash->success(__('The empresa has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The empresa could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('empresa'));
        $this->set('_serialize', ['empresa']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $empresa = $this->Empresas->get($id);
        if ($this->Empresas->delete($empresa)) {
            $this->Flash->success(__('The empresa has been deleted.'));
        } else {
            $this->Flash->error(__('The empresa could not be deleted. Please, try again.'));
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

                $empresa = $this->Empresas->newEntity($this->request->data);

                if ($this->Empresas->save($empresa)) {
                    $mensaje = "empresa guardada.";
                  //  $this->Flash->success(__('La empresa se guardo correctamente.'));
                } else {
                    $mensaje = "error al guardar.";
                    //$this->Flash->error(__('Error al guardar, vuelva a intentar.'));
                }

            }catch (\PDOException $e)
            {

                $mensaje = "error al eliminar.";
                $this->Flash->error(__('Error al eliminar. vuelva a intentar.'.$e));
            }
        }

        $this->set([
            'mensaje' => $mensaje,
            'empresa' => $empresa,
            '_serialize' => ['mensaje', 'empresa']
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

        $empresa =$this->Empresas->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            try{

                $empresa = $this->Empresas->patchEntity($empresa, $this->request->data);
                if ($this->Empresas->save($empresa)) {
                    $mensaje = "Empresa modificado.";
                    //$this->Flash->success(__('La empresa se modifico correctamente.'));
                } else {
                    $mensaje = "error al modificar.";
                   // $this->Flash->error(__('Error al modificar, vuelva a intentar.'));
                }

            }catch (\PDOException $e)
            {

                $mensaje = "error al eliminar.";
                //$this->Flash->error(__('Error al eliminar. vuelva a intentar.'));
            }

        }

        $this->set([
            'mensaje' => $mensaje,
            'empresa' => $empresa,
            '_serialize' => ['mensaje', 'empresa']
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

        $empresa = $this->Empresas->find('all',
            array('conditions'=>array('Empresas.id'=>$id)));

        $this->set([
            'empresa' => $empresa,
            '_serialize' => ['empresa']
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

            $empresa = TableRegistry::get('Empresas');
            $query = $empresa->query();
            $query->update()
                ->set(['estado' => false])
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
    public function getEntityAll($empresa = null,$idEmpresa = null)
    {

        $empresas = $this->Empresas->find('all',array('conditions'=>array('estado'=>1),'order'=>array('id desc')));

        $this->set([
            'empresas' => $empresas,
            '_serialize' => ['empresas']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }

     /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function getPlanDeCuentasStandar()
    {
        $this->loadModel('planDeCuentasStandar');
        $plan = $this->planDeCuentasStandar->find('all',array('conditions'=>array('estado'=>1)));

        $this->set([
            'plan' => $plan,
            '_serialize' => ['plan']
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

        $results = $connection->execute(
            "SELECT id,descripcion,ruc FROM empresas WHERE estado=1 and 
            (descripcion like '%".$term."%')");

        $resultado_empresa = array();
        foreach ($results as $value){
           // $resultado_empresa[] = array("descripcion_html"=>$value['id'].' -&nbsp;&nbsp;<font color="black"><b>Descripcion:&nbsp;</b></font>&nbsp;'.$value['descripcion'].' &nbsp;&nbsp;<font color="black"><b>Documento:&nbsp;</b></font>&nbsp;'.$value['ruc']);
           $resultado_empresa[] = array("id"=>$value['id'],
           "descripcion"=> $value['descripcion'],
           "ruc"=> $value['ruc']); 
        }

        $empresas = $resultado_empresa;

        $this->set([
            'empresas' => $empresas,
            '_serialize' => ['empresas']
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

}
