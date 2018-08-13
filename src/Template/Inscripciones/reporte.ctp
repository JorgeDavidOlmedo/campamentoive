<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/inscripciones/controller');?>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="../img/sidebar-5.jpg">
        <?php echo $this->element('portrait');?>
        <div class="main-panel" >
            <?php echo $this->element('nav');?>
            <div class="content" ng-controller="inscripcionIndex">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Reporte Inscripciones</h4>
                                    <br>
                                </div>
                                <div class="content">
                                    <?= $this->Form->create(null,array('url' => array('action' => 'printInscripcion'),'target'=>'_blank','id' => 'RecipesAdd','name' => 'frmRegister','onsubmit' => 'validatefrm(); return false;')) ?>


                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <?=$this->Form->input('tipo',["id"=>"tipo", 'type'=>'select',
                                                'label'=>'Periodo',
                                                'options'=>["1" => "Enero",
                                                            "2" => "Febrero",
                                                            "3" =>"Marzo",
                                                            "4"=>"Abril",
                                                    "5"=>"Mayo",
                                                    "6"=>"Junio",
                                                    "7"=>"Julio",
                                                    "8"=>"Agosto",
                                                    "9"=>"Septiembre",
                                                    "10"=>"Octubre",
                                                    "11"=>"Noviembre",
                                                    "12"=>"Diciembre"],'class'=>'input'])?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <hr>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <?= $this->Form->button(__('Consultar'),['class'=>'btn btn-info','ng-click'=>'guardar()']) ?>
                                            <?= $this->Html->link(__('Cancelar'),['controller'=>'Pages','action' => 'home/'],['class'=>'btn btn-danger']) ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?= $this->Form->end() ?>
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

    <style>
        .dropdown-menu {
            visibility: visible;
            opacity: inherit;
        }
    </style>

