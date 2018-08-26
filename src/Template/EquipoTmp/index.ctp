<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Equipo Tmp'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="equipoTmp index large-9 medium-8 columns content">
    <h3><?= __('Equipo Tmp') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contador') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sexo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('edad') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('obs') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_evento') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipoTmp as $equipoTmp): ?>
            <tr>
                <td><?= $this->Number->format($equipoTmp->id) ?></td>
                <td><?= $this->Number->format($equipoTmp->contador) ?></td>
                <td><?= h($equipoTmp->color) ?></td>
                <td><?= h($equipoTmp->sexo) ?></td>
                <td><?= $this->Number->format($equipoTmp->edad) ?></td>
                <td><?= h($equipoTmp->nombre) ?></td>
                <td><?= h($equipoTmp->obs) ?></td>
                <td><?= $this->Number->format($equipoTmp->id_evento) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $equipoTmp->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $equipoTmp->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $equipoTmp->id], ['confirm' => __('Are you sure you want to delete # {0}?', $equipoTmp->id)]) ?>
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
