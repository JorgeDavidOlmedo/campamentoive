<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/usuariosEmpresas/controller');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel">   
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="usuarioEmpresaIndex">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Usuarios Por Empresas</h4>
                        <p class="category">Lista de Usuarios Por Empresas</p><br>
                        <?= $this->Html->link($this->Html->tag('p','Agregar Usuarios Por Empresa',['class' => '']).'', 
                        ['controller' => 'UsuariosEmpresas', 'action' => 'add'],
                        ['escape' => false])?>  
                    </div>
                    <div class="row">
                                
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Empresa</th>
                            <th>Config.</th>
                            </thead>
                            <tbody>
                            <?php foreach ($usuarios as $value):?>
                            <tr>
     
                              <td><?= $this->Number->format($value->id) ?></td>
                              <td><?= $value->usuario->has('nombre') ? $this->Html->link($value->usuario->nombre, ['controller' => 'Usuarios', 'action' => 'view', $value->usuario->id]) : '' ?></td>
                              
                              <td><strong><?= $value->empresa->descripcion;?></strong></td>
     
                                <td class="actions">
                                 <a class="glyphicon glyphicon-pencil standar" ng-click = "obtener_entity(<?php echo $value->id;?>)"></a>
                                 <a class="glyphicon glyphicon-remove standar" ng-click = "borrar_entity(<?php echo $value->id;?>)"></a>
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