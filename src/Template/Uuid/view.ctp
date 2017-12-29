<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Uuid'), ['action' => 'edit', $uuid->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Uuid'), ['action' => 'delete', $uuid->id], ['confirm' => __('Are you sure you want to delete # {0}?', $uuid->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Uuid'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Uuid'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="uuid view large-9 medium-8 columns content">
    <h3><?= h($uuid->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= h($uuid->usuario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Token') ?></th>
            <td><?= h($uuid->token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($uuid->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($uuid->fecha) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Estado') ?></h4>
        <?= $this->Text->autoParagraph(h($uuid->estado)); ?>
    </div>
</div>
