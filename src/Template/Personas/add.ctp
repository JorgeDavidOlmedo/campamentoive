<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/personas/controller.js?v='.@$_SESSION['version']);?>
<div ng-controller="personaAdd">
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="../img/sidebar-5.jpg">
        <?php echo $this->element('portrait');?>
        <div class="main-panel" >
            <?php echo $this->element('nav');?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Agregar Participante</h4>
                                    <br>
                                </div>
                                <div class="content">


                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <?=$this->Form->input('descripcion',array('class' => 'form-control',
                                                'label'=>'Nombre','ng-model'=>'persona.descripcion',
                                                'placeholder'=>'Tipear descripcion'))?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm4 col-md-4">
                                            <?=$this->Form->input('dni',array('class' => 'form-control',
                                                'label'=>'Dni','ng-model'=>'persona.dni',
                                                'placeholder'=>'Tipear dni', 'type'=>'number'))?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-2 col-md-2">
                                            <?php
                                            echo $this->Form->input('fecha',array('type' => 'text',
                                                'class' => 'fechaOnly','label'=>'Fecha de Nacimiento','id'=>'fecha',
                                                'required'));

                                            ?>
                                        </div>
                                    </div>




                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <?=$this->Form->input('lugar',array('class'=>'form-control',
                                                'label'=>'Lugar Procedencia','ng-model'=>'lugar','uib-typeahead-editable'=>"false" ,
                                                'uib-typeahead'=>'p as p.descripcion for p in lugares($viewValue)',
                                                'typeahead-on-select="onSelect($item,$model,$label)"',
                                                'placeholder'=>'Tipear lugar', 'required'))?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <?= $this->Form->input('pais', ['id'=>'pais' , 'class'=>'input', 'type'=>'select',
                                                'options' => $countries,'label'=>'País','value'=>10]);?>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <?=$this->Form->input('sexo',["id"=>"sexo", 'type'=>'select',
                                                'label'=>'Sexo',
                                                'options'=>["masculino" => "Masculino","femenino"=>"Femenino"],
                                                'class'=>'input'])?>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-xs-12 col-sm4 col-md-4">
                                            <?=$this->Form->input('telefono',array('class' => 'form-control',
                                                'label'=>'Telefono','ng-model'=>'persona.telefono',
                                                'placeholder'=>'Tipear Telefono'))?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm4 col-md-4">
                                            <?=$this->Form->input('correo',array('class' => 'form-control',
                                                'label'=>'Correo','ng-model'=>'persona.correo',
                                                'placeholder'=>'Tipear correo'))?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm8 col-md-8">
                                            <?=$this->Form->input('obs',array('class' => 'form-control',
                                                'label'=>'Observacion','ng-model'=>'persona.obs',
                                                'placeholder'=>'Tipear Observacion'))?>
                                        </div>
                                    </div>


                                    <br>

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


    <div class="modal fade mymodal" id="form-lugar" tabindex="-1" role="dialog" aria-labelledby="form-lugar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><h4><div id="one">Agregar Lugar</div></h4></strong>
                </div>
                <div class="modal-body">

                    <div class="row">


                        <div class="col-xs-12 col-sm-12 col-md-12">

                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <?=$this->Form->input('descripcionl',array('class' => 'form-control',
                                        'label'=>'Descripcion','ng-model'=>'lugarl.descripcion'))?>
                                </div>
                            </div>

                        </div>
                    </div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <input type="hidden" name="myValue" id="myValue" value=""/>
                    <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-info','ng-click'=>'guardarLugar()']) ?>


                </div>
            </div>
        </div>
    </div>
</div>


<style>

    .dropdown-menu {
        visibility: visible;
        opacity: inherit;
    }
</style>