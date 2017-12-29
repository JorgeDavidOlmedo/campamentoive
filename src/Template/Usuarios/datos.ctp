<?= $this->Html->script('controladores/usuarios/controller');?>
<div class="content" ng-app="contalapp" ng-controller="usuarioIndex">
    <div class="content">
        <?php
            $aplicacion = $this->request->session()->read("aplicacion");
            $this->Html->addCrumb($aplicacion,'/');
            $this->Html->addCrumb('Usuarios', '/usuarios/index/');
            $this->Html->addCrumb('Detalle','');
            // $this->Html->addCrumb('Add User', ['controller' => 'Users', 'action' => 'add']);
            echo $this->Html->getCrumbList();
        ?>
    </div>
    <div class="panel panel-default panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <h3 class="panel-title">Usuario</h3>
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

<style>

    .standar{
        cursor: pointer;
        font-size: 16px;
        padding: 5px;
    }

</style>
