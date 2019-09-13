<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/personas/controller');?>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="../../img/sidebar-5.jpg">
        <?php echo $this->element('portrait');?>
        <div class="main-panel" >
            <?php echo $this->element('nav');?>
            <div class="content" ng-controller="personaIndex">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Ver Persona</h4>
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
                                                    <a class="glyphicon glyphicon-pencil standar" ng-click = "obtener_entity(<?php echo $persona->id;?>)"></a>
                                                    <a class="glyphicon glyphicon-remove standar" ng-click = "borrar_entity(<?php echo $persona->id;?>)"></a>

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
                                                        <dd><?= $this->Number->format($persona->id) ?></dd></br>

                                                        <dt><?= __('Descripcion') ?></dt>
                                                        <dd><?= h($persona->descripcion) ?></dd></br>

                                                        <dt><?= __('DNI') ?></dt>
                                                        <dd><?= h($persona->dni) ?></dd></br>

                                                        <dt><?= __('Fecha Nacimiento') ?></dt>
                                                        <dd><?= date('d/m/Y',strtotime($persona->fecha_nacimiento)) ?></dd></br>

                                                        <dt><?= __('Lugar de Origen') ?></dt>
                                                        <dd><?= h($persona->lugare->descripcion) ?></dd></br>

                                                        <dt><?= __('Sexo') ?></dt>
                                                        <dd><?= h($persona->sexo) ?></dd></br>


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