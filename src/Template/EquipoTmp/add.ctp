<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Equipo Tmp'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="equipoTmp form large-9 medium-8 columns content">
    <?= $this->Form->create($equipoTmp) ?>
    <fieldset>
        <legend><?= __('Add Equipo Tmp') ?></legend>
        <?php
            echo $this->Form->input('contador');
            echo $this->Form->input('color');
            echo $this->Form->input('sexo');
            echo $this->Form->input('edad');
            echo $this->Form->input('nombre');
            echo $this->Form->input('obs');
            echo $this->Form->input('id_evento');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
