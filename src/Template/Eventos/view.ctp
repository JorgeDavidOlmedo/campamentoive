<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Evento'), ['action' => 'edit', $evento->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Evento'), ['action' => 'delete', $evento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evento->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Eventos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evento'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="eventos view large-9 medium-8 columns content">
    <h3><?= h($evento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($evento->descripcion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($evento->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cupo Participante') ?></th>
            <td><?= $this->Number->format($evento->cupo_participante) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Costo Participante') ?></th>
            <td><?= $this->Number->format($evento->costo_participante) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cupo Voluntario') ?></th>
            <td><?= $this->Number->format($evento->cupo_voluntario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Costo Voluntario') ?></th>
            <td><?= $this->Number->format($evento->costo_voluntario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cupo Colaborador') ?></th>
            <td><?= $this->Number->format($evento->cupo_colaborador) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Costo Colaborador') ?></th>
            <td><?= $this->Number->format($evento->costo_colaborador) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Costo') ?></th>
            <td><?= $this->Number->format($evento->costo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= $this->Number->format($evento->estado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($evento->fecha) ?></td>
        </tr>
    </table>
</div>
