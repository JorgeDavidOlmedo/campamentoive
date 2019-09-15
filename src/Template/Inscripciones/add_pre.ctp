<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/inscripciones/controller.js?v='.@$_SESSION['version']);?>
<div ng-controller="inscripcionAdd">
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
                                        <h4 class="title">Agregar Inscripcion</h4>
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
                                                    'label'=>'Nombre','ng-model'=>'persona','uib-typeahead-editable'=>"false" ,
                                                    'uib-typeahead'=>'p as p.descripcion +" - Edad: "+p.edad for p in personas($viewValue)',
                                                    'typeahead-on-select="onSelect($item,$model,$label)"',
                                                    'placeholder'=>'Tipear Nombre', 'required',
                                                    'autocomplete'=>'off'))?>
                                            </div>

                                            <div class="col-xs-12 col-sm2 col-md-2">
                                                <?=$this->Form->input('dni',array('class'=>'form-control',
                                                    'label'=>'Dni','ng-model'=>'persona.dni','uib-typeahead-editable'=>"false" ,
                                                    'uib-typeahead'=>'p as p.descripcion for p in personas($viewValue)',
                                                    'typeahead-on-select="onSelect($item,$model,$label)"',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'Tipear Dni', 'required','readonly',
                                                    'autocomplete'=>'off'))?>
                                            </div>

                                            <div class="col-xs-12 col-sm2 col-md-2">
                                                <?=$this->Form->input('edad',array('class' => 'form-control',
                                                    'label'=>'Edad','ng-model'=>'persona.edad',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'Tipear Edad','readonly',
                                                    'autocomplete'=>'off'))?>
                                            </div>


                                            <div class="col-xs-12 col-sm-2 col-md-2">
                                                <?=$this->Form->input('sexo',["id"=>"sexo", 'type'=>'select',
                                                    'label'=>'Sexo',
                                                    'options'=>["masculino" => "Masculino","femenino"=>"Femenino"],
                                                    'class'=>'input','disabled'])?>
                                            </div>


                                        </div>



                                        <div class="row">

                                            <div class="col-xs-12 col-sm-3 col-md-3">
                                                <?=$this->Form->input('lugar',array('class'=>'form-control',
                                                    'label'=>'Lugar Procedencia','ng-model'=>'lugar','uib-typeahead-editable'=>"false" ,
                                                    'uib-typeahead'=>'p as p.descripcion for p in lugares($viewValue)',
                                                    'typeahead-on-select="onSelect($item,$model,$label)"',
                                                    'placeholder'=>'Tipear lugar', 'required','readonly',
                                                    'autocomplete'=>'off'))?>
                                            </div>

                                            <div class="col-xs-12 col-sm-3 col-md-3">
                                                <?=$this->Form->input('pais',array('class' => 'form-control',
                                                    'label'=>'Pais','ng-model'=>'persona.pais',
                                                    'placeholder'=>'Tipear Pais','readonly'))?>
                                            </div>

                                            <div class="col-xs-12 col-sm-3 col-md-3">
                                                <?=$this->Form->input('correo',array('class' => 'form-control',
                                                    'label'=>'Correo','ng-model'=>'persona.correo',
                                                    'placeholder'=>'Tipear correo','readonly',
                                                    'autocomplete'=>'off'))?>
                                            </div>




                                            <div class="col-xs-12 col-sm-3 col-md-3">
                                                <?=$this->Form->input('categoria',["id"=>"categoria", 'type'=>'select',
                                                    'label'=>'Categoria',
                                                    'options'=>["participante" => "Participante","voluntario"=>"Voluntario","colaborador"=>"Colaborador"],
                                                    'class'=>'input'])?>
                                            </div>


                                        </div>



                                        <div class="row">

                                            <div class="col-xs-12 col-sm-2 col-md-2">
                                                <?=$this->Form->input('color',["id"=>"color", 'type'=>'select',
                                                    'label'=>'Equipo',
                                                    'options'=>["sin_definir"=>"Sin Definir", "amarillo" => "Amarillo","azul"=>"Azul","rojo"=>"Rojo","naranja"=>"Naranja"],
                                                    'class'=>'input'])?>
                                            </div>


                                             <div class="col-xs-12 col-sm-2 col-md-2">
                                               <label>Verificar</label><br>
                                               <button class="btn btn-default" ng-click="openColor()">Equipo</button>
                                            </div>


                                            <div class="col-xs-12 col-sm-3 col-md-3">
                                                <?=$this->Form->input('ficha',["id"=>"ficha", 'type'=>'select',
                                                    'label'=>'Ficha Medica',
                                                    'options'=>["pendiente"=>"Pendiente","si" => "Si","no"=>"No"],
                                                    'class'=>'input'])?>
                                            </div>

                                            <div class="col-xs-12 col-sm-3 col-md-3">
                                                <?=$this->Form->input('aut',["id"=>"aut", 'type'=>'select',
                                                    'label'=>'Autorizacion',
                                                    'options'=>["pendiente"=>"Pendiente","si" => "Si","no"=>"No"],
                                                    'class'=>'input'])?>
                                            </div>



                                        </div>


                                        <div class="row">

                                        <div class="col-xs-12 col-sm-3 col-md-3">
                                            <?=$this->Form->input('viaja',["id"=>"viaja", 'type'=>'select',
                                                'label'=>'Acompañante',
                                                'options'=>["no"=>"No","si" => "Si"],
                                                'class'=>'input'])?>
                                        </div>


                                         <div class="col-xs-12 col-sm4 col-md-4">
                                                <?=$this->Form->input('pago',array('class' => 'form-control',
                                                    'label'=>'Pago','ng-model'=>'inscripcion.pago',
                                                    'onkeyup'=>'format(this)','onchange'=>'format(this)',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'Tipear Pago',
                                                    'ng-blur'=>'calcularDeuda()',
                                                    'autocomplete'=>'off'))?>
                                         </div>

                                          <div class="col-xs-12 col-sm4 col-md-4">
                                                <?=$this->Form->input('deuda',array('class' => 'form-control',
                                                    'label'=>'Deuda','ng-model'=>'inscripcion.deuda',
                                                    'onkeyup'=>'format(this)','onchange'=>'format(this)',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'0','readonly',
                                                    'autocomplete'=>'off'))?>
                                         </div>


                                        </div>


                                        <div class="row">

                                            <div class="col-xs-12 col-sm12 col-md-12">
                                                <?=$this->Form->input('obs',array('class' => 'form-control',
                                                    'label'=>'Observacion','ng-model'=>'inscripcion.observacion'
                                                     ,
                                                    'placeholder'=>'Tipear Observacion',
                                                    'autocomplete'=>'off'))?>
                                            </div>


                                        </div>

                                        <div class="row">

                                            <div class="col-xs-12 col-sm6 col-md-6">
                                                <?=$this->Form->input('responsable',array('class' => 'form-control',
                                                    'label'=>'Responsable','ng-model'=>'inscripcion.responsable'
                                                ,
                                                    'placeholder'=>'Tipear Responsable',
                                                    'autocomplete'=>'off'))?>
                                            </div>

                                            <div class="col-xs-12 col-sm6 col-md-6">
                                                <?=$this->Form->input('responsable_tel',array(
                                                    'id'=>'responsable_tel', 'class' => 'form-control',
                                                    'label'=>'Nro. Contacto Responsable','ng-model'=>'inscripcion.responsable_tel'
                                                ,
                                                    'placeholder'=>'Tipear Nro. Contacto Responsable',
                                                    'autocomplete'=>'off'))?>
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
                                        <?=$this->Form->input('descripcioni',array('class' => 'form-control',
                                            'id'=>'descripcioni',
                                            'label'=>'Participante','ng-model'=>'participante.descripcion',
                                            'autocomplete'=>'off'))?>
                                    </div>

                                    <div class="col-xs-12 col-sm4 col-md-4">
                                        <?=$this->Form->input('dni',array('class' => 'form-control',
                                            'label'=>'Dni','ng-model'=>'participante.dni',
                                            'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                            'placeholder'=>'Tipear dni',
                                            'autocomplete'=>'off'))?>
                                    </div>

                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">

                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <?php
                                    echo $this->Form->input('fechai',array('type' => 'text',
                                        'class' => 'fechaOnly','label'=>'Fecha Nacimiento','id'=>'fechai',
                                        'required'));

                                    ?>
                                </div>

                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <?=$this->Form->input('lugari',array('class'=>'form-control',
                                        'label'=>'Lugar Procedencia','ng-model'=>'lugari','uib-typeahead-editable'=>"false" ,
                                        'uib-typeahead'=>'p as p.descripcion for p in lugares($viewValue)',
                                        'placeholder'=>'Tipear lugar', 'required',
                                        'autocomplete'=>'off',
                                        'autocomplete'=>'off'))?>
                                </div>

                            </div>

                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12">

                                <div class="row">

                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <?=$this->Form->input('sexoi',["id"=>"sexoi", 'type'=>'select',
                                            'label'=>'Sexo',
                                            'options'=>["masculino" => "Masculino","femenino"=>"Femenino"],
                                            'class'=>'input'])?>
                                    </div>

                                    <div class="col-xs-12 col-sm-8 col-md-8">
                                        <?=$this->Form->input('correoi',array('class' => 'form-control',
                                            'id'=>'correoi',
                                            'label'=>'Correo','ng-model'=>'participante.correo',
                                            'autocomplete'=>'off'))?>
                                    </div>



                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">

                                <div class="row">


                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <?=$this->Form->input('telefonoi',array('class' => 'form-control',
                                            'id'=>'telefonoi',
                                            'label'=>'Nro. Telefono','ng-model'=>'participante.telefono'))?>
                                    </div>

                                    <div class="col-xs-12 col-sm-8 col-md-8">
                                        <?= $this->Form->input('paisi', ['id'=>'paisi' , 'class'=>'input', 'type'=>'select',
                                            'options' => $countries,'label'=>'País','value'=>10]);?>
                                    </div>

                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">

                                <div class="row">


                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <?=$this->Form->input('obsi',array('class' => 'form-control',
                                            'id'=>'obsi',
                                            'label'=>'Observacion','ng-model'=>'participante.obs'))?>
                                    </div>


                                </div>

                            </div>


                        </div>


                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                        <input type="hidden" name="myValue" id="myValue" value=""/>
                        <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-info','ng-click'=>'guardarParticipante()']) ?>


                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade mymodal" id="form-color" tabindex="-1" role="dialog" aria-labelledby="form-color" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <strong><h4><div id="one">Colores</div></h4></strong>
                    </div>
                    <div class="modal-body">

                        <div class="row">


                            <div class="font-icon-list col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xs-3 ">
                                <a><div class="font-icon-detail rojo">
                                        <div class="pedido">
                                            <h5> <strong>Varones Grandes: {{rojo_mayor}}</strong></h5>
                                            <h5> <strong>Varones Menores: {{rojo_menor}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Subtotal Varones: {{rojo_mayor + rojo_menor}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Mujeres Grandes: {{ rojo_mayor_fem }}</strong></h5>
                                            <h5> <strong>Mujeres Menores: {{ rojo_menor_fem}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Subtotal Mujeres: {{rojo_mayor_fem + rojo_menor_fem}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Total Por Equipo: {{rojo_mayor + rojo_menor + rojo_mayor_fem + rojo_menor_fem}}</strong></h5>
                                            <hr>
                                        </div>


                                    </div></a>
                            </div>

                            <div class="font-icon-list col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xs-3 ">
                                <a><div class="font-icon-detail azul">
                                        <div class="pedido">
                                            <h5> <strong>Varones Grandes: {{azul_mayor}}</strong></h5>
                                            <h5> <strong>Varones Menores: {{azul_menor}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Subtotal Varones: {{azul_mayor + azul_menor}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Mujeres Grandes: {{ azul_mayor_fem }}</strong></h5>
                                            <h5> <strong>Mujeres Menores: {{azul_menor_fem}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Subtotal Mujeres: {{azul_mayor_fem + azul_menor_fem}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Total Por Equipo: {{azul_mayor + azul_menor + azul_mayor_fem + azul_menor_fem}}</strong></h5>

                                            <hr>
                                        </div>


                                    </div></a>
                            </div>

                            <div class="font-icon-list col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xs-3 ">
                                <a><div class="font-icon-detail verde">
                                        <div class="pedido">
                                            <h5> <strong>Varones Grandes: {{verde_mayor}}</strong></h5>
                                            <h5> <strong>Varones Menores: {{verde_menor}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Subtotal Varones: {{verde_mayor + verde_menor}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Mujeres Grandes: {{ verde_mayor_fem }}</strong></h5>
                                            <h5> <strong>Mujeres Menores: {{ verde_menor_fem}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Subtotal Mujeres: {{verde_mayor_fem + verde_menor_fem}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Total Por Equipo: {{verde_mayor + verde_menor + verde_mayor_fem + verde_menor_fem}}</strong></h5>

                                            <hr>
                                        </div>

                                    </div></a>
                            </div>


                            <div class="font-icon-list col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xs-3 ">
                                <a><div class="font-icon-detail naranja">
                                        <div class="pedido">
                                            <h5> <strong>Varones Grandes: {{amarillo_mayor}}</strong></h5>
                                            <h5> <strong>Varones Menores: {{amarillo_menor}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Subtotal Varones: {{amarillo_mayor + amarillo_menor}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Mujeres Grandes: {{ amarillo_mayor_fem }}</strong></h5>
                                            <h5> <strong>Mujeres Menores: {{ amarillo_menor_fem}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Subtotal Mujeres: {{amarillo_mayor_fem + amarillo_menor_fem}}</strong></h5>
                                            <hr>
                                            <h5> <strong>Total Por Equipo: {{amarillo_mayor + amarillo_menor + amarillo_mayor_fem + amarillo_menor_fem}}</strong></h5>

                                            <hr>
                                        </div>


                                    </div></a>
                            </div>


                        </div>




                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                        <input type="hidden" name="myValue" id="myValue" value=""/>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade mymodal" id="form-bondi" tabindex="-1" role="dialog" aria-labelledby="form-bondi" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <strong><h4><div id="one">Colectivos</div></h4></strong>
                    </div>
                    <div class="modal-body">

                        <div class="content table-responsive table-full-width">
                            <div class="detalleColectivos">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <th>Descripcion</th>
                                    <th>Categoria</th>
                                    <th>Lugares</th>
                                    <th>Utilizados</th>
                                    <th>Disponible</th>
                                    </thead>
                                    <tbody class="buscar">
                                    <?php foreach ($bondis as $value):?>
                                        <tr>
                                            <?php if(($value->lugar-$value->ocupado)>0):?>

                                                <td class="datacelltwo"><?= $value->descripcion?></td>
                                                <td class="datacelltwo"><?= $value->categoria ?></td>
                                                <td class="datacelltwo"><?= $value->lugar; ?></td>
                                                <td class="datacelltwo"><?= $value->ocupado; ?></td>
                                                <td class="datacelltwo"><?= ($value->lugar-$value->ocupado); ?></td>

                                            <?php else:?>
                                                <td class="datacellone"><?= $value->descripcion?></td><td class="datacellone"><?= $value->categoria ?></td>
                                                <td class="datacellone"><?= $value->lugar; ?></td>
                                                <td class="datacellone"><?= $value->ocupado; ?></td>
                                                <td class="datacellone"><?= ($value->lugar-$value->ocupado); ?> - LLENO</td>

                                            <?php endif;?>


                                        </tr>
                                    <?php endforeach;?>

                                    </tbody>
                                </table>

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                        <input type="hidden" name="myValue" id="myValue" value=""/>

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

        .rojo{
            background-color: #ff000096;
        }

        .azul{

            background-color: #2e2ef5cf;
        }

        .verde{

            background-color: rgba(234, 255, 15, 0.68);
        }

        .naranja{

            background-color: #f76d1e

        }

        h5{
            color:#080505;
        }

    </style>
