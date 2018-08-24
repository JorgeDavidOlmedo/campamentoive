<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/inscripciones/controllerfin');?>
<div ng-controller="inscripcionIndex">
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="../img/sidebar-5.jpg">
        <?php echo $this->element('portrait');?>
        <div class="main-panel" >
            <?php echo $this->element('nav');?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"><strong>Inscripciones</strong></h4><br>
                                    <button class="btn btn-secondary" ng-click="openColectivo()">Verificar Colectivos</button>

                                </div>
                                <div class="row">

                                </div>
                                <div class="content table-responsive table-full-width">
                                    <input class="form-control" placeholder="Buscar..." id="filtrar" name="filtrar">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Participante</th>
                                        <th>DNI</th>
                                        <th>Procedencia</th>
                                        <th>Ficha Medida</th>
                                        <th>Pago</th>
                                        <th>Deuda</th>
                                        <th>Correo</th>
                                        <th>Colectivo</th>
                                        <th>Estado</th>
                                        <th>Config.</th>
                                        </thead>
                                        <tbody class="buscar">
                                        <?php foreach ($inscripciones as $value):?>
                                            <tr>
                                                <?php if($value->estado_inscripcion=="pendiente"):?>
                                                <td class="datacellone"><?= $this->Number->format($value->id) ?></td>
                                                <td class="datacellone"><?= date('d/m/Y',strtotime($value->fecha)) ?></td>
                                                <td class="datacellone"><?= $value->persona->has('descripcion') ? $this->Html->link($value->persona->descripcion, ['controller' => 'Personas', 'action' => 'view', $value->persona->id]) : '' ?></td>
                                                <td class="datacellone"><?= $value->persona->dni ?></td>
                                                <td class="datacellone"><?= $value->persona->lugare->descripcion ?></td>
                                                <td class="datacellone"><?= $value->ficha_medica ?></td>
                                                <td class="datacellone"><?= number_format($value->pago) ?></td>
                                                <td class="datacellone"><?= number_format($value->deuda) ?></td>
                                                <td class="datacellone"><?= $value->persona->correo ?></td>
                                                <?php if($value->colectivo==null):?>
                                                <td class="datacellone">Sin asignar</td>
                                                <?php else:?>
                                                    <td class="datacellone"><?= $value->colectivo->descripcion ?></td>
                                                <?php endif;?>

                                                <td class="datacellone"><?= $value->estado_inscripcion ?></td>
                                                <td class="actions datacellone">
                                                    <a class="glyphicon glyphicon-pencil standar" ng-click = "obtener_entity(<?php echo $value->id;?>)"></a>
                                                    <a class="glyphicon glyphicon-remove standar" ng-click = "borrar_entity(<?php echo $value->id;?>)"></a>
                                                </td>

                                                <?php else:?>

                                                    <td class="datacelltwo"><?= $this->Number->format($value->id) ?></td>
                                                    <td class="datacelltwo"><?= date('d/m/Y',strtotime($value->fecha)) ?></td>
                                                    <td class="datacelltwo"><?= $value->persona->has('descripcion') ? $this->Html->link($value->persona->descripcion, ['controller' => 'Personas', 'action' => 'view', $value->persona->id]) : '' ?></td>
                                                    <td class="datacelltwo"><?= $value->persona->dni ?></td>
                                                    <td class="datacelltwo"><?= $value->persona->lugare->descripcion ?></td>
                                                    <td class="datacelltwo"><?= $value->ficha_medica ?></td>
                                                    <td class="datacelltwo"><?= number_format($value->pago) ?></td>
                                                    <td class="datacelltwo"><?= number_format($value->deuda) ?></td>
                                                    <td class="datacelltwo"><?= $value->persona->correo ?></td>
                                                    <?php if($value->colectivo==null):?>
                                                        <td class="datacelltwo">Sin asignar</td>
                                                    <?php else:?>
                                                        <td class="datacelltwo"><?= $value->colectivo->descripcion ?></td>
                                                    <?php endif;?>

                                                    <td class="datacelltwo"><?= $value->estado_inscripcion ?></td>
                                                    <td class="actions datacelltwo">
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

<div class="modal fade mymodal" id="form-bondi" tabindex="-1" role="dialog" aria-labelledby="form-bondi" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <strong><h4><div id="one">Colectivos</div></h4></strong>
            </div>
            <div class="modal-body">

                <div class="content table-responsive table-full-width">
                    <div class="detalleColectivos">
                        <table class="table table-hover table-striped">
                            <thead>
                            <th>Descripcion</th>
                            <th>Categoria</th>
                            <th>Lugares</th>
                            <th>Utilizados</th>
                            <th>Disponible</th>
                            </thead>
                            <tbody class="buscar">
                            <?php foreach ($bondis as $value):?>
                                <tr>
                                    <?php if(($value->lugar-$value->ocupado)>0):?>

                                        <td class="datacelltwo"><?= $value->descripcion?></td>
                                        <td class="datacelltwo"><?= $value->categoria ?></td>
                                        <td class="datacelltwo"><?= $value->lugar; ?></td>
                                        <td class="datacelltwo"><?= $value->ocupado; ?></td>
                                        <td class="datacelltwo"><?= ($value->lugar-$value->ocupado); ?></td>

                                    <?php else:?>
                                        <td class="datacellone"><?= $value->descripcion?></td><td class="datacellone"><?= $value->categoria ?></td>
                                        <td class="datacellone"><?= $value->lugar; ?></td>
                                        <td class="datacellone"><?= $value->ocupado; ?></td>
                                        <td class="datacellone"><?= ($value->lugar-$value->ocupado); ?> - LLENO</td>

                                    <?php endif;?>


                                </tr>
                            <?php endforeach;?>

                            </tbody>
                        </table>

                    </div>
                </div>


            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                <input type="hidden" name="myValue" id="myValue" value=""/>

            </div>
        </div>
    </div>
</div>

</div>

</body>

</html>

<style>

    td.datacellone {
        background-color: #cc6d7eba; color: black;
    }

    td.datacelltwo {
        background-color: #64ca9cba; color: black;
    }

    a{
        color: #2234ce;
    }

    a:hover, a:focus {
        color: #2234ce;
        text-decoration: none;
    }

    td.datacellone {
        background-color: #cc6d7eba; color: black;
    }

    td.datacelltwo {
        background-color: #64ca9cba; color: black;
    }

    .detalleColectivos{
        height:450px;
        overflow-y : auto;


</style>



