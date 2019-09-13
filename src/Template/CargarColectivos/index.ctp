<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cargar Colectivo'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cargarColectivos index large-9 medium-8 columns content">
    <h3><?= __('Cargar Colectivos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_colectivo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_inscripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_evento') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vaciar') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cargarColectivos as $cargarColectivo): ?>
            <tr>
                <td><?= $this->Number->format($cargarColectivo->id) ?></td>
                <td><?= $this->Number->format($cargarColectivo->id_colectivo) ?></td>
                <td><?= $this->Number->format($cargarColectivo->id_inscripcion) ?></td>
                <td><?= $this->Number->format($cargarColectivo->id_evento) ?></td>
                <td><?= h($cargarColectivo->vaciar) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cargarColectivo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cargarColectivo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cargarColectivo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cargarColectivo->id)]) ?>
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
