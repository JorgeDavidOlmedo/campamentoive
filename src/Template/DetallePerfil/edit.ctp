<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $detallePerfil->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $detallePerfil->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Detalle Perfil'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="detallePerfil form large-9 medium-8 columns content">
    <?= $this->Form->create($detallePerfil) ?>
    <fieldset>
        <legend><?= __('Edit Detalle Perfil') ?></legend>
        <?php
            echo $this->Form->input('id_perfil');
            echo $this->Form->input('id_model');
            echo $this->Form->input('guardar');
            echo $this->Form->input('modificar');
            echo $this->Form->input('eliminar');
            echo $this->Form->input('consultar');
            echo $this->Form->input('estado');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
