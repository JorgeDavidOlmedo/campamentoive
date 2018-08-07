<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/eventos/controller');?>
<div ng-controller="eventoEdit" ng-init="cargar_datos(<?php echo $evento->id;?>)">
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
                                        <h4 class="title">Editar Evento</h4>
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
                                                <?=$this->Form->input('descripcion',array('class' => 'form-control',
                                                    'label'=>'Descripcion','ng-model'=>'evento.descripcion',
                                                    'placeholder'=>'Tipear descripcion'))?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm4 col-md-4">
                                                <?=$this->Form->input('cupo_p',array('class' => 'form-control',
                                                    'label'=>'Cupo Participante','ng-model'=>'evento.cupo_participante',
                                                    'onkeyup'=>'format(this)','onchange'=>'format(this)',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'Tipear cupo'))?>
                                            </div>

                                            <div class="col-xs-12 col-sm4 col-md-4">
                                                <?=$this->Form->input('costo_p',array('class' => 'form-control',
                                                    'label'=>'Costo Participante','ng-model'=>'evento.costo_participante',
                                                    'onkeyup'=>'format(this)','onchange'=>'format(this)',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'Tipear costo'))?>
                                            </div>

                                        </div>




                                        <div class="row">
                                            <div class="col-xs-12 col-sm4 col-md-4">
                                                <?=$this->Form->input('cupo_v',array('class' => 'form-control',
                                                    'label'=>'Cupo Voluntario','ng-model'=>'evento.cupo_voluntario',
                                                    'onkeyup'=>'format(this)','onchange'=>'format(this)',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'Tipear cupo'))?>
                                            </div>

                                            <div class="col-xs-12 col-sm4 col-md-4">
                                                <?=$this->Form->input('costo_v',array('class' => 'form-control',
                                                    'label'=>'Costo Voluntario','ng-model'=>'evento.costo_voluntario',
                                                    'onkeyup'=>'format(this)','onchange'=>'format(this)',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'Tipear costo'))?>
                                            </div>

                                        </div>




                                        <div class="row">
                                            <div class="col-xs-12 col-sm4 col-md-4">
                                                <?=$this->Form->input('cupo_c',array('class' => 'form-control',
                                                    'label'=>'Cupo Colaborador','ng-model'=>'evento.cupo_colaborador',
                                                    'onkeyup'=>'format(this)','onchange'=>'format(this)',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'Tipear cupo'))?>
                                            </div>

                                            <div class="col-xs-12 col-sm4 col-md-4">
                                                <?=$this->Form->input('costo_c',array('class' => 'form-control',
                                                    'label'=>'Costo Colaborador','ng-model'=>'evento.costo_colaborador',
                                                    'onkeyup'=>'format(this)','onchange'=>'format(this)',
                                                    'onkeypress'=>"return (event.charCode >= 48 && event.charCode <= 57) ||  
                                                     event.charCode == 44 || event.charCode == 0 ",
                                                    'placeholder'=>'Tipear costo'))?>
                                            </div>

                                        </div>


                                        <br>

                                        <div class="row">

                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-info',"ng-click"=>"modificar($evento->id)"])  ?>
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

