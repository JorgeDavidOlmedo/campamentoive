<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/lugares/controller');?>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="../img/sidebar-5.jpg">
        <?php echo $this->element('portrait');?>
        <div class="main-panel" >
            <?php echo $this->element('nav');?>
            <div class="content" ng-controller="lugarIndex">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Lugares</h4>
                                    <p class="category">Lista de Lugares</p><br>
                                    <?= $this->Html->link($this->Html->tag('p','Agregar Nuevo Lugar',['class' => '']).'',
                                        ['controller' => 'Lugares', 'action' => 'add'],
                                        ['escape' => false])?>
                                </div>
                                <div class="row">

                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <th>ID</th>
                                        <th>Descripcion</th>
                                        <th>Config.</th>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($lugares as $value):?>
                                            <tr>


                                                    <td><?= $this->Number->format($value->id) ?></td>
                                                    <td><?= $value->has('descripcion') ? $this->Html->link($value->descripcion, ['controller' => 'Lugares', 'action' => 'view', $value->id]) : '' ?></td>

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
</div>

</body>

</html>

<style>

    td.datacellone {
        background-color: #e80a33ba; color: black;
    }



