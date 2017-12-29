<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/empresas/controller');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="../img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel" > 
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="empresaAdd">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Agregar Empresa</h4>
                                <br>
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
                <hr>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-info','ng-click'=>'guardar()']) ?>
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