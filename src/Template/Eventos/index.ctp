<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/eventos/controller');?>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="../img/sidebar-5.jpg">
        <?php echo $this->element('portrait');?>
        <div class="main-panel" >
            <?php echo $this->element('nav');?>
            <div class="content" ng-controller="eventoIndex">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Eventos</h4>
                                    <p class="category">Lista de Eventos</p><br>
                                    <?= $this->Html->link($this->Html->tag('p','Agregar Nuevo Evento',['class' => '']).'',
                                        ['controller' => 'Eventos', 'action' => 'add'],
                                        ['escape' => false])?>
                                </div>
                                <div class="row">

                                </div>
                                <div class="content table-responsive table-full-width">
                                    <input class="form-control" placeholder="Buscar..." id="filtrar" name="filtrar">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <th>ID</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Descripcion</th>
                                        <th>Cupos Participante</th>
                                        <th>Costo Participante</th>
                                        <th>Cupos Voluntario</th>
                                        <th>Costo Voluntario</th>
                                        <th>Config.</th>
                                        </thead>
                                        <tbody class="buscar">
                                        <?php foreach ($eventos as $value):?>
                                            <tr>

                                                <td><?= $this->Number->format($value->id) ?></td>
                                                <td><?= date('d/m/Y',strtotime($value->fecha_inicio)) ?></td>
                                                <td><?= date('d/m/Y',strtotime($value->fecha_fin)) ?></td>
                                                <td><?= $value->has('descripcion') ? $this->Html->link($value->descripcion, ['controller' => 'Lugares', 'action' => 'view', $value->id]) : '' ?></td>
                                                <td><?= $value->cupo_participante ?></td>
                                                <td><?= number_format($value->costo_participante) ?></td>
                                                <td><?= $value->cupo_voluntario ?></td>
                                                <td><?= number_format($value->costo_voluntario) ?></td>

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



