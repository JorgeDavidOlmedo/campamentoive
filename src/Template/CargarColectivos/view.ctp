<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cargar Colectivo'), ['action' => 'edit', $cargarColectivo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cargar Colectivo'), ['action' => 'delete', $cargarColectivo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cargarColectivo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cargar Colectivos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cargar Colectivo'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cargarColectivos view large-9 medium-8 columns content">
    <h3><?= h($cargarColectivo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cargarColectivo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Colectivo') ?></th>
            <td><?= $this->Number->format($cargarColectivo->id_colectivo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Inscripcion') ?></th>
            <td><?= $this->Number->format($cargarColectivo->id_inscripcion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Evento') ?></th>
            <td><?= $this->Number->format($cargarColectivo->id_evento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vaciar') ?></th>
            <td><?= h($cargarColectivo->vaciar) ?></td>
        </tr>
    </table>
</div>
