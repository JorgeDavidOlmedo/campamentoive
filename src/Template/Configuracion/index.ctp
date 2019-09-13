<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Configuracion'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="configuracion index large-9 medium-8 columns content">
    <h3><?= __('Configuracion') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('costo_voluntario') ?></th>
                <th scope="col"><?= $this->Paginator->sort('costo_colaborador') ?></th>
                <th scope="col"><?= $this->Paginator->sort('costo_participante') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cupo_participante') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cupo-voluntario') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($configuracion as $configuracion): ?>
            <tr>
                <td><?= $this->Number->format($configuracion->id) ?></td>
                <td><?= h($configuracion->fecha) ?></td>
                <td><?= h($configuracion->descripcion) ?></td>
                <td><?= $this->Number->format($configuracion->costo_voluntario) ?></td>
                <td><?= $this->Number->format($configuracion->costo_colaborador) ?></td>
                <td><?= $this->Number->format($configuracion->costo_participante) ?></td>
                <td><?= $this->Number->format($configuracion->cupo_participante) ?></td>
                <td><?= $this->Number->format($configuracion->cupo-voluntario) ?></td>
                <td><?= $this->Number->format($configuracion->estado) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $configuracion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $configuracion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $configuracion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $configuracion->id)]) ?>
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
