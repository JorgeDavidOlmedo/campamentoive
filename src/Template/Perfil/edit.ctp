<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/perfil/controller');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="../../img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel" > 
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="perfilEdit" ng-init="cargar_datos(<?php echo $perfil->id;?>)">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Perfil Por Usuario</h4>
                            </div>
                            <div class="content">
                            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                  <?=$this->Form->input('idPerfil',array('class'=>'form-control hidden','label'=>'','ng-model'=>'perfil.id','required'))?>
                  <?=$this->Form->input('descripcion',array('class'=>'form-control','label'=>'Descripcion','ng-model'=>'perfil.descripcion','required'))?>
                </div>
            </div>
            <br>
            <hr>
            <div class="row">

              <div class="col-xs-6 col-sm-2 col-md-2">
                      <?php
                      echo $this->Form->input('models',array('empty'=>'Seleccionar','options' => $models,
                          'class' => 'form-control','label'=>'Models','data-live-search'=>true));

                      ?>
                </div>

               <div class="col-xs-6 col-sm-2 col-md-2">

                 <?=$this->Form->input('type',["id"=>"guardar", 'type'=>'select',
                    'label'=>'Guardar',
                    'options'=>["enabled" => "Enabled", "disabled" => "Disabled"],'class'=>'input'])?>
                </div>

                <div class="col-xs-6 col-sm-2 col-md-2">

                  <?=$this->Form->input('type',["id"=>"modificar", 'type'=>'select',
                     'label'=>'Modificar',
                     'options'=>["enabled" => "Enabled", "disabled" => "Disabled"],'class'=>'input'])?>
                 </div>

                 <div class="col-xs-6 col-sm-2 col-md-2">

                   <?=$this->Form->input('type',["id"=>"eliminar", 'type'=>'select',
                      'label'=>'Eliminar',
                      'options'=>["enabled" => "Enabled", "disabled" => "Disabled"],'class'=>'input'])?>
                  </div>

                  <div class="col-xs-6 col-sm-2 col-md-2">

                    <?=$this->Form->input('type',["id"=>"consultar", 'type'=>'select',
                       'label'=>'Consultar',
                       'options'=>["enabled" => "Enabled", "disabled" => "Disabled"],'class'=>'input'])?>
                   </div>

                <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="customer"></label>
                                    <button class="btn btn-white calc" type="button" ng-click="agregarPerfil()">Agregar</button>
                                </div>
                </div>

            </div>

            </br>

            <div class="row">

                <div class="col-md-12">


                    <table class="table table-responsive table-bordered" id="idtable">

                        <thead>
                        <tr>
                            <th>Models</th>
                            <th>Guardar</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                            <th>Consultar</th>
                            <th>Accion.</th>
                        </tr>
                        </thead>


                        <tbody class="items" ng-repeat="c in detallePerfil">
                             <td class="hidden">{{c.id_model}}</td>
                             <td>{{c.model.descripcion}}</td>
                             <td>{{c.guardar}}</td>
                             <td>{{c.modificar}}</td>
                             <td>{{c.eliminar}}</td>
                             <td>{{c.consultar}}</td>
                              <td class="actions">
                              <a class="glyphicon glyphicon-pencil standar" ng-click = "editarPermiso(c.id)"></a>
                              <a class="glyphicon glyphicon-remove standar" ng-click = "removeRow(c.id_model)"></a>
                              </td>

                        </tbody>

                        <tfoot>


                        <tr>
                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-info',"ng-click"=>"editarPerfil()"]) ?>
                    <?= $this->Html->link(__('Cancelar'), ['action' => 'index/'],['class'=>'btn btn-danger']) ?>

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

<style>

    .btn {
        font-size: 13px;
    }

    .calc{
        margin-top: 23px;
    }

    .btn-rojo:hover, .btn-default.active, .btn-default:active, .btn-default.focus, .btn-default:focus {
    background-color: #eeeef6;
    color: #000000;
    outline: none !important;
    }


