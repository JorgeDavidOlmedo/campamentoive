<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/usuarios/controller');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="../../img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel" > 
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="usuarioEdit" ng-init="cargar_datos(<?php echo $usuario->id;?>)">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Usuario</h4>
                            </div>
                            <div class="content">
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <?=$this->Form->input('email',array('class'=>'form-control','ng-model'=>'usuario.email'))?>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-4">
                    <?php
                    echo $this->Form->input('password',array('class' => 'form-control','label'=>'Password','ng-model'=>'usuario.password'));
                    ?>

                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <?=$this->Form->input('rol',array('type'=>'select',
                        'options'=>["admin" => "Admin","usuario"=>"Usuario"],'class' => 'form-control','label'=>'Rol','ng-model'=>'usuario.rol'))?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                  <?php
                  echo $this->Form->input('perfil',array('options' => $perfiles,
                      'class' => 'form-control','label'=>'Perfil','data-live-search'=>true));

                  ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <?=$this->Form->input('nombre',array('class' => 'form-control','label'=>'Nombre','ng-model'=>'usuario.nombre'))?>
                </div>

                <div class="col-xs-12 col-sm-3 col-md-3">
                    <?=$this->Form->input('telefono',array('class' => 'form-control','label'=>'Telefono','ng-model'=>'usuario.telefono'))?>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8">
                    <?=$this->Form->input('direccion',array('class' => 'form-control','label'=>'Direccion','ng-model'=>'usuario.direccion'))?>
                </div>

            </div>
            <div class="row">
                <hr>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-info',"ng-click"=>"modificar($usuario->id)"]) ?>
                    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'],['class'=>'btn btn-danger']) ?>

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
