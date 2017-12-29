<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/proveedores/controller');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="../img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel" >   
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="proveedorIndex">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Proveedores</h4>
                        <p class="category">Lista de Proveedores</p><br>
                        <?= $this->Html->link($this->Html->tag('p','Agregar Nuevo Proveedor',['class' => '']).'', 
                        ['controller' => 'Proveedores', 'action' => 'add'],
                        ['escape' => false])?>  

                                <?=$this->Form->input('buscar',array('class'=>'form-control',
                                    'label'=>'','ng-model'=>'buscar','uib-typeahead-editable'=>"false" ,
                                    'uib-typeahead'=>'p as p.descripcion+" - "+p.documento for p in proveedores($viewValue)',
                                    'typeahead-on-select="onSelect($item,$model,$label)"',
                                    'placeholder'=>'Buscar...', 'required'))?>
                    </div>
                    <div class="row">
                                
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Email</th>
                            <th>Documento</th>
                            <th>Telefono</th>
                            <th>Config.</th>
                            </thead>
                            <tbody>
                            <?php foreach ($proveedores as $proveedor):?>
                            <tr>
            
                                <td><?= $this->Number->format($proveedor->id) ?></td>
                                <td><?= $proveedor->has('descripcion') ? $this->Html->link($proveedor->descripcion, ['controller' => 'Proveedores', 'action' => 'view', $proveedor->id]) : '' ?></td>
                                <td><?= h($proveedor->email) ?></td>
                                <td><?= h($proveedor->documento) ?></td>
                                <td><?= h($proveedor->telefono) ?></td>
            
                                <td class="actions">
                                    <a class="glyphicon glyphicon-pencil standar" ng-click = "obtener_entity(<?php echo $proveedor->id;?>)"></a>
                                    <a class="glyphicon glyphicon-remove standar" ng-click = "borrar_entity(<?php echo $proveedor->id;?>)"></a>
                                </td>
            
                             </tr>
                            <?php endforeach;?>

                            </tbody>
                        </table>
                        
                        
                    </div>
                    <div class="paginator">
                            <ul class="pagination">
                                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next(__('next') . ' >') ?>
                            </ul>

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
