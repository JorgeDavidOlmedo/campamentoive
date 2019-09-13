<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/colectivos/controller');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="../img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel" > 
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="colectivoAdd">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Agregar Vehículos</h4>
                                <br>
                            </div>
                            <div class="content">


             <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <?=$this->Form->input('descripcion',array('class' => 'form-control',
                    'label'=>'Descripcion','ng-model'=>'colectivo.descripcion'))?>
                </div>
           </div>


        <div class="row">

            <div class="col-xs-12 col-sm-4 col-md-4">
                <?=$this->Form->input('categoria',["id"=>"categoria", 'type'=>'select',
                    'label'=>'Categoria',
                    'options'=>["ninguno"=>"Ninguno", "masculino" => "Masculino","femenino"=>"Femenino"],
                    'class'=>'input'])?>
            </div>
        </div>

           

            <div class="row">
                <div class="col-xs-12 col-sm-2 col-md-2">
                    <?=$this->Form->input('lugar',array('class' => 'form-control',
                    'label'=>'Lugares','ng-model'=>'colectivo.lugar',
                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                           event.charCode == 46 || event.charCode == 0 "))?>
                </div>
             
           </div>


            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <?=$this->Form->input('patente',array('class' => 'form-control',
                        'label'=>'Patente','ng-model'=>'colectivo.patente'))?>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <?=$this->Form->input('destino',array('class' => 'form-control',
                        'label'=>'Destino','ng-model'=>'colectivo.destino'))?>
                </div>

            </div>

            
            <div class="row">

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
</div>

</body>


</html>

