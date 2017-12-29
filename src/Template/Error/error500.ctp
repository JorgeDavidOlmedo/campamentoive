<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/usuarios/controller');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="../img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel" >   
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="usuarioIndex">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                    <h4><strong>No existen datos a mostrar!!!</strong></h4> 
                    <button class="btn btn-default" ng-click="volver()">Volver</button>
                    </div>
                    <div class="row">
                                 
                    </div>
                    <div class="content table-responsive table-full-width">
                        
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


