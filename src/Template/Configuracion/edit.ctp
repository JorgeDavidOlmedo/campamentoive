<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $configuracion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $configuracion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Configuracion'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="configuracion form large-9 medium-8 columns content">
    <?= $this->Form->create($configuracion) ?>
    <fieldset>
        <legend><?= __('Edit Configuracion') ?></legend>
        <?php
            echo $this->Form->input('fecha');
            echo $this->Form->input('descripcion');
            echo $this->Form->input('costo_voluntario');
            echo $this->Form->input('costo_colaborador');
            echo $this->Form->input('costo_participante');
            echo $this->Form->input('cupo_participante');
            echo $this->Form->input('cupo-voluntario');
            echo $this->Form->input('estado');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
