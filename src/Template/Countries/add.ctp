<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="countries form large-9 medium-8 columns content">
    <?= $this->Form->create($country) ?>
    <fieldset>
        <legend><?= __('Add Country') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('iso_alpha2');
            echo $this->Form->input('iso_alpha3');
            echo $this->Form->input('iso_numeric');
            echo $this->Form->input('currency_code');
            echo $this->Form->input('currency_name');
            echo $this->Form->input('currrency_symbol');
            echo $this->Form->input('flag');
            echo $this->Form->input('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
