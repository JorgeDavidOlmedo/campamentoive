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
    public function index()
    {

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

        //$usuario = $this->Usuarios->newEntity();

        if ($this->request->is('post')) {

            try{
                $this->request->data['pago'] = str_replace('.','',$this->request->data['pago']);
                $this->request->data['deuda'] = str_replace('.','',$this->request->data['deuda']);
                $inscripcion = $this->Inscripciones->newEntity($this->request->data);
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


