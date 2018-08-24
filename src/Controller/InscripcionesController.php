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
    public function indexPre(){

        $id_evento = $id_empresa = $this->request->session()->read('id_evento');
        $connection = ConnectionManager::get('default');
        $sql = "SELECT count(*) as total FROM inscripciones WHERE estado=1 AND id_evento=".$id_evento;
        $results = $connection->execute($sql);
        $limit = 1;
        foreach ($results as $valor){
            $limit = $valor['total'];
        }

        $this->paginate = [
            'contain'=>array('Personas','Colectivos','Personas.Lugares'),
            'conditions'=>array('and'=>array('Inscripciones.estado'=>1,'Inscripciones.id_evento'=>$id_evento)),
            'order'=>['Inscripciones.id DESC'],
            'limit'=>$limit
        ];

        $inscripciones = $this->paginate($this->Inscripciones);

        $this->set(compact('inscripciones'));
        $this->set('_serialize', ['inscripciones']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index(){

        $id_evento = $id_empresa = $this->request->session()->read('id_evento');
        $connection = ConnectionManager::get('default');
        $sql = "SELECT count(*) as total FROM inscripciones WHERE estado=1 AND id_evento=".$id_evento;
        $results = $connection->execute($sql);
        $limit = 1;
        foreach ($results as $valor){
            $limit = $valor['total'];
        }

        $this->paginate = [
            'contain'=>array('Personas','Colectivos','Personas.Lugares'),
            'conditions'=>array('and'=>array('Inscripciones.estado'=>1,'Inscripciones.id_evento'=>$id_evento)),
            'order'=>['Inscripciones.id DESC'],
            'limit'=>$limit
        ];

        $inscripciones = $this->paginate($this->Inscripciones);

        $connection = ConnectionManager::get('default');

        $connection->execute("UPDATE colectivos SET ocupado=0 WHERE id_evento=".$id_evento);

        $sql = "SELECT count(*) as total,
                a.id_colectivo as id 
                FROM cargar_colectivos a 
                WHERE 
                a.estado=1 AND 
                a.id_evento=".$id_evento." AND
                a.vaciar IS NULL 
                GROUP BY a.id_colectivo";

        $resultado = $connection->execute($sql);

        foreach ($resultado as $valor){
            $sql_update = "UPDATE colectivos SET ocupado=".$valor['total']." WHERE id=".$valor['id'];
            $connection->execute($sql_update);
        }

        $this->loadModel("Colectivos");
        $bondis = $this->Colectivos->find("all")
            ->where(['estado'=>1,'id_evento'=>$id_evento]);


        $this->set(compact('inscripciones','bondis'));
        $this->set('_serialize', ['inscripciones']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function reporte(){

        $this->paginate = [
            'contain'=>array('Personas','Colectivos','Personas.Lugares'),
            'conditions'=>array('and'=>array('Inscripciones.estado'=>1)),
            'order'=>['Inscripciones.id DESC'],
            'limit'=>25
        ];

        $inscripciones = $this->paginate($this->Inscripciones);

        $this->set(compact('inscripciones'));
        $this->set('_serialize', ['inscripciones']);
    }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function printInscripcion(){

       echo "NECESITO EL FORMATO DE IMPRESION EN EXCEL...";
       die();
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
    public function addPre()
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
        $id_evento = $this->request->session()->read('id_evento');
        $inscripcione = $this->Inscripciones->get($id, [
            'contain' => [],
            'condition'=>["id_event"=>$id_evento]
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

        $this->loadModel("Colectivos");

        $connection = ConnectionManager::get('default');

        $connection->execute("UPDATE colectivos SET ocupado=0 WHERE id_evento=".$id_evento);

        $sql = "SELECT count(*) as total,
                a.id_colectivo as id 
                FROM cargar_colectivos a 
                WHERE 
                a.estado=1 AND 
                a.id_evento=".$id_evento." AND
                a.vaciar IS NULL 
                GROUP BY a.id_colectivo";

        $resultado = $connection->execute($sql);

        foreach ($resultado as $valor){
            $sql_update = "UPDATE colectivos SET ocupado=".$valor['total']." WHERE id=".$valor['id'];
            $connection->execute($sql_update);
        }

        $bondis = $this->Colectivos->find("all")
            ->where(['estado'=>1,'id_evento'=>$id_evento]);

        $this->set(compact('inscripcione','bondis'));
        $this->set('_serialize', ['inscripcione']);
    }


    /**
     * Edit method
     *
     * @param string|null $id Inscripcione id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editPre($id = null)
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
    /********************************* SERVICES**********************************************/

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addEntity()
    {
        $id_evento = $this->request->session()->read('id_evento');
        if ($this->request->is('post')) {

            try{
                $this->request->data['pago'] = str_replace('.','',$this->request->data['pago']);
                $this->request->data['deuda'] = str_replace('.','',$this->request->data['deuda']);
                $inscripcion = $this->Inscripciones->newEntity($this->request->data);
                $inscripcion->id_evento=$id_evento;
                if ($this->Inscripciones->save($inscripcion)) {
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
            'inscripcion' => $inscripcion,
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

        $id_evento = $this->request->session()->read('id_evento');
        $inscripcion =$this->Inscripciones->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            try{
                $this->request->data['pago'] = str_replace('.','',$this->request->data['pago']);
                $this->request->data['deuda'] = str_replace('.','',$this->request->data['deuda']);
                $inscripcion = $this->Inscripciones->patchEntity($inscripcion, $this->request->data);
                $inscripcion->id_evento=$id_evento;
                if ($this->Inscripciones->save($inscripcion)) {
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
            'inscripcion' => $inscripcion,
            '_serialize' => ['mensaje', 'inscripcion']
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
    public function editEntityLastInscripcion($id = null)
    {

        $connection = ConnectionManager::get('default');
        $id_evento = $this->request->session()->read('id_evento');
        $inscripcion =$this->Inscripciones->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            try{
                $this->request->data['pago'] = str_replace('.','',$this->request->data['pago']);
                $this->request->data['deuda'] = str_replace('.','',$this->request->data['deuda']);
                $connection->execute("DELETE FROM cargar_colectivos WHERE id_inscripcion=".$id);

                $inscripcion = $this->Inscripciones->patchEntity($inscripcion, $this->request->data);
                $inscripcion->id_evento=$id_evento;
                if ($this->Inscripciones->save($inscripcion)) {
                    $mensaje = "ok.";
                    $sql_actualizar_colectivo = "INSERT INTO `cargar_colectivos` (`id`, `id_colectivo`, `id_inscripcion`, `id_evento`, `vaciar`,`estado`) 
                    VALUES (NULL, ".$inscripcion->id_colectivo.", ".$inscripcion->id.", ".$inscripcion->id_evento.", NULL,1);";
                    $connection->execute($sql_actualizar_colectivo);
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
            'inscripcion' => $inscripcion,
            '_serialize' => ['mensaje', 'inscripcion']
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

        $inscripcion = $this->Inscripciones->find('all',
            array('conditions'=>array('Inscripciones.id'=>$id),
                  'contain'=>array('Personas.Lugares','Colectivos','Personas.Countries')));

        $row = $inscripcion->first();
        $fecha_naci = date('Y-m-d',strtotime($row->persona->fecha_nacimiento));
        $hoy = date('Y-m-d');
        $datetime1 = date_create($hoy);
        $datetime2 = date_create($fecha_naci);
        $interval = date_diff($datetime1, $datetime2);
        $anhos = $interval->y;
        $this->set([
            'inscripcion' => $inscripcion,
            'anhos' =>$anhos,
            '_serialize' => ['inscripcion','anhos']
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
        $connection = ConnectionManager::get('default');
        try{

            $inscrip = TableRegistry::get('Inscripciones');
            $query = $inscrip->query();
            $query->update()
                ->set(['estado' => 0])
                ->where(['id' => $id])
                ->execute();

            $connection->execute("UPDATE cargar_colectivos SET estado=0 WHERE id_inscripcion=".$id);

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


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function getInscriptos()
    {

        $results=null;
        $connection = ConnectionManager::get('default');
        $anho = date("Y");
        $sql = "SELECT count(*) as contador,
                a.color,
                b.sexo as sexo,
                YEAR(CURDATE())-YEAR(b.fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(b.fecha_nacimiento,'%m-%d'), 0 , -1 ) AS edad 
                FROM inscripciones a, personas b 
                WHERE 
                a.id_persona=b.id AND 
                year(a.fecha)=".$anho."
                GROUP BY a.color,b.sexo,edad;";

        $results = $connection->execute($sql);

        $resultado= array();

        $amarillo_menor = 0;
        $rojo_menor = 0;
        $azul_menor = 0;
        $verde_menor = 0;

        $amarillo_menor_fem = 0;
        $rojo_menor_fem = 0;
        $azul_menor_fem = 0;
        $verde_menor_fem = 0;

        $amarillo_mayor = 0;
        $rojo_mayor = 0;
        $azul_mayor = 0;
        $verde_mayor = 0;

        $amarillo_mayor_fem = 0;
        $rojo_mayor_fem = 0;
        $azul_mayor_fem = 0;
        $verde_mayor_fem = 0;

        foreach ($results as $value){

            //MENOR DE EDAD
            if($value['edad']==14 || $value['edad']==15){

                //MASCULINO
                if($value['sexo']=="masculino"){

                    if($value['color']=="naranja"){
                        $amarillo_menor = $amarillo_menor + $value['contador'];
                    }

                    if($value['color']=="rojo"){
                        $rojo_menor = $rojo_menor + $value['contador'];
                    }

                    if($value['color']=="verde"){
                        $verde_menor = $verde_menor + $value['contador'];
                    }

                    if($value['color']=="azul"){
                        $azul_menor = $azul_menor + $value['contador'];
                    }

                }else{
                    //FEMENINO
                    if($value['color']=="naranja"){
                        $amarillo_menor_fem = $amarillo_menor_fem + $value['contador'];
                    }

                    if($value['color']=="rojo"){
                        $rojo_menor_fem = $rojo_menor_fem + $value['contador'];
                    }

                    if($value['color']=="verde"){
                        $verde_menor_fem = $verde_menor_fem + $value['contador'];
                    }

                    if($value['color']=="azul"){
                        $azul_menor_fem = $azul_menor_fem + $value['contador'];
                    }

                }



            }

            //MAYOR DE EDAD
            if($value['edad']>=16){

                //MASCULINO
                if($value['sexo']=="masculino"){

                    if($value['color']=="naranja"){
                        $amarillo_mayor = $amarillo_mayor + $value['contador'];
                    }

                    if($value['color']=="rojo"){
                        $rojo_mayor = $rojo_mayor + $value['contador'];
                    }

                    if($value['color']=="verde"){
                        $verde_mayor = $verde_mayor + $value['contador'];
                    }

                    if($value['color']=="azul"){
                        $azul_mayor = $azul_mayor + $value['contador'];
                    }

                }else{
                    //FEMENINO
                    if($value['color']=="naranja"){
                        $amarillo_mayor_fem = $amarillo_mayor_fem + $value['contador'];
                    }

                    if($value['color']=="rojo"){
                        $rojo_mayor_fem = $rojo_mayor_fem + $value['contador'];
                    }

                    if($value['color']=="verde"){
                        $verde_mayor_fem = $verde_mayor_fem + $value['contador'];
                    }

                    if($value['color']=="azul"){
                        $azul_mayor_fem = $azul_mayor_fem + $value['contador'];
                    }

                }


            }


        }

        $resultado[] = array("amarillo"=>
                                        array("masculino"=>array("mayor"=>$amarillo_mayor,"menor"=>$amarillo_menor),
                                              "femenino"=>array("mayor"=>$amarillo_mayor_fem, "menor"=>$amarillo_menor_fem)),
                             "azul"=>
                                        array("masculino"=>array("mayor"=>$azul_mayor,"menor"=>$azul_menor),
                                             "femenino"=>array("mayor"=>$azul_mayor_fem, "menor"=>$azul_menor_fem)),
                             "verde"=>
                                        array("masculino"=>array("mayor"=>$verde_mayor,"menor"=>$verde_menor),
                                            "femenino"=>array("mayor"=>$verde_mayor_fem, "menor"=>$verde_menor_fem)),
                             "rojo"=>
                                        array("masculino"=>array("mayor"=>$rojo_mayor,"menor"=>$rojo_menor),
                                            "femenino"=>array("mayor"=>$rojo_mayor_fem, "menor"=>$rojo_menor_fem)));

        $this->set([
            'resultado' => $resultado,
            '_serialize' => ['resultado']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }



}


