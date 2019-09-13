<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/lugares/controller');?>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="../../img/sidebar-5.jpg">
        <?php echo $this->element('portrait');?>
        <div class="main-panel" >
            <?php echo $this->element('nav');?>
            <div class="content" ng-controller="lugarIndex">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Ver Lugar</h4>
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
                                                    <a class="glyphicon glyphicon-pencil standar" ng-click = "obtener_entity(<?php echo $lugare->id;?>)"></a>
                                                    <a class="glyphicon glyphicon-remove standar" ng-click = "borrar_entity(<?php echo $lugare->id;?>)"></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">

                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#usuario" role="tab" data-toggle="tab">Colectivo</a></li>
                                            <li role="presentation"><a href="#audit" role="tab" data-toggle="tab">Auditoría</a></li>

                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="usuario">
                                                <div class="col-md-6 table-view">
                                                    <div class="panel">


                                                        <dt><?= __('Id') ?></dt>
                                                        <dd><?= $this->Number->format($lugare->id) ?></dd></br>

                                                        <dt><?= __('Descripcion') ?></dt>
                                                        <dd><?= h($lugare->descripcion) ?></dd></br>

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
</div>

</body>


</html>