<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Detalle Perfil'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="detallePerfil index large-9 medium-8 columns content">
    <h3><?= __('Detalle Perfil') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_perfil') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_model') ?></th>
                <th scope="col"><?= $this->Paginator->sort('guardar') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modificar') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eliminar') ?></th>
                <th scope="col"><?= $this->Paginator->sort('consultar') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detallePerfil as $detallePerfil): ?>
            <tr>
                <td><?= $this->Number->format($detallePerfil->id) ?></td>
                <td><?= $this->Number->format($detallePerfil->id_perfil) ?></td>
                <td><?= $this->Number->format($detallePerfil->id_model) ?></td>
                <td><?= $this->Number->format($detallePerfil->guardar) ?></td>
                <td><?= $this->Number->format($detallePerfil->modificar) ?></td>
                <td><?= $this->Number->format($detallePerfil->eliminar) ?></td>
                <td><?= $this->Number->format($detallePerfil->consultar) ?></td>
                <td><?= $this->Number->format($detallePerfil->estado) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $detallePerfil->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $detallePerfil->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $detallePerfil->id], ['confirm' => __('Are you sure you want to delete # {0}?', $detallePerfil->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
