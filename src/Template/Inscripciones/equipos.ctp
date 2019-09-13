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
                                    <h4 class="title"><strong>Reporte Equipos</strong></h4>
                                    <br>
                                </div>
                                <div class="content">

                                    <?= $this->Form->create(null,array('url' => array('action' => 'printEquipo'),'target'=>'_blank')) ?>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <?=$this->Form->input('equipo',["id"=>"equipo", 'type'=>'select',
                                                'label'=>'Equipo',
                                                'options'=>["todos" => "Todos","rojo"=>"Rojo",
                                                    "amarillo"=>"Amarillo",
                                                    "azul"=>"Azul",
                                                    "naranja"=>"Naranja"],
                                                'class'=>'input'])?>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <?=$this->Form->input('categoria',["id"=>"categoria", 'type'=>'select',
                                                'label'=>'Categoria',
                                                'options'=>["todos" => "Todos",
                                                    "masculino_mayor"=>"Masculino Mayor",
                                                    "masculino_menor"=>"Masculino Menor",
                                                    "femenino_menor"=>"Femenino Menor",
                                                    "femenino_mayor"=>"Femenino Mayor",
                                                    "femenino"=>"Femenino",
                                                    "masculino"=>"Masculino"],
                                                'class'=>'input'])?>
                                        </div>

                                    </div>

                                    <br>
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <?= $this->Form->button(__('Consultar'),['class'=>'btn btn-info']) ?>
                                            <?= $this->Form->end() ?>
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

