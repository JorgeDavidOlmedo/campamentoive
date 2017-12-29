<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/empresas/controller');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="../../img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel" > 
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="empresaEdit" ng-init="cargar_datos(<?php echo $empresa->id;?>)">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Empresa</h4>
                            </div>
                            <div class="content">
                            <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <?=$this->Form->input('descripcion',array('class'=>'form-control','label'=>'Descripcion','ng-model'=>'empresa.descripcion','required'))?>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <?php
                                echo $this->Form->input('ruc',array('class' => 'form-control','label'=>'Ruc','ng-model'=>'empresa.ruc','required'));
                                ?>
                            </div>
            
                        </div>
            
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <?php
                                echo $this->Form->input('Telefono',array('class' => 'form-control','label'=>'Telefono','ng-model'=>'empresa.telefono','required'));
                                ?>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <?=$this->Form->input('Direccion',array('class' => 'form-control','label'=>'Direccion','ng-model'=>'empresa.direccion','required'))?>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <?=$this->Form->input('Representante',array('class' => 'form-control','label'=>'Representante','ng-model'=>'empresa.representante','required'))?>
                            </div>
            
                        </div>
            
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-4">
                                <?php
                                echo $this->Form->input('ruc_representante',array('class' => 'form-control','label'=>'Ruc-Representante','ng-model'=>'empresa.ruc_representante','required'));
                                ?>
                            </div>
            
                            <div class="col-xs-12 col-sm-2 col-md-2">
                                <?php
                                echo $this->Form->input('dv_representante',array('class' => 'form-control','label'=>'Dv-Representante','ng-model'=>'empresa.dv_representante','required'));
                                ?>
            
                            </div>
            
                        </div>
            
                        <div class="row">
                            <hr>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-info',"ng-click"=>"modificar($empresa->id)"]) ?>
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
