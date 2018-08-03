<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $inscripcione->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $inscripcione->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Inscripciones'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="inscripciones form large-9 medium-8 columns content">
    <?= $this->Form->create($inscripcione) ?>
    <fieldset>
        <legend><?= __('Edit Inscripcione') ?></legend>
        <?php
            echo $this->Form->input('fecha');
            echo $this->Form->input('id_persona');
            echo $this->Form->input('id_colectivo');
            echo $this->Form->input('pago');
            echo $this->Form->input('deuda');
            echo $this->Form->input('tipo');
            echo $this->Form->input('observacion');
            echo $this->Form->input('fecha_cierre');
            echo $this->Form->input('estado');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
