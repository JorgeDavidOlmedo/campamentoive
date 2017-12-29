<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
/**
 * Proveedores Controller
 *
 * @property \App\Model\Table\ProveedoresTable $Proveedores
 */
class ProveedoresController extends AppController
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
            'conditions'=>array('and'=>array('Proveedores.estado'=>1),
                array('Proveedores.id_empresa'=>$id_empresa)),
            'order'=>['Proveedores.id DESC'],
            'limit'=>25
        ];

        $proveedores = $this->paginate($this->Proveedores);

        $this->set(compact('proveedores'));
        $this->set('_serialize', ['proveedores']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function saldoproveedor()
    {
        $id_empresa = $this->request->session()->read('id_empresa');
        $query = $this->Proveedores->find('all')->where(array('estado'=>1,'id_empresa'=>$id_empresa));

        $this->paginate = array(
            'limit' => 4
        );
        $clientes = $this->paginate($query);
        $this->loadModel("Locales");
        $this->loadModel("Monedas");
        $locales = $this->Locales->find("list",['keyField' => 'id','valueField' => 'descripcion'])->where(['id_empresa'=>$id_empresa,'estado'=>1]);
        $monedas = $this->Monedas->find("list",['keyField' => 'id','valueField' => 'descripcion'])->where(['estado'=>1]);

        $this->set(compact('proveedores','locales','monedas'));
        $this->set('_serialize', ['proveedores']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function amortizacionproveedor()
    {
        $id_empresa = $this->request->session()->read('id_empresa');
        $this->loadModel('Proveedores');
        $query = $this->Proveedores->find('all')->where(array('estado'=>1,'id_empresa'=>$id_empresa));

        $this->paginate = array(
            'limit' => 4
        );
        $clientes = $this->paginate($query);
        $this->loadModel("Locales");
        $this->loadModel("Monedas");
        $locales = $this->Locales->find("list",['keyField' => 'id','valueField' => 'descripcion'])->where(['id_empresa'=>$id_empresa,'estado'=>1]);
        $monedas = $this->Monedas->find("list",['keyField' => 'id','valueField' => 'descripcion'])->where(['estado'=>1]);

        $this->set(compact('proveedores','locales','monedas'));
        $this->set('_serialize', ['proveedores']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function printSaldoProveedor()
    {

        require_once(ROOT . DS . 'webroot' . DS . "class/tcpdf" . DS . "tcpdf.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "PHPJasperXML.inc.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "setting.php");



        try{

        $local = $this->request->data['local'];
        $moneda = $this->request->data['moneda'];
        $cliente = explode("-",$this->request->data['client']);
        $cliente = $cliente[0];
        $desde = explode("/",$this->request->data['desde']);
        $desde = $desde[2]."-".$desde[1]."-".$desde[0];
        $informe = $this->request->data['informe'];
        $id_empresa = $this->request->session()->read('id_empresa');
        $user_id = $this->request->session()->read('Auth.User.id');

        $PHPJasperXML = new \PHPJasperXML();

        $results=null;
        $connection = ConnectionManager::get('default');

        $filter = "";
        if(empty($local)){
            $filter.=" AND ventas.id_local>=1";
        }else{
            $filter.=" AND ventas.id_local=".$local;
        }
        if(empty($moneda)){
            $filter.=" AND ventas.id_moneda>=1";
        }else{
            $filter.=" AND ventas.id_moneda=".$moneda;
        }

        if(empty($cliente)){
            $filter.=" AND a.id_proveedor>=1";
        }else{
            $filter.=" AND a.id_proveedor=".$cliente;
        }

        if($informe=="detallado"){

            if(empty($moneda)){
                $file = "informes/saldo_proveedores/saldoproveedordetalle.jrxml";
               
            }else{
                $file = "informes/saldo_proveedores/saldoproveedordetalletodos.jrxml";
            }
            $tipo_venta = "Total Por Proveedor";
            $query = "SELECT
                         a.id_proveedor AS idCliente,
                         (a.monto) AS monto,
                         a.id_empresa as empresa,
                         clientes.descripcion AS cliente,
                         clientes.id as id_cliente,
                         ventas.documento AS documento,
                         a.id_compra AS idVenta,
                         a.fecha AS fecha,
                         a.nro_cuota AS nro_cuota,
                         a.plazo AS plazo,
                         a.id_empresa as id_empresa,
                         a.id AS id,
                         UPPER(ventas.tipo_compra) as tipo_venta,
                         ventas.id as id_venta,
                         CONCAT(nro_cuota, '/', plazo) AS cuota,
                         a.vencimiento AS vencimiento,
                         ventas.tipo_cambio AS tipo_cambio,
                         ((a.monto)*ventas.tipo_cambio) AS monto_local
                         FROM
                         vencimientos_compras a,
                         proveedores clientes,
                         compras ventas
                         WHERE
                         ventas.id=a.id_compra AND
                         clientes.id = a.id_proveedor AND
                         a.fecha <= '".$desde."'
                         ".$filter."
                         order by cliente,documento,nro_cuota";

        }else{

            if(empty($moneda)){
                $file = "informes/saldo_proveedores/saldoproveedorresumido.jrxml";
                
            }else{
                $file = "informes/saldo_proveedores/saldoproveedorresumidotodos.jrxml";
            }
            $tipo_venta = "Total Por Tipo de Compra";
            $query = "SELECT
                         a.id as id,
                         a.fecha as fecha,
                         a.id_empresa as id_empresa,
                         SUM(a.monto) as monto,
                         SUM(a.pago_monto) as cobro_monto,
                         clientes.descripcion as cliente,
                         clientes.id as id_cliente,
                         ventas.documento AS documento,
                         ventas.id as id_venta,
                         a.nro_cuota as nro_cuota,
                         a.vencimiento as vencimiento,
                         a.plazo as plazo,
                         ventas.tipo_cambio AS tipo_cambio,
                         UPPER(ventas.tipo_compra) as tipo_venta,
                         ventas.tipo_cambio as tc,
                          (SUM(a.monto)*ventas.tipo_cambio) as total_local
                         FROM
                         vencimientos_compras a,
                         proveedores clientes,
                         compras ventas
                         WHERE
                         ventas.id=a.id_compra AND
                         clientes.id = a.id_proveedor AND
                         a.fecha <= '".$desde."'
                         ".$filter."
                         GROUP BY cliente ORDER BY cliente,documento,nro_cuota";
        }


            $local_descripcion = "";
            if(!empty($local)){
                $this->loadModel("Locales");
                $local_consulta= $this->Locales->find("all")->where(['id'=>$local,'id_empresa'=>$id_empresa]);

                foreach ($local_consulta as $value){
                    $local_descripcion = $value->descripcion;
                }
            }else{
                    $local_descripcion = "Todos";
            }
            $moneda_descripcion = "";
            if(!empty($moneda)){
                $this->loadModel("Monedas");
                $moneda_descripcion= $this->Monedas->find("all")->where(['id'=>$moneda,'estado'=>1]);

                foreach ($moneda_descripcion as $value){
                    $moneda_descripcion = $value->descripcion;
                }
            }else{
                $moneda_descripcion = "Todos";
            }
            $empresa_descripcion = "";
            $empresa_direccion = "";
            $empresa_ruc = "";
            $empresa_contacto = "";
            $this->loadModel("Empresas");
            $empresa= $this->Empresas->find("all")->where(['id'=>$id_empresa,'estado'=>1]);

            foreach ($empresa as $value){
                $empresa_descripcion = $value->descripcion;
                $empresa_direccion = $value->direccion;
                $empresa_ruc = $value->ruc;
                $empresa_contacto = $value->telefono;
            }
            $hoy = date("Y-m-d");
            $hoy = explode("-",$hoy);
            $hoy = $hoy[2].'/'.$hoy[1].'/'.$hoy[0];

            $desde = explode("-",$desde);
            $desde = $desde[2].'/'.$desde[1].'/'.$desde[0];
            $hora = date("H:i:s");

            $results = $connection->execute($query);
            $sql_insert = "";
            $desde_pago = explode("/",$this->request->data['desde']);
            $desde_pago = $desde_pago[2]."-".$desde_pago[1]."-".$desde_pago[0];
            foreach ($results as $key => $value) {

                try{
                    $sql_insert = "INSERT INTO saldoproveedor_tmp
                    (id,
                    id_vencimiento_compra,
                    vencimiento,
                    fecha,
                    id_empresa,
                    id_proveedor,
                    monto,
                    cobro_monto,
                    proveedor,
                    documento,
                    id_compra,
                    nro_cuota,
                    plazo,
                    tipo_cambio,
                    id_usuario,
                    tipo_compra)
                    VALUES
                    (0,
                    ".$value['id'].",
                    '".$value['vencimiento']."',
                    '".$value['fecha']."',
                    ".$value['id_empresa'].",
                    ".$value['id_cliente'].",
                    '".$value['monto']."',
                    0,
                    '".$value['cliente']."',
                    '".$value['documento']."',
                    ".$value['id_venta'].",
                    ".$value['nro_cuota'].",
                    ".$value['plazo'].",
                    '".$value['tipo_cambio']."',
                    ".$user_id.",
                    '".$value['tipo_venta']."'
                    )";

                    $results = $connection->execute($sql_insert);
                    $sql = "SELECT b.id_vencimiento_compra as id_vencimiento,b.monto as monto FROM pagos a, detalles_pagos b WHERE a.id=b.id_pago AND b.id_vencimiento_compra=".$value['id']." AND a.estado=1 AND a.fecha <= '".$desde_pago."'";
                    $results_update = $connection->execute($sql);

                        $sql_update = "";
                        foreach ($results_update as $key_update => $value_update) {
                            $sql_update="UPDATE saldoproveedor_tmp SET cobro_monto='".$value_update['monto']."' WHERE id_vencimiento_compra=".$value['id'];
                            $connection->execute($sql_update);
                        }


                     }catch (\PDOException $e) {
                             echo $e;
                     }

            }

            //echo 'asdf';
            //die();
            if($informe=="detallado"){

                  $query = "SELECT
                         id_proveedor AS idCliente,
                         (monto-cobro_monto) AS monto,
                         id_empresa as empresa,
                         proveedor AS cliente,
                         id_proveedor as id_cliente,
                         documento AS factura,
                         id_compra AS idVenta,
                         fecha AS fecha,
                         nro_cuota AS nro_cuota,
                         plazo AS plazo,
                         id_empresa as id_empresa,
                         id AS id,
                         id_compra as id_venta,
                         CONCAT(nro_cuota, '/', plazo) AS cuota,
                         vencimiento AS vencimiento,
                         tipo_cambio AS tc,
                         ((monto-cobro_monto)*tipo_cambio) AS monto_local
                         FROM saldoproveedor_tmp
                         WHERE id_usuario=".$user_id." AND
                         id_empresa=".$id_empresa." AND
                         (monto-cobro_monto>0)
                         ORDER BY cliente,documento,nro_cuota";

        }else{

                $query = "SELECT
                         id as id,
                         fecha as fecha,
                         id_empresa as id_empresa,
                         SUM(monto-cobro_monto) as monto,
                         SUM(cobro_monto) as cobro_monto,
                         proveedor as cliente,
                         id_proveedor as id_cliente,
                         documento AS factura,
                         id_compra as id_venta,
                         nro_cuota as nro_cuota,
                         plazo as plazo,
                         tipo_cambio AS tc,
                         UPPER(tipo_compra) as tipo_venta,
                         tipo_cambio as tc,
                          (SUM(monto-cobro_monto)*tipo_cambio) as total_local
                         FROM
                         saldoproveedor_tmp
                         WHERE id_usuario=".$user_id." AND
                         id_empresa=".$id_empresa." AND
                         (monto-cobro_monto>0)
                         GROUP BY cliente ORDER BY cliente,documento,nro_cuota";
        }


        $results_tmp = $connection->execute($query);

        if(count($results_tmp)<=0){
              return $this->redirect(['controller' => 'asientos','action' => 'nodata']);
        };

          $PHPJasperXML->arrayParameter=array("parameter1"=>1,"parametro_empresa"=>$empresa_descripcion,
            "factura"=>"Nro.",
            "direccion"=>$empresa_direccion,
            "ruc"=>$empresa_ruc,
            "contacto"=>$empresa_contacto,
            "fecha"=>$hoy,
            "usuario"=>$this->Auth->user('email'),
            "saldoal"=>$desde,
            "moneda"=>$moneda_descripcion,
            "local"=>$local_descripcion,
            "query"=>$query,
            "total_factura"=>"Total Por Factura",
            "total_cliente"=>$tipo_venta,
            "total_general"=>"Total General",
            "empresa_software"=>"Todos los derechos reservados.",
            "empresa_descripcion"=>"Contalapp S.A - 0986 669 700",
            "pagina"=>"Pag. Nro.",
            "fecha_impresion"=>"Fecha Impresion:".$hoy,
            "hora_impresion"=>"Hora Impresion:".$hora);

            $PHPJasperXML->load_xml_file($file);
            $server=$server;
            $db=$db;
            $user=$user;
            $pass=$pass;
            $version="0.9d";
            $pgport=5432;
            $pchartfolder="./class/pchart2";
            $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

            //ob_end_clean();
            if (ob_get_length() > 0 ) {
                ob_end_clean();
            }

            $PHPJasperXML->outpage("I");

            $connection->execute("DELETE FROM saldoproveedor_tmp WHERE id_empresa=".$id_empresa." AND id_usuario=".$user_id);
            $sql_select_tmp="SELECT id FROM saldoproveedor_tmp";
            $resultado_tmp = $conn->execute($sql_select_tmp);
            if(count($resultado_tmp)<=0){
              $sql_init="ALTER TABLE saldoproveedor_tmp AUTO_INCREMENT = 1";
              $conn->execute($sql_init);

            }

             }catch (\PDOException $e) {
             $error = 'No se puede borrar los datos. Esta asociado con otra clase.';
                // The exact error message is $e->getMessage();
                //var_dump($e);
               }



    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function printAmortizacionProveedor()
    {

        require_once(ROOT . DS . 'webroot' . DS . "class/tcpdf" . DS . "tcpdf.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "PHPJasperXML.inc.php");
        require_once(ROOT . DS . 'webroot' . DS . "class" . DS . "setting.php");



        try{

        $local = $this->request->data['local'];
        $moneda = $this->request->data['moneda'];
        $persona = explode("-",$this->request->data['proveedor']);
        $persona = $persona[0];
        $desde = explode("/",$this->request->data['desde']);
        $desde = $desde[2]."-".$desde[1]."-".$desde[0];
        $id_empresa = $this->request->session()->read('id_empresa');
        $user_id = $this->request->session()->read('Auth.User.id');

        $PHPJasperXML = new \PHPJasperXML();

         $file = "informes/amortizacion_proveedores/amortizacionproveedores.jrxml";

            $results=null;
            $connection = ConnectionManager::get('default');

            if(empty($persona)){

                $query = "SELECT a.id as id,
                c.descripcion as cliente,
                d.total as credito,
                d.documento as nrofactura,
                a.documento as docu,
                e.vencimiento as fecha,
                e.monto as montocred,
                a.fecha as vencimiento,
                b.monto as monto,
                d.total as misaldo,
                (b.monto) as mimonto,
                CONCAT(e.nro_cuota,'/',e.plazo) as cuota
                FROM pagos a,detalles_pagos b,proveedores c,compras d,vencimientos_compras e 
                WHERE a.id=b.id_pago AND e.id_compra=d.id AND e.id_proveedor=c.id 
                AND a.estado=1 AND b.id_vencimiento_compra=e.id GROUP BY b.id ORDER BY a.documento,e.nro_cuota";

            }else{
                $query = "SELECT a.id as id,
                c.descripcion as cliente,
                d.total as credito,
                d.documento as nrofactura,
                a.documento as docu,
                e.vencimiento as fecha,
                e.monto as montocred,
                a.fecha as vencimiento,
                b.monto as monto,
                d.total as misaldo,
                (b.monto) as mimonto,
                CONCAT(e.nro_cuota,'/',e.plazo) as cuota
                FROM pagos a,detalles_pagos b,proveedores c,compras d,vencimientos_compras e 
                WHERE a.id=b.id_pago AND e.id_compra=d.id AND e.id_proveedor=c.id 
                AND a.estado=1 AND b.id_vencimiento_compra=e.id AND 
                e.id_proveedor=".$persona." GROUP BY b.id ORDER BY a.documento,e.nro_cuota";
            }   
           

            
            $results_tmp = $connection->execute($query);
            
            if(count($results_tmp)<=0){
                 return $this->redirect(['controller' => 'asientos','action' => 'nodata']);
            };


            $desde_pago = explode("/",$this->request->data['desde']);
            $desde_pago = $desde_pago[2]."-".$desde_pago[1]."-".$desde_pago[0];
      
            /*************DATOS ADICIONALES*********************/

            $local_descripcion = "";
            if(!empty($local)){
                $this->loadModel("Locales");
                $local_consulta= $this->Locales->find("all")->where(['id'=>$local,'id_empresa'=>$id_empresa]);

                foreach ($local_consulta as $value){
                    $local_descripcion = $value->descripcion;
                }
            }else{
                    $local_descripcion = "Todos";
            }
            $moneda_descripcion = "";
            if(!empty($moneda)){
                $this->loadModel("Monedas");
                $moneda_descripcion= $this->Monedas->find("all")->where(['id'=>$moneda,'estado'=>1]);

                foreach ($moneda_descripcion as $value){
                    $moneda_descripcion = $value->descripcion;
                }
            }else{
                $moneda_descripcion = "Todos";
            }
            $empresa_descripcion = "";
            $empresa_direccion = "";
            $empresa_ruc = "";
            $empresa_contacto = "";
            $this->loadModel("Empresas");
            $empresa= $this->Empresas->find("all")->where(['id'=>$id_empresa,'estado'=>1]);

            foreach ($empresa as $value){
                $empresa_descripcion = $value->descripcion;
                $empresa_direccion = $value->direccion;
                $empresa_ruc = $value->ruc;
                $empresa_contacto = $value->telefono;
            }
            $hoy = date("Y-m-d");
            $hoy = explode("-",$hoy);
            $hoy = $hoy[2].'/'.$hoy[1].'/'.$hoy[0];

            $desde = explode("-",$desde);
            $desde = $desde[2].'/'.$desde[1].'/'.$desde[0];
            $hora = date("H:i:s");


            /***************************************************/
           $PHPJasperXML->arrayParameter=array("parameter1"=>1,"parametro_empresa"=>$empresa_descripcion,
            "factura"=>"Monto Credito: ",
            "nroFact"=>"Factura: ",
            "direccion"=>$empresa_direccion,
            "ruc"=>$empresa_ruc,
            "contacto"=>$empresa_contacto,
            "fecha"=>$hoy,
            "usuario"=>$this->Auth->user('email'),
            "saldoal"=>$desde,
            "moneda"=>$moneda_descripcion,
            "local"=>$local_descripcion,
            "query"=>$query,
            "total_factura"=>"Monto Total Pagado",
            "total_cliente"=>$tipo_venta,
            "total_general"=>"Total General",
            "empresa_software"=>"Todos los derechos reservados.",
            "empresa_descripcion"=>"Contalapp S.A - 0986 669 700",
            "pagina"=>"Pag. Nro.",
            "fecha_impresion"=>"Fecha Impresion:".$hoy,
            "hora_impresion"=>"Hora Impresion:".$hora);

            $PHPJasperXML->load_xml_file($file);
            $server=$server;
            $db=$db;
            $user=$user;
            $pass=$pass;
            $version="0.9d";
            $pgport=5432;
            $pchartfolder="./class/pchart2";
            $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

            //ob_end_clean();
            if (ob_get_length() > 0 ) {
                ob_end_clean();
            }
           
            $PHPJasperXML->outpage("I");

            $connection->execute("DELETE FROM saldoproveedor_tmp WHERE id_empresa=".$id_empresa." 
            AND id_usuario=".$user_id);


             }catch (\PDOException $e) {
             $error = 'No se puede borrar los datos. Esta asociado con otra clase.';
                // The exact error message is $e->getMessage();
                //var_dump($e);
               }



    }

    /**
     * View method
     *
     * @param string|null $id Proveedore id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $id_empresa = $this->request->session()->read('id_empresa');
        $proveedore = $this->Proveedores->get($id, [
            'contain' => [],
            'conditions'=>['id_empresa'=>$id_empresa,'estado'=>1]
        ]);

        $this->set('proveedore', $proveedore);
        $this->set('_serialize', ['proveedore']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $proveedore = $this->Proveedores->newEntity();
        if ($this->request->is('post')) {
            $proveedore = $this->Proveedores->patchEntity($proveedore, $this->request->data);
            if ($this->Proveedores->save($proveedore)) {
                $this->Flash->success(__('The proveedore has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The proveedore could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('proveedore'));
        $this->set('_serialize', ['proveedore']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Proveedore id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $proveedore = $this->Proveedores->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proveedore = $this->Proveedores->patchEntity($proveedore, $this->request->data);
            if ($this->Proveedores->save($proveedore)) {
                $this->Flash->success(__('The proveedore has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The proveedore could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('proveedore'));
        $this->set('_serialize', ['proveedore']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Proveedore id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $proveedore = $this->Proveedores->get($id);
        if ($this->Proveedores->delete($proveedore)) {
            $this->Flash->success(__('The proveedore has been deleted.'));
        } else {
            $this->Flash->error(__('The proveedore could not be deleted. Please, try again.'));
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

                $proveedor = $this->Proveedores->newEntity($this->request->data);

                if ($this->Proveedores->save($proveedor)) {
                    $conn->commit();
                    $mensaje = "ok";
                    //$this->Flash->success(__('El proveedor se guardo correctamente.'));
                } else {
                    $conn->rollback();
                   // $mensaje = "error";
                }

            }catch (\PDOException $e)
            {
                $conn->rollback();
                $mensaje = $e;
                $this->Flash->error(__('Error al guardar. vuelva a intentar.'.$e));
            }
        }

        $this->set([
            'mensaje' => $mensaje,
            'proveedor' => $proveedor,
            '_serialize' => ['mensaje', 'proveedor']
        ]);
        $this->viewClass = 'Json';
        $this->render();

    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addEntityModel()
    {
        if ($this->request->is('post')) {

            $conn = ConnectionManager::get('default');
            $conn->begin();

            try{

                $proveedor = $this->Proveedores->newEntity($this->request->data);

                if ($this->Proveedores->save($proveedor)) {
                    $conn->commit();
                    $mensaje = "ok";
                } else {
                    $conn->rollback();
                    $mensaje = "error";
                }

            }catch (\PDOException $e)
            {
                $conn->rollback();
                $mensaje = $e;
                $this->Flash->error(__('Error al guardar. vuelva a intentar.'.$e));
            }
        }

        $this->set([
            'mensaje' => $mensaje,
            'proveedor' => $proveedor,
            '_serialize' => ['mensaje', 'proveedor']
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

        $proveedor =$this->Proveedores->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            try{

                $proveedor = $this->Proveedores->patchEntity($proveedor, $this->request->data);
                if ($this->Proveedores->save($proveedor)) {
                    $mensaje = "Proveedor modificado.";
                } else {
                    $mensaje = "error al modificar.";
                }

            }catch (\PDOException $e)
            {

                $mensaje = "error al editar.";
                //$this->Flash->error(__('Error al editar. vuelva a intentar.'));
            }


        }

        $this->set([
            'mensaje' => $mensaje,
            'proveedor' => proveedor,
            '_serialize' => ['mensaje', 'proveedor']
        ]);
        $this->viewClass = 'Json';
        $this->render();
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function getEntity($empresa = null,$idEmpresa = null, $entidad = null, $id = null)
    {

        $proveedor = $this->Proveedores->find('all',
            array('conditions'=>array('Proveedores.id'=>$id,'Proveedores.id_empresa'=>$idEmpresa)));

        $this->set([
            'proveedor' => $proveedor,
            '_serialize' => ['proveedor']
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

            $proveedor = TableRegistry::get('Proveedores');
            $query = $proveedor->query();
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
    public function getEntityAll($idEmpresa = null)
    {

        $proveedores = $this->Proveedores->find('all',array('conditions'=>array('estado'=>1,'id_empresa'=>$idEmpresa),'order'=>array("id desc")));

        $this->set([
            'proveedores' => $proveedores,
            '_serialize' => ['proveedores']
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

        //PROVEEDORES
        $results = $connection->execute(
            "SELECT id,descripcion,documento,email FROM proveedores WHERE id_empresa=".$id_empresa." and estado=1 and
            (descripcion like '%".$term."%' or documento like '%".$term."%')");

        $resultado_proveedor = array();
        foreach ($results as $value){
            $resultado_proveedor[] = array("id"=>$value['id'],
                "descripcion"=> $value['descripcion'],
                "documento"=> $value['documento'],
                "html"=> $value['id'].' -'.'&nbsp;&nbsp;<font color="black"><b>Proveedor:&nbsp;</b></font> '.$value['descripcion']);
        }

        $proveedores = $resultado_proveedor;
        $this->set([
            'proveedores' => $proveedores,
            '_serialize' => ['proveedores']
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
