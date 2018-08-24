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
 * Personas Controller
 *
 * @property \App\Model\Table\PersonasTable $Personas
 */
class PersonasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $connection = ConnectionManager::get('default');
        $sql = "SELECT count(*) as total FROM colectivos WHERE estado=1";
        $results = $connection->execute($sql);
        $limit = 1;
        foreach ($results as $valor){
            $limit = $valor['total'];
        }

        $this->paginate = [
            'contain'=>['Lugares','Countries'],
            'conditions'=>array('and'=>array('Personas.estado'=>1)),
            'order'=>['Personas.id DESC'],
            'limit'=>$limit
        ];

        $personas = $this->paginate($this->Personas);

        $this->set(compact('personas'));
        $this->set('_serialize', ['personas']);
    }

    /**
     * View method
     *
     * @param string|null $id Persona id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $persona = $this->Personas->get($id, [
            'contain' => ['Lugares']
        ]);

        $this->set('persona', $persona);
        $this->set('_serialize', ['persona']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $persona = $this->Personas->newEntity();
        if ($this->request->is('post')) {
            $persona = $this->Personas->patchEntity($persona, $this->request->data);
            if ($this->Personas->save($persona)) {
                $this->Flash->success(__('The persona has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The persona could not be saved. Please, try again.'));
            }
        }


        $this->loadModel("Countries");
        $countries = $this->Countries->find('list', ['keyField' => 'id','valueField' => 'name']);

        $this->set(compact('persona',"countries"));
        $this->set('_serialize', ['persona']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Persona id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $persona = $this->Personas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $persona = $this->Personas->patchEntity($persona, $this->request->data);
            if ($this->Personas->save($persona)) {
                $this->Flash->success(__('The persona has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The persona could not be saved. Please, try again.'));
            }
        }

        $this->loadModel("Countries");
        $countries = $this->Countries->find('list', ['keyField' => 'id','valueField' => 'name']);


        $this->set(compact('persona','countries'));
        $this->set('_serialize', ['persona']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Persona id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $persona = $this->Personas->get($id);
        if ($this->Personas->delete($persona)) {
            $this->Flash->success(__('The persona has been deleted.'));
        } else {
            $this->Flash->error(__('The persona could not be deleted. Please, try again.'));
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

                $persona = $this->Personas->newEntity($this->request->data);

                if ($this->Personas->save($persona)) {
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
            'persona' => $persona,
            '_serialize' => ['mensaje', 'persona']
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

        $persona =$this->Personas->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            try{

                $persona = $this->Personas->patchEntity($persona, $this->request->data);
                if ($this->Personas->save($persona)) {
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
            'persona' => $persona,
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

        $persona = $this->Personas->find('all',
            array(
                'contain'=>array('Lugares'),
                'conditions'=>array('Personas.id'=>$id)));

        $this->set([
            'persona' => $persona,
            '_serialize' => ['persona']
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

            $persona = TableRegistry::get('Personas');
            $query = $persona->query();
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

        $results = $connection->execute(
            "SELECT a.id as id,
             a.descripcion as descripcion,
             a.dni as dni,
             YEAR(CURDATE())-YEAR(a.fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(a.fecha_nacimiento,'%m-%d'), 0 , -1 ) AS edad 
             ,a.sexo as sexo,
             a.correo as correo,
             b.descripcion as descrip_lugar,
             b.id as id_lugar,
             c.name as pais
             FROM personas a, lugares b, countries c
             WHERE 
             a.id_pais=c.id AND
             a.id_lugar = b.id AND
             a.estado=1 AND
            (a.descripcion like '%".$term."%' OR 
             a.dni like '%".$term."%')");

        $resultado = array();
        $categoria = "colaborador";
        foreach ($results as $value){

            if($value['edad']>=14 && $value['edad']<=18){
                $categoria = "participante";
            }

            if($value['edad']>19){
                $categoria = "voluntario";
            }


            $resultado[] = array("id"=>$value['id'],
                "descripcion"=> $value['descripcion'],
                "dni" => $value['dni'],
                "edad"=>$value['edad'],
                "sexo"=>$value['sexo'],
                "correo"=>$value['correo'],
                "categoria"=>$categoria,
                "pais"=>$value['pais'],
                "lugar"=>array(
                    "id"=>$value['id_lugar'],
                    "descripcion"=>$value['descrip_lugar']
                ));

        }

        $des = "No existe";
        if( count($results)<=0 ) {
            $resultado[] = array("id"=>"00",
                "descripcion"=> "Agregar Participante");
        }

        $personas = $resultado;
        $this->set([
            'personas' => $personas,
            '_serialize' => ['personas']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }



}


