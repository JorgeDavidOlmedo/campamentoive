<?= $this->Html->script('controladores/menu/controllerMenu');?>
<?php
$id_empresa = $this->request->session()->read('id_empresa');
$empresa = $this->request->session()->read('empresa');
$rol_usuario= $this->request->session()->read('Auth.User.rol');

?>
<!-- CONTROLADOR APP UNIENDO EL MENU Y HOME || CIERRE DEL </DIV> AL FINAL DE HOME-->
<div ng-app="contalapp">
<div class="container-fuild" ng-controller="menuIndex">
    <?php if(isset($current_user)): ?>
    <nav id="top-menu" class="navbar navbar-inverse navbar-static">
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-example-js-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <?php echo $this->Html->link('RestorApp',array('controller'=>'pages', 'action'=>'index'), array('class'=>'navbar-brand', 'title'=>__("MetanoiApp", true)));?>
            </div>
            <div class="collapse navbar-collapse bs-example-js-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                            <?php echo  "Movimientos" ?>
                        </a>

                        
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">



                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Clientes</a>
                                <ul class="dropdown-menu">
                                   
                                    <li role="presentation"><a role="menuitemTitle" tabindex="-1"></span><?php echo __('Clientes');?></a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li class="<?php echo $this->request->session()->read("permiso_clientes_consultar");?>"><a  <?= $this->Html->link($this->Html->tag('span','',['class' => '']).'Registrar Cliente', ['controller' => 'clientes','action' => 'add'],['escape' => false])?></a></li>
                                    <li class="<?php echo $this->request->session()->read("permiso_clientes_guardar");?>"><a  <?= $this->Html->link($this->Html->tag('span','',['class' => '']).'Ver Clientes', ['controller' => 'clientes','action' => 'index'],['escape' => false])?></a></li>

                                </ul>
                            </li>

                           
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a id="drop2" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                            <?php echo __('Registros');?>
                            <!-- <span class="caret"></span> -->
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">


                                <?php if($rol_usuario=='admin'):?>

                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="#">Usuarios/Empresas</a>
                                        <ul class="dropdown-menu">
                                            <li role="presentation"><a role="menuitemTitle" tabindex="-1"></span><?php echo __('Usuarios');?></a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li><a  <?= $this->Html->link($this->Html->tag('span','',['class' => '']).'Registrar Usuario', ['controller' => 'Usuarios', 'action' => 'add'],['escape' => false])?></a></li>
                                            <li><a  <?= $this->Html->link($this->Html->tag('span','',['class' => '']).'Ver Usuarios', ['controller' => 'Usuarios', 'action' => 'index'],['escape' => false])?></a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a role="menuitemTitle" tabindex="-1"></span><?php echo __('Empresas');?></a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li><a  <?= $this->Html->link($this->Html->tag('span','',['class' => '']).'Registrar Empresa', ['controller' => 'Empresas', 'action' => 'add'],['escape' => false])?></a></li>
                                            <li><a  <?= $this->Html->link($this->Html->tag('span','',['class' => '']).'Ver Empresas', ['controller' => 'Empresas', 'action' => 'index'],['escape' => false])?></a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a role="menuitemTitle" tabindex="-1"></span><?php echo __('Usuarios por Empresas');?></a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li><a  <?= $this->Html->link($this->Html->tag('span','',['class' => '']).'Registrar Usuario por Empresa', ['controller' => 'UsuariosEmpresas', 'action' => 'add'],['escape' => false])?></a></li>
                                            <li><a  <?= $this->Html->link($this->Html->tag('span','',['class' => '']).'Ver Usuarios por Empresas', ['controller' => 'UsuariosEmpresas', 'action' => 'index'],['escape' => false])?></a></li>

                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a role="menuitemTitle" tabindex="-1"></span><?php echo __('Perfiles');?></a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li><a  <?= $this->Html->link($this->Html->tag('span','',['class' => '']).'Registrar Perfil', ['controller' => 'Perfil', 'action' => 'add'],['escape' => false])?></a></li>
                                            <li><a  <?= $this->Html->link($this->Html->tag('span','',['class' => '']).'Ver Perfiles', ['controller' => 'Perfil', 'action' => 'index'],['escape' => false])?></a></li>

                                        </ul>
                                    </li>

                                <?php else:?>

                                    <li class="dropdown-submenu">
                                        <a tabindex="-1" href="#" class="disabled">Usuarios/Empresas</a>

                                    </li>


                                <?php endif;?>


                        </ul>
                    </li>


                  

                    <?php

                        $month = date('m');
                        $year = date('Y');
                        $primer= date('Y-m-d', mktime(0,0,0, $month, 1, $year));
                        //   $datetime = new DateTime();
                        $hoy = date("Y-m-d");


                    ?>

                </ul>

                <ul id="topmenu-dropdown" class="nav navbar-nav navbar-right">
                    <li id="fat-menu" class="dropdown">
                        <a id="myAccountMenu" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">

                            <span id="username"><strong>Hola&nbsp;<?= $this->request->session()->read('Auth.User')['nombre']?> </strong></span>&nbsp;
                           </a>

                           <div id="edificio">
                             <span id="build" class="build"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Empresa: <?php echo $empresa;?> </strong></span>&nbsp;
                           </div>

                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">

                            <?php

                            $id_usuario = $this->request->session()->read('Auth.User.id');
                            ?>

                            <?php if($rol_usuario=='admin'):?>
                               <?php foreach ($empresas_for_usuario as $value):?>
                                    <?php $array = json_decode($value->empresa);?>

                                    <li role="presentation" class="view-as"><?php echo $this->Html->link($this->Html->tag('span','').$array->{'descripcion'},array('controller'=>'Usuarios', 'action'=>'setIdEmpresa',$array->{'id'},$array->{'descripcion'}) ,['escape' => false]);?></li>

                                <?php endforeach;?>

                            <?php else:?>

                                <?php foreach ($empresas_for_usuario as $value):?>
                                 <?php $array = json_decode($value->empresa);?>

                                      <?php if($value->id_usuario == $id_usuario):?>

                                        <li role="presentation" class="view-as"><?php echo $this->Html->link($this->Html->tag('span','').$array->{'descripcion'},array('controller'=>'Usuarios', 'action'=>'setIdEmpresa',$array->{'id'},$array->{'descripcion'}) ,['escape' => false]);?></li>

                                      <?php endif;?>

                                <?php endforeach;?>

                            <?php endif;?>
                            <li role="presentation" class="view-as"><?php echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-user']).' Mis datos',array('controller'=>'Usuarios', 'action'=>'datos') ,['escape' => false]);?></li>
                            <li role="presentation" style="  border-top: 1px solid #ccc;
                            padding-top: 10px;"><?php echo $this->Html->link($this->Html->tag('span','',['class' => 'glyphicon glyphicon-off']).' Salir',array('controller'=>'usuarios', 'action'=>'logout'), ['escape' => false]);?></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.nav-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

