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
                                    <h4 class="title"><strong>Reporte</strong></h4>
                                    <br>
                                </div>
                                <div class="content">

                                    <?= $this->Form->create(null,array('url' => array('action' => 'printEquipo'),'target'=>'_blank')) ?>



                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4 col-md-4">
                                            <h4>No existen datos a mostrar!!</h4>
                                        </div>

                                    </div>

                                    <br>


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

