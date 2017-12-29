<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/usuariosEmpresas/controller');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="../../img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel" > 
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="empresaEdit" ng-init="cargar_datos(<?php echo $usuariosEmpresa->id;?>)">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Usuarios Por Empresa</h4>
                                <br>
                            </div>
                            <div class="content">

                            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <?=$this->Form->input('usuario',array('class'=>'form-control',
                    'label'=>'Usuario','ng-model'=>'usuario','uib-typeahead-editable'=>"false" ,
                    'uib-typeahead'=>'p as p.nombre for p in usuarios($viewValue)',
                    'placeholder'=>'Tipear Usuario', 'required'))?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <?=$this->Form->input('empresa',array('class'=>'form-control',
                    'label'=>'Empresa','ng-model'=>'empresa','uib-typeahead-editable'=>"false" ,
                    'uib-typeahead'=>'p as p.descripcion for p in empresas($viewValue)',
                    'placeholder'=>'Tipear Empresa','required'))?>
                </div>
            </div>



            <div class="row">
                <hr>
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


</body>


</html>

<style>
.dropdown-menu {
    visibility: visible;
    opacity: inherit;
}
</style>