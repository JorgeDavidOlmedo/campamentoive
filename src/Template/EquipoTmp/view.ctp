<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Equipo Tmp'), ['action' => 'edit', $equipoTmp->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Equipo Tmp'), ['action' => 'delete', $equipoTmp->id], ['confirm' => __('Are you sure you want to delete # {0}?', $equipoTmp->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Equipo Tmp'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Equipo Tmp'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="equipoTmp view large-9 medium-8 columns content">
    <h3><?= h($equipoTmp->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Color') ?></th>
            <td><?= h($equipoTmp->color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sexo') ?></th>
            <td><?= h($equipoTmp->sexo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($equipoTmp->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Obs') ?></th>
            <td><?= h($equipoTmp->obs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($equipoTmp->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contador') ?></th>
            <td><?= $this->Number->format($equipoTmp->contador) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edad') ?></th>
            <td><?= $this->Number->format($equipoTmp->edad) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Evento') ?></th>
            <td><?= $this->Number->format($equipoTmp->id_evento) ?></td>
        </tr>
    </table>
</div>
