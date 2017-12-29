<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/usuarios/controller');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="../../img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel" > 
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="usuarioIndex">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Ver Usuario</h4>
                            </div>
                            <div class="content">
                                <div class="row">
                                <div class="row">
                <div class="col col-xs-6">
                
                </div>
                <div class="col col-xs-6 text-right">
                    <div class="col col-xs-6 pull-right">

                        <a class="glyphicon glyphicon-list standar" ng-click = "listar_entity()"></a>
                        <a class="glyphicon glyphicon-plus standar" ng-click = "agregar_entity()"></a>
                        <a class="glyphicon glyphicon-pencil standar" ng-click = "obtener_entity(<?php echo $usuario->id;?>)"></a>
                        <a class="glyphicon glyphicon-remove standar" ng-click = "borrar_entity(<?php echo $usuario->id;?>)"></a>

                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#usuario" role="tab" data-toggle="tab">Usuario</a></li>
                <li role="presentation"><a href="#audit" role="tab" data-toggle="tab">Auditoría</a></li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="usuario">
                    <div class="col-md-6 table-view">
                        <div class="panel">


                            <dt><?= __('Id') ?></dt>
                            <dd><?= $this->Number->format($usuario->id) ?></dd></br>

                            <dt><?= __('Nombres') ?></dt>
                            <dd><?= h($usuario->nombre) ?></dd></br>

                            <dt><?= __('Email') ?></dt>
                            <dd><?= h($usuario->email) ?></dd></br>

                            <dt><?= __('Rol') ?></dt>
                            <dd><?= h($usuario->rol) ?></dd></br>

                            <dt><?= __('Telefono') ?></dt>
                            <dd><?= h($usuario->telefono) ?></dd></br>


                            <dt><?= __('Direccion') ?></dt>
                            <dd><?= h($usuario->direccion) ?></dd></br>


                        </div>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="audit">
                    <div class="col-md-6 table-view">
                        <div class="panel">

                            <dt><?= __('Creado') ?></dt>
                            <dd><?= h($usuario->created) ?></dd></br>

                            <dt><?= __('Última modificiación') ?></dt>
                            <dd><?= h($usuario->modified) ?></dd></br>

                        </div>
                    </div>
                </div>

            </div>
            </div>
         </div>
   </div>
              

      </div>
  </div>
  </div>
  </div>

 <?php echo $this->element('footer');?>

</div>
</div>


</body>


</html>