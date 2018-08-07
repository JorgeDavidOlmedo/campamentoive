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
 * Eventos Controller
 *
 * @property \App\Model\Table\EventosTable $Eventos
 */
class EventosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'conditions'=>array('and'=>array('Eventos.estado'=>1)),
            'order'=>['Eventos.id DESC'],
            'limit'=>25
        ];
        $eventos = $this->paginate($this->Eventos);

        $this->set(compact('eventos'));
        $this->set('_serialize', ['eventos']);
    }

    /**
     * View method
     *
     * @param string|null $id Evento id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $evento = $this->Eventos->get($id, [
            'contain' => []
        ]);

        $this->set('evento', $evento);
        $this->set('_serialize', ['evento']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $evento = $this->Eventos->newEntity();
        if ($this->request->is('post')) {
            $evento = $this->Eventos->patchEntity($evento, $this->request->data);
            if ($this->Eventos->save($evento)) {
                $this->Flash->success(__('The evento has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The evento could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('evento'));
        $this->set('_serialize', ['evento']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Evento id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $evento = $this->Eventos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evento = $this->Eventos->patchEntity($evento, $this->request->data);
            if ($this->Eventos->save($evento)) {
                $this->Flash->success(__('The evento has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The evento could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('evento'));
        $this->set('_serialize', ['evento']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Evento id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evento = $this->Eventos->get($id);
        if ($this->Eventos->delete($evento)) {
            $this->Flash->success(__('The evento has been deleted.'));
        } else {
            $this->Flash->error(__('The evento could not be deleted. Please, try again.'));
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

                $this->request->data['costo_participante'] = str_replace('.','',$this->request->data['costo_participante']);
                $this->request->data['costo_voluntario'] = str_replace('.','',$this->request->data['costo_voluntario']);
                $this->request->data['costo_colaborador'] = str_replace('.','',$this->request->data['costo_colaborador']);
                $evento = $this->Eventos->newEntity($this->request->data);

                if ($this->Eventos->save($evento)) {
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
            'evento' => $evento,
            '_serialize' => ['mensaje', 'evento']
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

        $evento =$this->Eventos->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            try{

                $this->request->data['costo_participante'] = str_replace('.','',$this->request->data['costo_participante']);
                $this->request->data['costo_voluntario'] = str_replace('.','',$this->request->data['costo_voluntario']);
                $this->request->data['costo_colaborador'] = str_replace('.','',$this->request->data['costo_colaborador']);

                $evento = $this->Eventos->patchEntity($evento, $this->request->data);
                if ($this->Eventos->save($evento)) {
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
            'evento' => $evento,
            '_serialize' => ['mensaje', 'evento']
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

        $evento = $this->Eventos->find('all',
            array(
                'conditions'=>array('Eventos.id'=>$id)));

        $this->set([
            'evento' => $evento,
            '_serialize' => ['evento']
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

            $persona = TableRegistry::get('Eventos');
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
             b.id as id_lugar
             FROM personas a, lugares b
             WHERE 
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

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function getDeuda($categoria = null)
    {

        $results=null;
        $connection = ConnectionManager::get('default');

         $fecha = date("Y");

         $sql = "SELECT costo_participante,costo_voluntario,costo_colaborador 
                 FROM eventos 
                 WHERE 
                 year(fecha)=".$fecha." ORDER BY id desc LIMIT 1 ";


        $results = $connection->execute($sql);

        $resultado = array();
        foreach ($results as $value){

           if($categoria=="participante"){
               $deuda = $value['costo_participante'];
           }

            if($categoria=="voluntario"){
                $deuda = $value['costo_voluntario'];
            }

            if($categoria=="colaborador"){
                $deuda = $value['costo_colaborador'];
            }

        }

        $deuda = number_format($deuda);
        $deuda = str_replace(",", ".", $deuda);
        $this->set([
            'deuda' => $deuda,
            '_serialize' => ['deuda']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }



}



