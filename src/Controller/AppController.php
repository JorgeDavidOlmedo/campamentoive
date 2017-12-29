<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Log\Log;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

         $this->loadComponent('RequestHandler');
         $this->loadComponent('Flash');

    
              $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authenticate' => [
                    'Form' => [
                    'userModel' => 'Usuarios',
                    'fields' => ['username' => 'email', 'password' => 'password'],
                    'scope' => ['Usuarios.estado' => 1]
                ]


            ],
            'authError' => 'Por favor complete los campos.',
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Usuarios',
                'action' => 'login'
            ],
            'loginAction' => [

                'controller' => 'Usuarios',
                'action' => 'login'
            ],
            'storage' => 'Session'
        ]);

    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
           
        }
    }

     public function beforeFilter(Event $event)
    {

       if($this->Auth->user()!=null){

          $this->set('current_user',$this->Auth->user());

           $this->loadModel('UsuariosEmpresas');
           $empresas_for_usuario = $this->UsuariosEmpresas->find('all',array('group'=>'Empresas.id','contain'=>'Empresas'));
           $this->response->header('Access-Control-Allow-Methods','X-DEBUGKIT-ID');
           $this->verificar_business_for_user();
          $this->set(compact('empresas_for_usuario'));

       }


    }

    public function verificar_business_for_user(){

        $month = date('m');
        $year = date('Y');
        $fecha_inicio = date('Y-m-d', mktime(0,0,0, $month, 1, $year));

        $month = date('m');
        $year = date('Y');
        $day = date("d", mktime(0,0,0, $month+1, 0, $year));

        $fecha_final = date('Y-m-d', mktime(0,0,0, $month, $day, $year));

        $this->loadModel('UsuariosEmpresas');
        $empresas_for_usuario = $this->UsuariosEmpresas->find('all',array('group'=>'Empresas.id','contain'=>'Empresas'));

        $id_empresa = $this->request->session()->read('id_empresa');
        $empresa = $this->request->session()->read('empresa');
        $inicial = $this->request->session()->read("fecha_ini");
        $final = $this->request->session()->read("fecha_fin");

        foreach ($empresas_for_usuario as $value){
            if($id_empresa == '' || $id_empresa == null || $empresa == '' || $empresa == null){
                if($value->id_usuario==$this->request->session()->read('Auth.User.id')){
                    $this->request->session()->write('id_empresa', $value->empresa->id);
                    $this->request->session()->write('empresa',$value->empresa->descripcion);
                    $this->request->session()->write('fecha_ini',$fecha_inicio);
                    $this->request->session()->write('fecha_fin',$fecha_final);

                }

            }
        }
    }


    public function isAuthorized($user=null)
    {

       // echo 'LOHI';
        if (empty($this->request->params['prefix'])) {
            return true;
        }

        // Only admins can access admin functions
        if ($this->request->params['prefix'] === 'admin') {
            return (bool)($user['rol'] === 'admin');
        }


        // Default deny
        return false;
    }

}
