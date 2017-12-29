<?= $this->Html->script('controladores/perfil/controller');?>
<div class="content" ng-app="contalapp" ng-controller="perfilIndex">
    <div class="content">
        <?php
        $this->Html->addCrumb('Contalapp','/');
        $this->Html->addCrumb('Perfil', '/perfil/index/');
        $this->Html->addCrumb('Detalle','');
        // $this->Html->addCrumb('Add User', ['controller' => 'Users', 'action' => 'add']);
        echo $this->Html->getCrumbList();
        ?>
    </div>
    <div class="panel panel-default panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <h3 class="panel-title">Perfil</h3>
                </div>
                <div class="col col-xs-6 text-right">
                    <div class="col col-xs-6 pull-right">

                        <a class="glyphicon glyphicon-list standar" ng-click = "listar_entity()"></a>
                        <a class="glyphicon glyphicon-plus standar" ng-click = "agregar_entity()"></a>
                        <a class="glyphicon glyphicon-pencil standar" ng-click = "obtener_entity(<?php echo $perfil->id;?>)"></a>
                        <a class="glyphicon glyphicon-remove standar" ng-click = "borrar_entity(<?php echo $perfil->id;?>)"></a>

                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#modulo" role="tab" data-toggle="tab">Perfil</a></li>
                <li role="presentation"><a href="#audit" role="tab" data-toggle="tab">Auditoría</a></li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="modulo">
                    <div class="col-md-6 table-view">
                        <div class="panel">


                            <dt><?= __('Id') ?></dt>
                            <dd><?= $this->Number->format($perfil->id) ?></dd></br>

                            <dt><?= __('Descripcion') ?></dt>
                            <dd><?= $perfil->descripcion;?></dd></br>

                            <dt><?= __('Guardar') ?></dt>
                            <dd><?= $perfil->detalle_perfil[0]['guardar'];?></dd></br>

                            <dt><?= __('Modificar') ?></dt>
                            <dd><?= $perfil->detalle_perfil[0]['modificar'];?></dd></br>

                            <dt><?= __('Eliminar') ?></dt>
                            <dd><?= $perfil->detalle_perfil[0]['eliminar'];?></dd></br>

                            <dt><?= __('Consultar') ?></dt>
                            <dd><?= $perfil->detalle_perfil[0]['consultar'];?></dd></br>

                        </div>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="audit">
                    <div class="col-md-6 table-view">
                        <div class="panel">

                            <dt><?= __('Creado') ?></dt>
                            <dd><?= h($perfil->created) ?></dd></br>

                            <dt><?= __('Última modificiación') ?></dt>
                            <dd><?= h($perfil->modified) ?></dd></br>

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
