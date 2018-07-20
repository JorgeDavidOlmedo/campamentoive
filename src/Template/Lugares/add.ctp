<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/lugares/controller');?>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="../img/sidebar-5.jpg">
        <?php echo $this->element('portrait');?>
        <div class="main-panel" >
            <?php echo $this->element('nav');?>
            <div class="content" ng-controller="lugarAdd">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Agregar Lugar</h4>
                                    <br>
                                </div>
                                <div class="content">


                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <?=$this->Form->input('descripcion',array('class' => 'form-control',
                                                'label'=>'Descripcion','ng-model'=>'lugar.descripcion'))?>
                                        </div>
                                    </div>



                                    <div class="row">

                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-info','ng-click'=>'guardar()']) ?>
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
</div>

</body>


</html>
