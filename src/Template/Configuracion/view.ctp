<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Configuracion'), ['action' => 'edit', $configuracion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Configuracion'), ['action' => 'delete', $configuracion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configuracion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Configuracion'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuracion'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="configuracion view large-9 medium-8 columns content">
    <h3><?= h($configuracion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($configuracion->descripcion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($configuracion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Costo Voluntario') ?></th>
            <td><?= $this->Number->format($configuracion->costo_voluntario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Costo Colaborador') ?></th>
            <td><?= $this->Number->format($configuracion->costo_colaborador) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Costo Participante') ?></th>
            <td><?= $this->Number->format($configuracion->costo_participante) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cupo Participante') ?></th>
            <td><?= $this->Number->format($configuracion->cupo_participante) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cupo-voluntario') ?></th>
            <td><?= $this->Number->format($configuracion->cupo-voluntario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= $this->Number->format($configuracion->estado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($configuracion->fecha) ?></td>
        </tr>
    </table>
</div>
