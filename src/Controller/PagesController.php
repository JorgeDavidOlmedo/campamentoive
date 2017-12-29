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

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display()
    {
        $path = func_get_args();
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        //consultar perfiles - una sola vez
        $this->cargar_permisos();

        $this->set(compact('page', 'subpage'));

        try {
          $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }

    public function cargar_permisos(){

      if($this->request->session()->read("permisos")==0){
        $id_perfil = $this->Auth->user('id_perfil');
        $this->loadModel("Perfil");
        $perfil = $this->Perfil->find("all")->where(['id'=>$id_perfil])->contain(['DetallePerfil']);
        $row = $perfil->first();
          if(count($row)>0){
            $this->request->session()->write("permisos",1);
          }else{
            $this->request->session()->write("permisos",0);
          }

          foreach ($perfil as $value) {
            foreach ($value->detalle_perfil as $value_detalle) {
              
               //Permisos clientes
               if($value_detalle->id_model==10){
                 $this->request->session()->write("permiso_clientes_guardar",$value_detalle->guardar);
                 $this->request->session()->write("permiso_clientes_consultar",$value_detalle->consultar);
                 $this->request->session()->write("permiso_clientes_eliminar",$value_detalle->eliminar);
                 $this->request->session()->write("permiso_clientes_modificar",$value_detalle->modificar);

               }

            }
          }
      }
    }
}
