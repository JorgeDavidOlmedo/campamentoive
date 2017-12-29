<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/proveedores/controller');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="../../img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel" > 
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="proveedorIndex">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Ver Proveedor</h4>
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
                        <a class="glyphicon glyphicon-pencil standar" ng-click = "obtener_entity(<?php echo $proveedore->id;?>)"></a>
                        <a class="glyphicon glyphicon-remove standar" ng-click = "borrar_entity(<?php echo $proveedore->id;?>)"></a>

                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#usuario" role="tab" data-toggle="tab">Proveedor</a></li>
                <li role="presentation"><a href="#audit" role="tab" data-toggle="tab">Auditoría</a></li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="usuario">
                    <div class="col-md-6 table-view">
                        <div class="panel">


                            <dt><?= __('Id') ?></dt>
                            <dd><?= $this->Number->format($proveedore->id) ?></dd></br>

                            <dt><?= __('Nombres') ?></dt>
                            <dd><?= h($proveedore->descripcion) ?></dd></br>

                            <dt><?= __('Email') ?></dt>
                            <dd><?= h($proveedore->email) ?></dd></br>

                            <dt><?= __('Telefono') ?></dt>
                            <dd><?= h($proveedore->telefono) ?></dd></br>

                            <dt><?= __('Direccion') ?></dt>
                            <dd><?= h($proveedore->direccion) ?></dd></br>


                        </div>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="audit">
                    <div class="col-md-6 table-view">
                        <div class="panel">

                            <dt><?= __('Creado') ?></dt>
                            <dd><?= h($proveedore->created) ?></dd></br>

                            <dt><?= __('Última modificiación') ?></dt>
                            <dd><?= h($proveedore->modified) ?></dd></br>

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