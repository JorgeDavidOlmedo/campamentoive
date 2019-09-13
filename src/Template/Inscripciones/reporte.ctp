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
                                    <h4 class="title"><strong>Reportes</strong></h4>
                                    <br>
                                </div>
                                <div class="content">


                                    <!--div class="row">
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
                                    </div-->

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-10 col-md-10">
                                            <?= $this->Form->button(__('Equipos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'),
                                                ['class'=>'btn btn-info','ng-click'=>'openEquipo()']) ?>
                                         </div>

                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-10 col-md-10">
                                            <?= $this->Form->button(__('Morosos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'),
                                                ['class'=>'btn btn-info','ng-click'=>'openMoroso()']) ?>
                                        </div>

                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-10 col-md-10">
                                            <?= $this->Form->button(__('Participantes&nbsp;&nbsp;'),
                                                ['class'=>'btn btn-info','ng-click'=>'openParticipante()']) ?>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-10 col-md-10">
                                            <?= $this->Form->button(__('Pasajeros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'),
                                                ['class'=>'btn btn-info','ng-click'=>'openGetPasajeros()']) ?>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-10 col-md-10">
                                            <?= $this->Form->button(__('Seguro&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'),
                                                ['class'=>'btn btn-info','ng-click'=>'openSeguro()']) ?>

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

    <style>
        .dropdown-menu {
            visibility: visible;
            opacity: inherit;
        }
    </style>

