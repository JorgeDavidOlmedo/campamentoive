<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Detalle Perfil'), ['action' => 'edit', $detallePerfil->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Detalle Perfil'), ['action' => 'delete', $detallePerfil->id], ['confirm' => __('Are you sure you want to delete # {0}?', $detallePerfil->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Detalle Perfil'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Detalle Perfil'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="detallePerfil view large-9 medium-8 columns content">
    <h3><?= h($detallePerfil->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($detallePerfil->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Perfil') ?></th>
            <td><?= $this->Number->format($detallePerfil->id_perfil) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Model') ?></th>
            <td><?= $this->Number->format($detallePerfil->id_model) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Guardar') ?></th>
            <td><?= $this->Number->format($detallePerfil->guardar) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modificar') ?></th>
            <td><?= $this->Number->format($detallePerfil->modificar) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eliminar') ?></th>
            <td><?= $this->Number->format($detallePerfil->eliminar) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Consultar') ?></th>
            <td><?= $this->Number->format($detallePerfil->consultar) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= $this->Number->format($detallePerfil->estado) ?></td>
        </tr>
    </table>
</div>