<?php endif; ?>
    <!-- TOP MENU -->

</div>

<div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-clock-o modal-icon"></i>
                <h4 class="modal-title">Tipos de Cambio</h4>
                <small><a href="http://www.cambioschaco.com.py/" target="_blank">www.cambioschaco.com.py</a></small>
            </div>
            <div class="modal-body">
                <p><?php echo $this->Html->image('loader_01.gif', ['height' => '200']);?></p>
                <p><div class="resultado" id="resultado">Consultando base de datos...</div></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>

<style type="text/css">

#myAccountMenu{
    margin-top: -10px;
    margin-bottom: -15px;
}


h4{
       font-size: 18px;
       border-bottom: none;
       padding-bottom: 10px;
       width: 480px;

   }

   hr {
       margin-top: -15px;
       margin-bottom: 20px;
       border: 1;
       border-top: 1px solid #eee;
   }

   .totalPurchases{
       margin-bottom: 20px;
       border: none;
       background: transparent;
       font-size: 28px;

   }

   .totalSales{
       margin-bottom: 20px;
       border: none;
       background: transparent;
       font-size: 28px;

   }


   .totalCobros{
       margin-bottom: 20px;
       border: none;
       background: transparent;
       font-size: 28px;

   }

   .totalPagos{
       margin-bottom: 20px;
       border: none;
       background: transparent;
       font-size: 28px;

   }

   .detalles2{
       margin-left: 20px;
   }


   #dashboard_fiter {
       display: inline-block;
       float: right;
       position: relative;

   }

   #mydate{
     text-align: center;
     width: 120px;
     background-color: transparent;
     border: transparent;
     color: black;
   }

   #mydate2{
     text-align: center;
     width: 120px;
     background-color: transparent;
     border: transparent;
     color: black;

   }

   .fechaOnly{
       color: black;
   }

   .wrapper{
       margin-top: 20px;
   }




   h4{
       font-size: 18px;
       border-bottom: none;
       padding-bottom: 10px;
       width: 480px;

   }

h3 {
  font-size: 16px;
  margin:0 0 0.3rem;
  font-weight: normal;
  font-weight:bold;
}

</style>
