<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/colectivos/controller');?>
<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="../img/sidebar-5.jpg">
    <?php echo $this->element('portrait');?>
    <div class="main-panel" >   
    <?php echo $this->element('nav');?>
    <div class="content" ng-controller="colectivoIndex">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Colectivos</h4>
                        <p class="category">Lista de Colectivos</p><br>
                        <?= $this->Html->link($this->Html->tag('p','Agregar Nuevo Colectivo',['class' => '']).'', 
                        ['controller' => 'Colectivos', 'action' => 'add'],
                        ['escape' => false])?>  
                    </div>
                    <div class="row">
                                
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                            <th>ID</th>
                            <th>Descripcion</th>
                            <th>Lugares</th>
                            <th>Utilizados</th>
                            <th>Disponible</th>
                            <th>Config.</th>
                            </thead>
                            <tbody>
                            <?php foreach ($colectivos as $value):?>
                                <tr>
                                    <?php if(($value->lugar-$value->ocupado)>0):?>

                                    <td><?= $this->Number->format($value->id) ?></td>
                                    <td><?= $value->has('descripcion') ? $this->Html->link($value->descripcion, ['controller' => 'Colectivos', 'action' => 'view', $value->id]) : '' ?></td>
                                    <td><?= $value->lugar; ?></td>
                                    <td><?= $value->ocupado; ?></td>
                                    <td><?= ($value->lugar-$value->ocupado); ?></td>
                                    <td class="actions">
                                        <a class="glyphicon glyphicon-pencil standar" ng-click = "obtener_entity(<?php echo $value->id;?>)"></a>
                                        <a class="glyphicon glyphicon-remove standar" ng-click = "borrar_entity(<?php echo $value->id;?>)"></a>
                                    </td>

                                    <?php else:?>

                                    <td class="datacellone"><?= $this->Number->format($value->id) ?></td>
                                    <td class="datacellone"><?= $value->has('descripcion') ? $this->Html->link($value->descripcion, ['controller' => 'Colectivos', 'action' => 'view', $value->id]) : '' ?></td>
                                    <td class="datacellone"><?= $value->lugar; ?></td>
                                    <td class="datacellone"><?= $value->ocupado; ?></td>
                                    <td class="datacellone"><?= ($value->lugar-$value->ocupado); ?> - LLENO</td>
                                    <td class="actions datacellone">
                                        <a class="glyphicon glyphicon-pencil standar" ng-click = "obtener_entity(<?php echo $value->id;?>)"></a>
                                        <a class="glyphicon glyphicon-remove standar" ng-click = "borrar_entity(<?php echo $value->id;?>)"></a>
                                    </td>

                                    <?php endif;?>
                                    

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
</div>

</body>

</html>

<style>

td.datacellone {
	background-color: #e80a33ba; color: black;
}


</style>