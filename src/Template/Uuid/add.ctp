<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Uuid'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="uuid form large-9 medium-8 columns content">
    <?= $this->Form->create($uuid) ?>
    <fieldset>
        <legend><?= __('Add Uuid') ?></legend>
        <?php
            echo $this->Form->input('fecha');
            echo $this->Form->input('usuario');
            echo $this->Form->input('token');
            echo $this->Form->input('estado');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
