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
        $sql = "SELECT count(*) as total FROM inscripciones WHERE id_evento=".$id_evento;
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
        /*$sql = "SELECT count(*) as total FROM inscripciones WHERE estado=1 AND id_evento=".$id_evento;
        $results = $connection->execute($sql);
        $limit = 1;
        foreach ($results as $valor){
            $limit = $valor['total'];
        }*/

        $this->paginate = [
            'contain'=>array('Personas','Colectivos','Personas.Lugares'),
            'conditions'=>array('and'=>array('Inscripciones.estado'=>1,'Inscripciones.id_evento'=>$id_evento)),
            'order'=>['Inscripciones.id DESC'],
            'limit'=>10
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
    public function nodata(){

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
    public function equipos(){

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
    public function getpasajeros(){

        $id_evento = $this->request->session()->read('id_evento');
        $this->paginate = [
            'contain'=>array('Personas','Colectivos','Personas.Lugares'),
            'conditions'=>array('and'=>array('Inscripciones.estado'=>1)),
            'order'=>['Inscripciones.id DESC'],
            'limit'=>25
        ];

        $inscripciones = $this->paginate($this->Inscripciones);

        $this->loadModel("Colectivos");
        $colectivos = $this->Colectivos->find('list',['keyField' => 'id','valueField' => 'descripcion'])
            ->where(['id_evento'=>$id_evento,'estado'=>1]);

        $this->set(compact('inscripciones','colectivos'));
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
        $this->loadModel("Countries");
        $countries = $this->Countries->find('list', ['keyField' => 'id','valueField' => 'name']);
        $this->set(compact('inscripcione','countries'));
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

    public function verificarIncripcion($idCliente = null){
        $results=null;
        $connection = ConnectionManager::get('default');
        $id_evento = $this->request->session()->read('id_evento');

        //VERIFICAR
        $sql = "SELECT id FROM inscripciones WHERE estado=1 AND id_evento=".$id_evento." AND id_persona=".$idCliente;
        $results = $connection->execute($sql);

        $existe = 0;
        foreach ($results as $value){
            $existe = 1;
        }

        return $existe;
    }

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
                $existe = $this->verificarIncripcion($this->request->data['id_persona']);
                $inscripcion = $this->Inscripciones->newEntity($this->request->data);
                $inscripcion->id_evento=$id_evento;

                if($existe==0){

                    if ($this->Inscripciones->save($inscripcion)) {
                        $mensaje = "ok";

                    } else {
                        $mensaje = "error";
                    }
                }else{
                    $mensaje = "existe";
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
                //$this->Flash->error(__('Error al editar. vuelva a intentar.'));
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

                    if($inscripcion->id_colectivo!=null){
                        $sql_actualizar_colectivo = "INSERT INTO `cargar_colectivos` (`id`, `id_colectivo`, `id_inscripcion`, `id_evento`, `vaciar`,`estado`) 
                    VALUES (NULL, ".$inscripcion->id_colectivo.", ".$inscripcion->id.", ".$inscripcion->id_evento.", NULL,1);";
                        $connection->execute($sql_actualizar_colectivo);
                    }

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

        //INSCRIPCIONES
        $results = $connection->execute(
            "SELECT a.id as id,
             b.descripcion as descripcion
             FROM inscripciones a, personas b 
             WHERE 
             a.id_persona=b.id AND
             a.estado=1 and
             YEAR(a.fecha)=2019 and
            (b.descripcion like '%".$term."%') LIMIT 30");

        $resultado_lugar = array();
        foreach ($results as $value){
            $resultado_lugar[] = array("id"=>$value['id'],
                "descripcion"=> $value['descripcion']);

        }

        $inscripciones = $resultado_lugar;
        $this->set([
            'inscripciones' => $inscripciones,
            '_serialize' => ['inscripciones']
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
        $id_evento = $this->request->session()->read('id_evento');
        $anho = date("Y");
        $sql = "SELECT count(*) as contador,
                a.color,
                b.sexo as sexo,
                YEAR(CURDATE())-YEAR(b.fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(b.fecha_nacimiento,'%m-%d'), 0 , -1 ) AS edad 
                FROM inscripciones a, personas b 
                WHERE 
                a.id_persona=b.id AND 
                a.estado_inscripcion='confirmado' AND
                a.id_evento=".$id_evento." AND a.estado=1
                GROUP BY a.color,b.sexo,edad;";

        $results = $connection->execute($sql);

        $resultado= array();

        $amarillo_menor = 0;
        $rojo_menor = 0;
        $azul_menor = 0;
        $naranja_menor = 0;

        $amarillo_menor_fem = 0;
        $rojo_menor_fem = 0;
        $azul_menor_fem = 0;
        $naranja_menor_fem = 0;

        $amarillo_mayor = 0;
        $rojo_mayor = 0;
        $azul_mayor = 0;
        $naranja_mayor = 0;

        $amarillo_mayor_fem = 0;
        $rojo_mayor_fem = 0;
        $azul_mayor_fem = 0;
        $naranja_mayor_fem = 0;

        foreach ($results as $value){

            //MENOR DE EDAD
            if($value['edad']<=14 || $value['edad']==15){

                //MASCULINO
                if($value['sexo']=="masculino"){

                    if($value['color']=="naranja"){
                        $naranja_menor = $naranja_menor + $value['contador'];
                    }

                    if($value['color']=="rojo"){
                        $rojo_menor = $rojo_menor + $value['contador'];
                    }

                    if($value['color']=="amarillo"){
                        $amarillo_menor = $amarillo_menor + $value['contador'];
                    }

                    if($value['color']=="azul"){
                        $azul_menor = $azul_menor + $value['contador'];
                    }

                }else{
                    //FEMENINO
                    if($value['color']=="naranja"){
                        $naranja_menor_fem = $naranja_menor_fem + $value['contador'];
                    }

                    if($value['color']=="rojo"){
                        $rojo_menor_fem = $rojo_menor_fem + $value['contador'];
                    }

                    if($value['color']=="amarillo"){
                        $amarillo_menor_fem = $amarillo_menor_fem + $value['contador'];
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
                        $naranja_mayor = $naranja_mayor + $value['contador'];
                    }

                    if($value['color']=="rojo"){
                        $rojo_mayor = $rojo_mayor + $value['contador'];
                    }

                    if($value['color']=="amarillo"){
                        $amarillo_mayor = $amarillo_mayor + $value['contador'];
                    }

                    if($value['color']=="azul"){
                        $azul_mayor = $azul_mayor + $value['contador'];
                    }

                }else{
                    //FEMENINO
                    if($value['color']=="naranja"){
                        $naranja_mayor_fem = $naranja_mayor_fem + $value['contador'];
                    }

                    if($value['color']=="rojo"){
                        $rojo_mayor_fem = $rojo_mayor_fem + $value['contador'];
                    }

                    if($value['color']=="amarillo"){
                        $amarillo_mayor_fem = $amarillo_mayor_fem + $value['contador'];
                    }

                    if($value['color']=="azul"){
                        $azul_mayor_fem = $azul_mayor_fem + $value['contador'];
                    }

                }


            }


        }

        $resultado[] = array("amarillo"=>
                                        array("masculino"=>array("mayor"=>$naranja_mayor,"menor"=>$naranja_menor),
                                              "femenino"=>array("mayor"=>$naranja_mayor_fem, "menor"=>$naranja_menor_fem)),
                             "azul"=>
                                        array("masculino"=>array("mayor"=>$azul_mayor,"menor"=>$azul_menor),
                                             "femenino"=>array("mayor"=>$azul_mayor_fem, "menor"=>$azul_menor_fem)),
                             "verde"=>
                                        array("masculino"=>array("mayor"=>$amarillo_mayor,"menor"=>$amarillo_menor),
                                            "femenino"=>array("mayor"=>$amarillo_mayor_fem, "menor"=>$amarillo_menor_fem)),
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


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function getInformacion()
    {

        $results=null;
        $connection = ConnectionManager::get('default');
        $id_evento = $this->request->session()->read('id_evento');
        $anho = date("Y");

        ########################PENDIENTES Y CONFIRMADOS#################################################
        $sql = "SELECT count(*) as contador,
                a.color,
                b.sexo as sexo,
                a.categoria,
                YEAR(CURDATE())-YEAR(b.fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(b.fecha_nacimiento,'%m-%d'), 0 , -1 ) AS edad 
                FROM inscripciones a, personas b 
                WHERE 
                a.id_persona=b.id AND 
                a.id_evento=".$id_evento." AND a.categoria='participante'
                AND a.viaja='no' AND a.estado=1
                GROUP BY a.categoria,b.sexo;";

        $results = $connection->execute($sql);

        $resultado= array();
        $p_y_c_participante_masculino = 0;
        $p_y_c_participante_femenino = 0;

        foreach ($results as $value){
            if($value['sexo']=="femenino"){
                $p_y_c_participante_femenino = $value['contador'];
            }
            if($value['sexo']=="masculino"){
                $p_y_c_participante_masculino = $value['contador'];
            }
        }


        $sql = "SELECT count(*) as contador,
                a.color,
                b.sexo as sexo,
                a.categoria,
                YEAR(CURDATE())-YEAR(b.fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(b.fecha_nacimiento,'%m-%d'), 0 , -1 ) AS edad 
                FROM inscripciones a, personas b 
                WHERE 
                a.id_persona=b.id AND 
                a.id_evento=".$id_evento." AND a.categoria='voluntario'
                AND a.viaja='no' AND a.estado=1
                GROUP BY a.categoria,b.sexo;";

        $results = $connection->execute($sql);

        $p_y_c_voluntario_masculino = 0;
        $p_y_c_voluntario_femenino = 0;

        foreach ($results as $value){
            if($value['sexo']=="femenino"){
                $p_y_c_voluntario_femenino = $value['contador'];
            }
            if($value['sexo']=="masculino"){
                $p_y_c_voluntario_masculino = $value['contador'];
            }
        }

        $resultado[] = array("p_y_c"=> array("participante"=>
                                             array("masculino"=>$p_y_c_participante_masculino,
                                                   "femenino"=>$p_y_c_participante_femenino),

                                            "voluntario"=>
                                            array("masculino"=>$p_y_c_voluntario_masculino,
                                                  "femenino"=>$p_y_c_voluntario_femenino)));
        ################################################################################################################


        ########################CONFIRMADOS#################################################
        $sql = "SELECT count(*) as contador,
                a.color,
                b.sexo as sexo,
                a.categoria,
                YEAR(CURDATE())-YEAR(b.fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(b.fecha_nacimiento,'%m-%d'), 0 , -1 ) AS edad 
                FROM inscripciones a, personas b 
                WHERE 
                a.id_persona=b.id AND 
                a.id_evento=".$id_evento." AND a.categoria='participante'
                AND a.viaja='no' AND 
                a.estado_inscripcion = 'confirmado' AND a.estado=1
                GROUP BY a.categoria,b.sexo;";

        $results = $connection->execute($sql);


        $p_y_c_participante_masculino = 0;
        $p_y_c_participante_femenino = 0;

        foreach ($results as $value){
            if($value['sexo']=="femenino"){
                $p_y_c_participante_femenino = $value['contador'];
            }
            if($value['sexo']=="masculino"){
                $p_y_c_participante_masculino = $value['contador'];
            }
        }


        $sql = "SELECT count(*) as contador,
                a.color,
                b.sexo as sexo,
                a.categoria,
                YEAR(CURDATE())-YEAR(b.fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(b.fecha_nacimiento,'%m-%d'), 0 , -1 ) AS edad 
                FROM inscripciones a, personas b 
                WHERE 
                a.id_persona=b.id AND 
                a.id_evento=".$id_evento." AND a.categoria='voluntario'
                AND a.viaja='no' AND 
                a.estado_inscripcion = 'confirmado' AND a.estado=1
                GROUP BY a.categoria,b.sexo;";

        $results = $connection->execute($sql);

        $p_y_c_voluntario_masculino = 0;
        $p_y_c_voluntario_femenino = 0;

        foreach ($results as $value){
            if($value['sexo']=="femenino"){
                $p_y_c_voluntario_femenino = $value['contador'];
            }
            if($value['sexo']=="masculino"){
                $p_y_c_voluntario_masculino = $value['contador'];
            }
        }

        $resultado[] = array("c"=> array("participante"=>
            array("masculino"=>$p_y_c_participante_masculino,
                "femenino"=>$p_y_c_participante_femenino),

            "voluntario"=>
                array("masculino"=>$p_y_c_voluntario_masculino,
                    "femenino"=>$p_y_c_voluntario_femenino)));
        ################################################################################################################



        ########################ACOMPAÑANTE PENDIENTES Y CONFIRMADOS#################################################
        $sql = "SELECT count(*) as contador,
                a.color,
                b.sexo as sexo,
                a.categoria,
                YEAR(CURDATE())-YEAR(b.fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(b.fecha_nacimiento,'%m-%d'), 0 , -1 ) AS edad 
                FROM inscripciones a, personas b 
                WHERE 
                a.id_persona=b.id AND 
                a.id_evento=".$id_evento."
                AND a.viaja='si' AND a.estado=1
                GROUP BY a.categoria,b.sexo;";

        $results = $connection->execute($sql);


        $p_y_c_participante_masculino = 0;
        $p_y_c_participante_femenino = 0;

        foreach ($results as $value){
            if($value['sexo']=="femenino"){
                $p_y_c_participante_femenino = $value['contador'];
            }
            if($value['sexo']=="masculino"){
                $p_y_c_participante_masculino = $value['contador'];
            }
        }


        $sql = "SELECT count(*) as contador,
                a.color,
                b.sexo as sexo,
                a.categoria,
                YEAR(CURDATE())-YEAR(b.fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(b.fecha_nacimiento,'%m-%d'), 0 , -1 ) AS edad 
                FROM inscripciones a, personas b 
                WHERE 
                a.id_persona=b.id AND 
                a.id_evento=".$id_evento."
                AND a.viaja='si' AND 
                a.estado_inscripcion = 'confirmado' AND a.estado=1
                GROUP BY a.categoria,b.sexo;";

        $results = $connection->execute($sql);

        $p_y_c_voluntario_masculino = 0;
        $p_y_c_voluntario_femenino = 0;

        foreach ($results as $value){
            if($value['sexo']=="femenino"){
                $p_y_c_voluntario_femenino = $value['contador'];
            }
            if($value['sexo']=="masculino"){
                $p_y_c_voluntario_masculino = $value['contador'];
            }
        }

        $resultado[] = array("a"=> array("p_y_c"=>
            array("masculino"=>$p_y_c_participante_masculino,
                "femenino"=>$p_y_c_participante_femenino),

            "c"=>
                array("masculino"=>$p_y_c_voluntario_masculino,
                    "femenino"=>$p_y_c_voluntario_femenino)));
        ################################################################################################################


        $this->set([
            'resultado' => $resultado,
            '_serialize' => ['resultado']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function printEquipo()
    {

        require_once(ROOT . DS . 'webroot' . DS . "class/tcpdf" . DS . "tcpdf.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "PHPJasperXML.inc.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "setting.php");

        try{

            $equipo = $this->request->data['equipo'];
            $categoria = $this->request->data['categoria'];
            $id_evento = $this->request->session()->read('id_evento');
            $user_id = $this->request->session()->read('Auth.User.id');
            $connection = ConnectionManager::get('default');

            $PHPJasperXML = new \PHPJasperXML();


            $hoy = date("Y-m-d");
            $hoy = explode("-",$hoy);
            $hoy = $hoy[2].'/'.$hoy[1].'/'.$hoy[0];

            $hora = date("H:i:s");
            $file = "informes/equipos/equipos.jrxml";
            $anho = date("Y");
            $sql = "SELECT count(*) as contador,
                a.color as color,
                b.sexo as sexo,
                b.descripcion as nombre,
                a.observacion as obs,
                YEAR(CURDATE())-YEAR(b.fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(b.fecha_nacimiento,'%m-%d'), 0 , -1 ) AS edad 
                FROM inscripciones a, personas b 
                WHERE 
                a.id_persona=b.id AND 
                a.id_evento=".$id_evento."
                GROUP BY a.color,b.sexo,edad;";

            $results = $connection->execute($sql);
            $connection->execute("DELETE FROM equipo_tmp WHERE id_evento=".$id_evento);

            foreach ($results as $value){

                //MENOR DE EDAD
                if($value['edad']==14 || $value['edad']==15){

                    //MASCULINO
                    if($value['sexo']=="masculino"){

                        $insert = "INSERT INTO `equipo_tmp` (`id`, `contador`, `color`, `sexo`, `edad`, 
                        `nombre`, `obs`, `id_evento`) 
                        VALUES (NULL, '1', '".$value['color']."', 'masculino_menor', ".$value['edad'].", '".$value['nombre']."', '".$value['obs']."',
                         ".$id_evento.")";

                        $connection->execute($insert);

                    }else{
                        //FEMENINO
                        $insert = "INSERT INTO `equipo_tmp` (`id`, `contador`, `color`, `sexo`, `edad`, 
                        `nombre`, `obs`, `id_evento`) 
                        VALUES (NULL, '1', '".$value['color']."', 'femenino_menor', ".$value['edad'].", '".$value['nombre']."', '".$value['obs']."',
                         ".$id_evento.")";
                        $connection->execute($insert);

                    }



                }

                //MAYOR DE EDAD
                if($value['edad']>=16){

                    //MASCULINO
                    if($value['sexo']=="masculino"){

                        $insert = "INSERT INTO `equipo_tmp` (`id`, `contador`, `color`, `sexo`, `edad`, 
                        `nombre`, `obs`, `id_evento`) 
                        VALUES (NULL, '1', '".$value['color']."', 'masculino_mayor', ".$value['edad'].", '".$value['nombre']."', '".$value['obs']."',
                         ".$id_evento.")";
                        $connection->execute($insert);


                    }else{
                        //FEMENINO
                        $insert = "INSERT INTO `equipo_tmp` (`id`, `contador`, `color`, `sexo`, `edad`, 
                        `nombre`, `obs`, `id_evento`) 
                        VALUES (NULL, '1', '".$value['color']."', 'femenino_mayor', ".$value['edad'].", '".$value['nombre']."', '".$value['obs']."',
                         ".$id_evento.")";
                        $connection->execute($insert);

                    }


                }


            }

            $results=null;
            $validacion="";

            if($equipo=='todos'){
                $validacion.=" AND id > 0 ";
            }else{
                $validacion.=" AND color='".$equipo."' ";
            }

            if($categoria=='todos'){
                $validacion.=" AND id > 0 ";
            }else{
                $validacion.=" AND sexo='".$categoria."' ";
            }

            $query = "SELECT
                      id as id,
                      sexo as id_categoria,
                      if(sexo='femenino_mayor',CONCAT('CATEGORIA: FEMENINO - MAYOR'),
                      if(sexo='masculino_mayor',CONCAT('CATEGORIA: MASCULINO - MAYOR'),
                      if(sexo='femenino_menor',CONCAT('CATEGORIA: FEMENINO - MENOR'),
                      if(sexo='masculino_menor',CONCAT('CATEGORIA: MASCULINO - MENOR'),sexo)))) as categoria,
                      color as id_equipo,
                      if(color='rojo',CONCAT('EQUIPO: ROJO'),
                      if(color='azul',CONCAT('EQUIPO: AZUL'),
                      if(color='verde',CONCAT('EQUIPO: VERDE'),
                      if(color='naranja',CONCAT('EQUIPO: NARANJA'),
                      if(color='sin_definir',CONCAT('EQUIPO: SIN DEFINIR'),0))))) as equipo,
                      nombre
                      FROM equipo_tmp 
                      WHERE 
                      id_evento=".$id_evento."
                       ".$validacion."
                      ORDER BY color, sexo";

            $results=null;
            $connection = ConnectionManager::get('default');
            $results = $connection->execute($query);

            if(count($results)<=0){
                return $this->redirect(['controller' => 'inscripciones','action' => 'nodata']);
            };

            $PHPJasperXML->arrayParameter=array("parameter1"=>1,
                "parametro_empresa"=>$this->request->session()->read('nombre_evento'),
                "factura"=>"Nro.",
                "direccion"=>"me",
                "ruc"=>"me",
                "contacto"=>"me",
                "fecha"=>$hoy,
                "usuario"=>$this->Auth->user('nombre'),
                "saldoal"=>"param1",
                "moneda"=>"param1",
                "local"=>"param1",
                "query"=>$query,
                "total_factura"=>"Total",
                "total_cliente"=>"param1",
                "total_general"=>"Total General",
                "empresa_software"=>"IVE",
                "empresa_descripcion"=>	"IVE",
                "pagina"=>"Pag. Nro.",
                "fecha_impresion"=>"Fecha Impresion:".$hoy,
                "hora_impresion"=>"Hora Impresion:".$hora,
                "desde"=>"me",
                "hasta"=>"me",
                "descrip_fecha"=>"Fecha:");


            $PHPJasperXML->load_xml_file($file);
            $server=$server;
            $db=$db;
            $user=$user;
            $pass=$pass;
            $version="0.9d";
            $pgport=5432;
            $pchartfolder="./class/pchart2";
            $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

            if (ob_get_length() > 0 ) {
                ob_end_clean();
            }

            $PHPJasperXML->outpage("I");

        }catch (\PDOException $e) {
            $error = 'No se puede borrar los datos. Esta asociado con otra clase.';

        }

    }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function morosos()
    {

        require_once(ROOT . DS . 'webroot' . DS . "class/tcpdf" . DS . "tcpdf.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "PHPJasperXML.inc.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "setting.php");

        try{

            $id_evento = $this->request->session()->read('id_evento');
            $user_id = $this->request->session()->read('Auth.User.id');
            $connection = ConnectionManager::get('default');

            $PHPJasperXML = new \PHPJasperXML();


            $hoy = date("Y-m-d");
            $hoy = explode("-",$hoy);
            $hoy = $hoy[2].'/'.$hoy[1].'/'.$hoy[0];

            $hora = date("H:i:s");
            $file = "informes/equipos/morosos.jrxml";
            $anho = date("Y");
            $query = "SELECT b.descripcion as nombre,
                      a.deuda as deuda,
                      c.descripcion as lugar,
                      b.telefono as telefono
                     FROM inscripciones a, personas b, lugares c
                     WHERE 
                     b.id_lugar=c.id AND
                     a.id_persona=b.id AND 
                     a.deuda>0 AND
                      a.id_evento=".$id_evento." AND
                     a.estado=1";

            $results=null;
            $connection = ConnectionManager::get('default');
            $results = $connection->execute($query);

            if(count($results)<=0){
                return $this->redirect(['controller' => 'inscripciones','action' => 'nodata']);
            };

            $PHPJasperXML->arrayParameter=array("parameter1"=>1,
                "parametro_empresa"=>$this->request->session()->read('nombre_evento'),
                "factura"=>"Nro.",
                "direccion"=>"me",
                "ruc"=>"me",
                "contacto"=>"me",
                "fecha"=>$hoy,
                "usuario"=>$this->Auth->user('nombre'),
                "saldoal"=>"param1",
                "moneda"=>"param1",
                "local"=>"param1",
                "query"=>$query,
                "total_factura"=>"Total",
                "total_cliente"=>"param1",
                "total_general"=>"Total General",
                "empresa_software"=>"IVE",
                "empresa_descripcion"=>	"IVE",
                "pagina"=>"Pag. Nro.",
                "fecha_impresion"=>"Fecha Impresion:".$hoy,
                "hora_impresion"=>"Hora Impresion:".$hora,
                "desde"=>"me",
                "hasta"=>"me",
                "descrip_fecha"=>"Fecha:");


            $PHPJasperXML->load_xml_file($file);
            $server=$server;
            $db=$db;
            $user=$user;
            $pass=$pass;
            $version="0.9d";
            $pgport=5432;
            $pchartfolder="./class/pchart2";
            $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

            if (ob_get_length() > 0 ) {
                ob_end_clean();
            }

            $PHPJasperXML->outpage("I");

        }catch (\PDOException $e) {
            $error = 'No se puede borrar los datos. Esta asociado con otra clase.';

        }

    }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function participantes()
    {

        require_once(ROOT . DS . 'webroot' . DS . "class/tcpdf" . DS . "tcpdf.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "PHPJasperXML.inc.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "setting.php");

        try{

            $id_evento = $this->request->session()->read('id_evento');
            $user_id = $this->request->session()->read('Auth.User.id');
            $connection = ConnectionManager::get('default');

            $PHPJasperXML = new \PHPJasperXML();


            $hoy = date("Y-m-d");
            $hoy = explode("-",$hoy);
            $hoy = $hoy[2].'/'.$hoy[1].'/'.$hoy[0];

            $hora = date("H:i:s");
            $file = "informes/equipos/participantes.jrxml";
            $anho = date("Y");
            $query = "SELECT 
                      COUNT(c.id) as telefono,
                      b.descripcion as nombre,
                      a.deuda as deuda,
                      c.descripcion as lugar
                     FROM inscripciones a, personas b, lugares c
                     WHERE 
                     b.id_lugar=c.id AND
                     a.id_persona=b.id AND 
                      a.id_evento=".$id_evento." AND
                     a.estado=1 GROUP BY c.id";

            $results=null;
            $connection = ConnectionManager::get('default');
            $results = $connection->execute($query);

            if(count($results)<=0){
                return $this->redirect(['controller' => 'inscripciones','action' => 'nodata']);
            };

            $PHPJasperXML->arrayParameter=array("parameter1"=>1,
                "parametro_empresa"=>$this->request->session()->read('nombre_evento'),
                "factura"=>"Nro.",
                "direccion"=>"me",
                "ruc"=>"me",
                "contacto"=>"me",
                "fecha"=>$hoy,
                "usuario"=>$this->Auth->user('nombre'),
                "saldoal"=>"param1",
                "moneda"=>"param1",
                "local"=>"param1",
                "query"=>$query,
                "total_factura"=>"Total",
                "total_cliente"=>"param1",
                "total_general"=>"Total General",
                "empresa_software"=>"IVE",
                "empresa_descripcion"=>	"IVE",
                "pagina"=>"Pag. Nro.",
                "fecha_impresion"=>"Fecha Impresion:".$hoy,
                "hora_impresion"=>"Hora Impresion:".$hora,
                "desde"=>"me",
                "hasta"=>"me",
                "descrip_fecha"=>"Fecha:");


            $PHPJasperXML->load_xml_file($file);
            $server=$server;
            $db=$db;
            $user=$user;
            $pass=$pass;
            $version="0.9d";
            $pgport=5432;
            $pchartfolder="./class/pchart2";
            $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

            if (ob_get_length() > 0 ) {
                ob_end_clean();
            }

            $PHPJasperXML->outpage("I");

        }catch (\PDOException $e) {
            $error = 'No se puede borrar los datos. Esta asociado con otra clase.';

        }

    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function printPasajeros()
    {

        require_once(ROOT . DS . 'webroot' . DS . "class/tcpdf" . DS . "tcpdf.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "PHPJasperXML.inc.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "setting.php");

        try{

            $colectivo = $this->request->data['colectivo'];

            $id_evento = $this->request->session()->read('id_evento');
            $user_id = $this->request->session()->read('Auth.User.id');
            $connection = ConnectionManager::get('default');

            $PHPJasperXML = new \PHPJasperXML();


            $hoy = date("Y-m-d");
            $hoy = explode("-",$hoy);
            $hoy = $hoy[2].'/'.$hoy[1].'/'.$hoy[0];

            $hora = date("H:i:s");
            $file = "informes/equipos/pasajeros.jrxml";
            $anho = date("Y");

            if(empty($colectivo)){
                $query = "SELECT 
                      d.id as id_colectivo,
                      CONCAT('VEHÍCULO: ',d.descripcion) as colectivo,
                      CONCAT('PATENTE: ',d.patente) as patente,
                      CONCAT('DESTINO: ',d.destino) as destino,
                      b.descripcion as nombre,
                      a.deuda as deuda,
                      c.descripcion as lugar,
                      b.dni as telefono,
                      b.fecha_nacimiento as naci
                     FROM inscripciones a, personas b, lugares c, colectivos d
                     WHERE 
                     a.id_colectivo=d.id AND 
                     b.id_lugar=c.id AND
                     a.id_persona=b.id AND 
                     a.estado=1";
            }else{
                $query = "SELECT 
                      d.id as id_colectivo,
                      CONCAT('VEHÍCULO: ',d.descripcion) as colectivo,
                      CONCAT('PATENTE: ',d.patente) as patente,
                      CONCAT('DESTINO: ',d.destino) as destino,
                      b.descripcion as nombre,
                      a.deuda as deuda,
                      c.descripcion as lugar,
                      b.dni as telefono,
                      b.fecha_nacimiento as naci
                     FROM inscripciones a, personas b, lugares c, colectivos d
                     WHERE 
                     a.id_colectivo=d.id AND 
                     b.id_lugar=c.id AND
                     a.id_persona=b.id AND 
                     a.id_colectivo=".$colectivo." AND
                      a.id_evento=".$id_evento." AND
                     a.estado=1";
            }


            $results=null;
            $connection = ConnectionManager::get('default');
            $results = $connection->execute($query);

            if(count($results)<=0){
                return $this->redirect(['controller' => 'inscripciones','action' => 'nodata']);
            };

            $PHPJasperXML->arrayParameter=array("parameter1"=>1,
                "parametro_empresa"=>$this->request->session()->read('nombre_evento'),
                "factura"=>"Nro.",
                "direccion"=>"me",
                "ruc"=>"me",
                "contacto"=>"me",
                "fecha"=>$hoy,
                "usuario"=>$this->Auth->user('nombre'),
                "saldoal"=>"param1",
                "moneda"=>"param1",
                "local"=>"param1",
                "query"=>$query,
                "total_factura"=>"Total",
                "total_cliente"=>"param1",
                "total_general"=>"Total General",
                "empresa_software"=>"IVE",
                "empresa_descripcion"=>	"IVE",
                "pagina"=>"Pag. Nro.",
                "fecha_impresion"=>"Fecha Impresion:".$hoy,
                "hora_impresion"=>"Hora Impresion:".$hora,
                "desde"=>"me",
                "hasta"=>"me",
                "descrip_fecha"=>"Fecha:");


            $PHPJasperXML->load_xml_file($file);
            $server=$server;
            $db=$db;
            $user=$user;
            $pass=$pass;
            $version="0.9d";
            $pgport=5432;
            $pchartfolder="./class/pchart2";
            $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

            if (ob_get_length() > 0 ) {
                ob_end_clean();
            }

            $PHPJasperXML->outpage("I");

        }catch (\PDOException $e) {
            $error = 'No se puede borrar los datos. Esta asociado con otra clase.';

        }

    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function seguros()
    {

        require_once(ROOT . DS . 'webroot' . DS . "class/tcpdf" . DS . "tcpdf.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "PHPJasperXML.inc.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "setting.php");

        try{

            $id_evento = $this->request->session()->read('id_evento');
            $user_id = $this->request->session()->read('Auth.User.id');
            $connection = ConnectionManager::get('default');

            $PHPJasperXML = new \PHPJasperXML();


            $hoy = date("Y-m-d");
            $hoy = explode("-",$hoy);
            $hoy = $hoy[2].'/'.$hoy[1].'/'.$hoy[0];

            $hora = date("H:i:s");
            $file = "informes/equipos/seguros.jrxml";
            $anho = date("Y");


                $query = "SELECT 
                      a.id as id_colectivo,
                      b.descripcion as nombre,
                      a.deuda as deuda,
                      c.descripcion as lugar,
                      b.dni as telefono,
                      b.fecha_nacimiento as naci
                     FROM inscripciones a, personas b, lugares c
                     WHERE 
                     b.id_lugar=c.id AND
                     a.id_persona=b.id AND 
                     a.estado_inscripcion='confirmado' AND
                     a.id_evento=".$id_evento." AND
                     a.estado=1
                     GROUP BY a.id_persona";

            $results=null;
            $connection = ConnectionManager::get('default');
            $results = $connection->execute($query);

            if(count($results)<=0){
                return $this->redirect(['controller' => 'inscripciones','action' => 'nodata']);
            };

            $PHPJasperXML->arrayParameter=array("parameter1"=>1,
                "parametro_empresa"=>$this->request->session()->read('nombre_evento'),
                "factura"=>"Nro.",
                "direccion"=>"me",
                "ruc"=>"me",
                "contacto"=>"me",
                "fecha"=>$hoy,
                "usuario"=>$this->Auth->user('nombre'),
                "saldoal"=>"param1",
                "moneda"=>"param1",
                "local"=>"param1",
                "query"=>$query,
                "total_factura"=>"Total",
                "total_cliente"=>"param1",
                "total_general"=>"Total General",
                "empresa_software"=>"IVE",
                "empresa_descripcion"=>	"IVE",
                "pagina"=>"Pag. Nro.",
                "fecha_impresion"=>"Fecha Impresion:".$hoy,
                "hora_impresion"=>"Hora Impresion:".$hora,
                "desde"=>"me",
                "hasta"=>"me",
                "descrip_fecha"=>"Fecha:");


            $PHPJasperXML->load_xml_file($file);
            $server=$server;
            $db=$db;
            $user=$user;
            $pass=$pass;
            $version="0.9d";
            $pgport=5432;
            $pchartfolder="./class/pchart2";
            $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

            if (ob_get_length() > 0 ) {
                ob_end_clean();
            }

            $PHPJasperXML->outpage("I");

        }catch (\PDOException $e) {
            $error = 'No se puede borrar los datos. Esta asociado con otra clase.';

        }

    }

}


