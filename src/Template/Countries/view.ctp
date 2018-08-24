<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Country'), ['action' => 'edit', $country->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Country'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # {0}?', $country->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="countries view large-9 medium-8 columns content">
    <h3><?= h($country->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($country->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Iso Alpha2') ?></th>
            <td><?= h($country->iso_alpha2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Iso Alpha3') ?></th>
            <td><?= h($country->iso_alpha3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency Code') ?></th>
            <td><?= h($country->currency_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency Name') ?></th>
            <td><?= h($country->currency_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currrency Symbol') ?></th>
            <td><?= h($country->currrency_symbol) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Flag') ?></th>
            <td><?= h($country->flag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($country->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Iso Numeric') ?></th>
            <td><?= $this->Number->format($country->iso_numeric) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($country->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($country->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $country->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
