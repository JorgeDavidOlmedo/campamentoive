<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/proveedores/controller');?>
<?php $id_empresa = $this->request->session()->read('id_empresa');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="../img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel" > 
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="proveedorAdd">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Agregar Proveedor</h4>
                                <br>
                            </div>
                            <div class="content">
                            <?php
                                 echo $this->Form->input('empresa',array('class' => 'form-control','label'=>'Empresa','required','type'=>'hidden','value'=>$id_empresa));
                            ?>
               <div class="row">

               <div class="col-xs-12 col-sm-6 col-md-6">
               <?=$this->Form->input('descripcion',array('class'=>'form-control','label'=>'Descripcion','ng-model'=>'proveedor.descripcion'))?>
           </div>

                </div>

                <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <?=$this->Form->input('contacto',array('class' => 'form-control','label'=>'Contactos','ng-model'=>'proveedor.contactos'))?>
                </div>

             </div>


            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                <?php
                echo $this->Form->input('email',array('class' => 'form-control','label'=>'Email','ng-model'=>'proveedor.email'));
                ?>

            </div>
            </div>

           

            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <?=$this->Form->input('documento',array('class' => 'form-control','label'=>'Documento','ng-model'=>'proveedor.documento'))?>
                </div>

             </div>


            


             <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <?=$this->Form->input('celular',array('class' => 'form-control','label'=>'Celular','ng-model'=>'proveedor.celular'))?>
                </div>

             </div>

             <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <?=$this->Form->input('celular_2',array('class' => 'form-control','label'=>'Celular 2','ng-model'=>'proveedor.celular_2'))?>
                </div>

             </div>

        

        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <?=$this->Form->input('telefono',array('class' => 'form-control','label'=>'Telefono','ng-model'=>'proveedor.telefono'))?>
            </div>

        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <?=$this->Form->input('telefono_2',array('class' => 'form-control','label'=>'Telefono 2','ng-model'=>'proveedor.telefono_2'))?>
            </div>

        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8">
                <?=$this->Form->input('direccion',array('class' => 'form-control','label'=>'Direccion','ng-model'=>'proveedor.direccion'))?>
            </div>
          
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8">
                <?=$this->Form->input('observacion',array('class' => 'form-control','label'=>'Observacion','ng-model'=>'proveedor.observacion'))?>
            </div>
          
        </div>


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


</body>


</html>