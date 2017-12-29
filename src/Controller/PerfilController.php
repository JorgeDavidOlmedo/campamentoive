<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

/**
 * Perfil Controller
 *
 * @property \App\Model\Table\PerfilTable $Perfil
 */
class PerfilController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $this->paginate = [
          'contain'=>['DetallePerfil'],
           'conditions'=>array('and'=>array('Perfil.estado'=>1)),
           'order'=>['Perfil.id DESC'],
           'limit'=>25
       ];

       $perfil = $this->paginate($this->Perfil);

        $this->set(compact('perfil'));
        $this->set('_serialize', ['perfil']);
    }

    /**
     * View method
     *
     * @param string|null $id Perfil id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $perfil = $this->Perfil->get($id, [
            'contain' => ['DetallePerfil']
        ]);

        $this->set('perfil', $perfil);
        $this->set('_serialize', ['perfil']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $perfil = $this->Perfil->newEntity();
        if ($this->request->is('post')) {
            $perfil = $this->Perfil->patchEntity($perfil, $this->request->data);
            if ($this->Perfil->save($perfil)) {
                $this->Flash->success(__('The perfil has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The perfil could not be saved. Please, try again.'));
            }
        }
        $this->loadModel("Models");
        $models = $this->Models->find('list',['keyField' => 'id','valueField' => 'descripcion'])->where(['estado'=>1]);

        $this->set(compact('perfil','models'));
        $this->set('_serialize', ['perfil']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Perfil id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $perfil = $this->Perfil->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $perfil = $this->Perfil->patchEntity($perfil, $this->request->data);
            if ($this->Perfil->save($perfil)) {
                $this->Flash->success(__('The perfil has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The perfil could not be saved. Please, try again.'));
            }
        }
        $this->loadModel("Models");
        $models = $this->Models->find('list',['keyField' => 'id','valueField' => 'descripcion'])->where(['estado'=>1]);

        $this->set(compact('perfil','models'));
        $this->set('_serialize', ['perfil']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Perfil id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $perfil = $this->Perfil->get($id);
        if ($this->Perfil->delete($perfil)) {
            $this->Flash->success(__('The perfil has been deleted.'));
        } else {
            $this->Flash->error(__('The perfil could not be deleted. Please, try again.'));
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
                $perfil = $this->Perfil->newEntity($this->request->data);
                if ($this->Perfil->save($perfil)) {

                    $conn->commit();
                    $mensaje = "ok.";
                    $this->Flash->success(__('El perfil se guardo correctamente.'));

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
            'perfil' => $perfil,
            '_serialize' => ['mensaje', 'perfil']
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

        $perfil = $this->Perfil->find('all',
            array('conditions'=>array('Perfil.id'=>$id),
                  'contain'=>array('DetallePerfil','DetallePerfil.Models')));

        $this->set([
            'perfil' => $perfil,
            '_serialize' => ['perfil']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }

    /**
   * Add method
   *
   * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
   */
  public function editEntity($id = null)
  {
      $perfil = $this->Perfil->get($id);

      if ($this->request->is(['patch', 'post', 'put'])) {

          $conn = ConnectionManager::get('default');
          $conn->begin();

          $conn->execute("DELETE FROM detalle_perfil WHERE id_perfil=".$id."");

          try{
              $perfil = $this->Perfil->patchEntity($perfil, $this->request->data);
              if ($this->Perfil->save($perfil)) {

                  $conn->commit();
                  $mensaje = "ok.";
                  $this->Flash->success(__('El perfil se modifico correctamente.'));

              } else {
                  $mensaje = "error.";
                  $conn->rollback();
              }

          }catch (\PDOException $e)
          {

              $mensaje = "error.".$e;
              $conn->rollback();
               $this->Flash->error(__('Error al modificar. vuelva a intentar.'.$e));
          }
      }

      $this->set([
          'mensaje' => $mensaje,
          'perfil' => $perfil,
          '_serialize' => ['mensaje', 'perfil']
      ]);
      $this->viewClass = 'Json';
      $this->render();

  }

  /**
   * Add method
   *
   * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
   */
  public function getEntityAllPerfilByTerm($term = null)
  {
      $results=null;
      $connection = ConnectionManager::get('default');
      $id_empresa = $this->request->session()->read('id_empresa');

      //Perfiles
      $results = $connection->execute(
          "SELECT id,descripcion FROM perfil WHERE estado=1 and
          (descripcion like '%".$term."%')");

      $resultado_perfil= array();
      foreach ($results as $value){
          $resultado_perfil[] = array("id"=>$value['id'],
              "descripcion"=> $value['descripcion'],
              "html"=> $value['id'].' -'.'&nbsp;&nbsp;<b>Perfil:&nbsp;</b>'.$value['descripcion']);
      }

      $perfiles = $resultado_perfil;
      $this->set([
          'perfiles' => $perfiles,
          '_serialize' => ['perfiles']
      ]);
      $this->viewClass = 'Json';
      $this->render();

  }


  /**
   * Add method
   *
   * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
   */
  public function getEntityPerfilModel($id = null)
  {

    $perfil_detalle = $this->Perfil->DetallePerfil->find('all',
        array('conditions'=>array('DetallePerfil.id'=>$id)))->where(['estado'=>1,'id'=>$id]);

      $this->set([
          'perfil_detalle' => $perfil_detalle,
          '_serialize' => ['perfil_detalle']
      ]);
      $this->viewClass = 'Json';
      $this->render();




  }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function editarPerfilModel()
    {
      $connection = ConnectionManager::get('default');

      $perfil = $this->Perfil->DetallePerfil->newEntity($this->request->data);

      $id = $perfil->id_perfil;

      $id_model = $perfil->id_model;
      $guardar = $perfil->guardar;
      $modificar = $perfil->modificar;
      $eliminar = $perfil->eliminar;
      $consultar = $perfil->consultar;

      $sql = "UPDATE detalle_perfil SET guardar = '".$guardar."',
                                        modificar = '".$modificar."',
                                        eliminar = '".$eliminar."',
                                        consultar = '".$consultar."'
                                        WHERE id=".$id."";

      $connection->execute($sql);
      $msg = array('msg2'=>$perfil);

        $this->set([
            'msg' => $msg,
            '_serialize' => ['msg']
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
            

            $perfil = TableRegistry::get('Perfil');
            $query = $perfil->query();
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



}
