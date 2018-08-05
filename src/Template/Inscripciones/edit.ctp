<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/inscripciones/controller');?>
<div ng-controller="inscripcionEdit" ng-init="cargar_datos(<?php echo $inscripcione->id;?>)">
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
                                        <h4 class="title">Editar Pre-Inscripcion</h4>
                                        <br>
                                    </div>
                                    <div class="content">



                                        <div class="row">
                                            <div class="col-xs-12 col-sm-2 col-md-2">
                                                <?php
                                                echo $this->Form->input('fecha',array('type' => 'text',
                                                    'class' => 'fechaOnly','label'=>'Fecha','id'=>'fecha',
                                                    'required'));

                                                ?>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <?=$this->Form->input('persona',array('class'=>'form-control',
                                                    'label'=>'Participante','ng-model'=>'persona','uib-typeahead-editable'=>"false" ,
                                                    'uib-typeahead'=>'p as p.descripcion for p in personas($viewValue)',
                                                    'typeahead-on-select="onSelect($item,$model,$label)"',
                                                    'placeholder'=>'Tipear Participante', 'required'))?>
                                            </div>

                                            <div class="col-xs-12 col-sm2 col-md-2">
                                                <?=$this->Form->input('dni',array('class'=>'form-control',
                                                    'label'=>'Dni','ng-model'=>'persona.dni','uib-typeahead-editable'=>"false" ,
                                                    'uib-typeahead'=>'p as p.descripcion for p in personas($viewValue)',
                                                    'typeahead-on-select="onSelect($item,$model,$label)"',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'Tipear Dni', 'required'))?>
                                            </div>

                                            <div class="col-xs-12 col-sm2 col-md-2">
                                                <?=$this->Form->input('edad',array('class' => 'form-control',
                                                    'label'=>'Edad','ng-model'=>'persona.edad',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'Tipear Edad'))?>
                                            </div>


                                            <div class="col-xs-12 col-sm-2 col-md-2">
                                                <?=$this->Form->input('sexo',["id"=>"sexo", 'type'=>'select',
                                                    'label'=>'Sexo',
                                                    'options'=>["masculino" => "Masculino","femenino"=>"Femenino"],
                                                    'class'=>'input'])?>
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

                                            <div class="col-xs-12 col-sm4 col-md-4">
                                                <?=$this->Form->input('correo',array('class' => 'form-control',
                                                    'label'=>'Correo','ng-model'=>'persona.correo',
                                                    'placeholder'=>'Tipear correo'))?>
                                            </div>


                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <?=$this->Form->input('categoria',["id"=>"categoria", 'type'=>'select',
                                                    'label'=>'Categoria',
                                                    'options'=>["participante" => "Participante","voluntario"=>"Voluntario","colaborador"=>"Colaborador"],
                                                    'class'=>'input'])?>
                                            </div>


                                        </div>



                                        <div class="row">

                                            <div class="col-xs-12 col-sm-2 col-md-2">
                                                <?=$this->Form->input('color',["id"=>"color", 'type'=>'select',
                                                    'label'=>'Color',
                                                    'options'=>["amarillo" => "Amarillo","azul"=>"Azul","rojo"=>"Rojo","verde"=>"Verde"],
                                                    'class'=>'input'])?>
                                            </div>


                                            <div class="col-xs-12 col-sm-2 col-md-2">
                                                <label>Verificar</label><br>
                                                <button class="btn btn-default">Color</button>
                                            </div>


                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <?=$this->Form->input('ficha',["id"=>"ficha", 'type'=>'select',
                                                    'label'=>'Ficha Medica',
                                                    'options'=>["si" => "Si","no"=>"No","pendiente"=>"Pendiente"],
                                                    'class'=>'input'])?>
                                            </div>

                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <?=$this->Form->input('moneda',["id"=>"moneda", 'type'=>'select',
                                                    'label'=>'Moneda',
                                                    'options'=>["peso" => "Peso","real"=>"Real","dolar"=>"Dolar","Euro"=>"euro"],
                                                    'class'=>'input'])?>
                                            </div>


                                        </div>


                                        <div class="row">

                                            <div class="col-xs-12 col-sm4 col-md-4">
                                                <?=$this->Form->input('pago',array('class' => 'form-control',
                                                    'label'=>'Pago','ng-model'=>'inscripcion.pago',
                                                    'onkeyup'=>'format(this)','onchange'=>'format(this)',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'Tipear Pago'))?>
                                            </div>

                                            <div class="col-xs-12 col-sm4 col-md-4">
                                                <?=$this->Form->input('deuda',array('class' => 'form-control',
                                                    'label'=>'Deuda','ng-model'=>'inscripcion.deuda',
                                                    'onkeyup'=>'format(this)','onchange'=>'format(this)',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'0'))?>
                                            </div>


                                        </div>


                                        <div class="row">

                                            <div class="col-xs-12 col-sm12 col-md-12">
                                                <?=$this->Form->input('obs',array('class' => 'form-control',
                                                    'label'=>'Observacion','ng-model'=>'inscripcion.observacion'
                                                ,
                                                    'placeholder'=>'Tipear Observacion'))?>
                                            </div>


                                        </div>



                                        <br>

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


        <div class="modal fade mymodal" id="form-part" tabindex="-1" role="dialog" aria-labelledby="form-part" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <strong><h4><div id="one">Agregar Participante</div></h4></strong>
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