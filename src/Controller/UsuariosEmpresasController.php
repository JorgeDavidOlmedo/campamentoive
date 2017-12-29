<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\Log\Log;

/**
 * UsuariosEmpresas Controller
 *
 * @property \App\Model\Table\UsuariosEmpresasTable $UsuariosEmpresas
 */
class UsuariosEmpresasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        /*$this->loadModel("Usuarios");
        $this->loadModel("Empresas");
        $usuariosEmpresas = $this->paginate($this->UsuariosEmpresas->find('all',array('contain'=>array('Usuarios','Empresas'))));

        $this->set(compact('usuariosEmpresas'));
        $this->set('_serialize', ['usuariosEmpresas']);*/
        $this->loadModel('UsuariosEmpresas');
        $id_empresa = $this->request->session()->read('id_empresa');
           if($this->request->session()->read('Auth.User.rol')=="admin"){
               $this->paginate = [
                   'contain'=>['Usuarios','Empresas','Usuarios.Perfil'],
                   'conditions'=>array('and'=>array('UsuariosEmpresas.estado'=>1)),
                    'order'=>['UsuariosEmpresas.id DESC'],
                    'limit'=>25];
            }else{
               $this->paginate = [
                   'contain'=>['Usuarios','Empresas','Usuarios.Perfil'],
                   'conditions'=>array('and'=>array('UsuariosEmpresas.estado'=>1),
                    array('UsuariosEmpresas.id_empresa'=>$id_empresa)),
                    'order'=>['UsuariosEmpresas.id DESC'],
                    'limit'=>25];
            }

        $usuarios = $this->paginate($this->UsuariosEmpresas);
        $this->set(compact('usuarios'));
        $this->set('_serialize', ['usuarios']);
    }

    /**
     * View method
     *
     * @param string|null $id Usuarios Empresa id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usuariosEmpresa = $this->UsuariosEmpresas->get($id, [
            'contain' => []
        ]);

        $this->set('usuariosEmpresa', $usuariosEmpresa);
        $this->set('_serialize', ['usuariosEmpresa']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usuariosEmpresa = $this->UsuariosEmpresas->newEntity();
        if ($this->request->is('post')) {
            $usuariosEmpresa = $this->UsuariosEmpresas->patchEntity($usuariosEmpresa, $this->request->data);
            if ($this->UsuariosEmpresas->save($usuariosEmpresa)) {
                $this->Flash->success(__('The usuarios empresa has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The usuarios empresa could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('usuariosEmpresa'));
        $this->set('_serialize', ['usuariosEmpresa']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuarios Empresa id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usuariosEmpresa = $this->UsuariosEmpresas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usuariosEmpresa = $this->UsuariosEmpresas->patchEntity($usuariosEmpresa, $this->request->data);
            if ($this->UsuariosEmpresas->save($usuariosEmpresa)) {
                $this->Flash->success(__('The usuarios empresa has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The usuarios empresa could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('usuariosEmpresa'));
        $this->set('_serialize', ['usuariosEmpresa']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuarios Empresa id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuariosEmpresa = $this->UsuariosEmpresas->get($id);
        if ($this->UsuariosEmpresas->delete($usuariosEmpresa)) {
            $this->Flash->success(__('The usuarios empresa has been deleted.'));
        } else {
            $this->Flash->error(__('The usuarios empresa could not be deleted. Please, try again.'));
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

                $usuarioEmpresa = $this->UsuariosEmpresas->newEntity($this->request->data);

                if ($this->UsuariosEmpresas->save($usuarioEmpresa)) {
                    $mensaje = "usuario por empresa guardada.";
                    //$this->Flash->success(__('El usuario y la empresa se guardaron correctamente.'));
                } else {
                    $mensaje = "error al guardar.";
                    //$this->Flash->error(__('Error al guardar, vuelva a intentar.'));
                }

            }catch (\PDOException $e)
            {

                $mensaje = "error al guardar.";
                $this->Flash->error(__('Error al guardar, ya existe este registro. vuelva a intentar.'));
            }

        }

        $this->set([
            'mensaje' => $mensaje,
            'usuarioEmpresa' => $usuarioEmpresa,
            '_serialize' => ['mensaje', 'usuarioEmpresa']
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
                    //$this->Flash->error(__('Error al modificar, vuelva a intentar.'));
                }

            }catch (\PDOException $e)
            {

                $mensaje = "error al guardar.";
                $this->Flash->error(__('Error al guardar, ya existe este registro. vuelva a intentar.'));
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

        $empresa = $this->UsuariosEmpresas->find('all',
            array(
            array('conditions'=>array('UsuariosEmpresas.id'=>$id),
            array('contain' =>array('Empresas','Usuarios'),array('Usuarios')))));

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

            $connection = ConnectionManager::get('default');
            $results = $connection->execute("DELETE FROM usuarios_empresas WHERE id = ".$id);

            if($results){
                $message = "archivo borrado correctamente.";
            }else{
                $message = "error al borrar.";
            }

        }catch (\PDOException $e)
        {

            $mensaje = "error al guardar.";
            $this->Flash->error(__('Error al guardar, ya existe este registro. vuelva a intentar.'));
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

        $this->loadModel("Usuarios");
        $this->loadModel("Empresas");
        $usuariosEmpresas = $this->UsuariosEmpresas->find('all',array("contain"=>array("Usuarios","Empresas")));

        $this->set([
            'usuariosEmpresas' => $usuariosEmpresas,
            '_serialize' => ['usuariosEmpresas']
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

        $empresas = $this->Empresas->find('all',array("conditions"=>array("Empresas.descripcion like" =>"%$term%")));

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


  /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function consistenciaDeDatos($idusuario = null,$idEmpresa = null)
    {

        $message = "";
        try{

            $connection = ConnectionManager::get('default');
            $results = $connection->execute("SELECT id 
            FROM usuarios_empresas 
            WHERE id_usuario = ".$idusuario." AND 
            id_empresa=".$idEmpresa);

            $message = "false";
            foreach ($results as $value){
                $message = "true";
            }

          
        }catch (\PDOException $e)
        {

            $mensaje = "false";
            $this->Flash->error(__('Error al guardar, ya existe este registro. vuelva a intentar.'));
        }



        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }

    
}
