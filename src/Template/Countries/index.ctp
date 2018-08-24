<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Country'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="countries index large-9 medium-8 columns content">
    <h3><?= __('Countries') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('iso_alpha2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('iso_alpha3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('iso_numeric') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currrency_symbol') ?></th>
                <th scope="col"><?= $this->Paginator->sort('flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($countries as $country): ?>
            <tr>
                <td><?= $this->Number->format($country->id) ?></td>
                <td><?= h($country->name) ?></td>
                <td><?= h($country->iso_alpha2) ?></td>
                <td><?= h($country->iso_alpha3) ?></td>
                <td><?= $this->Number->format($country->iso_numeric) ?></td>
                <td><?= h($country->currency_code) ?></td>
                <td><?= h($country->currency_name) ?></td>
                <td><?= h($country->currrency_symbol) ?></td>
                <td><?= h($country->flag) ?></td>
                <td><?= h($country->active) ?></td>
                <td><?= h($country->created) ?></td>
                <td><?= h($country->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $country->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $country->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # {0}?', $country->id)]) ?>
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
