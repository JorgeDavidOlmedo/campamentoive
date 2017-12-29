<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Uuid'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="uuid index large-9 medium-8 columns content">
    <h3><?= __('Uuid') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha') ?></th>
                <th scope="col"><?= $this->Paginator->sort('usuario') ?></th>
                <th scope="col"><?= $this->Paginator->sort('token') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($uuid as $uuid): ?>
            <tr>
                <td><?= $this->Number->format($uuid->id) ?></td>
                <td><?= h($uuid->fecha) ?></td>
                <td><?= h($uuid->usuario) ?></td>
                <td><?= h($uuid->token) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $uuid->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $uuid->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $uuid->id], ['confirm' => __('Are you sure you want to delete # {0}?', $uuid->id)]) ?>
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
