<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cargarColectivo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cargarColectivo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cargar Colectivos'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="cargarColectivos form large-9 medium-8 columns content">
    <?= $this->Form->create($cargarColectivo) ?>
    <fieldset>
        <legend><?= __('Edit Cargar Colectivo') ?></legend>
        <?php
            echo $this->Form->input('id_colectivo');
            echo $this->Form->input('id_inscripcion');
            echo $this->Form->input('id_evento');
            echo $this->Form->input('vaciar', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
