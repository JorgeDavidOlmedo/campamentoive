<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Inscripcione'), ['action' => 'edit', $inscripcione->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Inscripcione'), ['action' => 'delete', $inscripcione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inscripcione->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Inscripciones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inscripcione'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="inscripciones view large-9 medium-8 columns content">
    <h3><?= h($inscripcione->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Observacion') ?></th>
            <td><?= h($inscripcione->observacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($inscripcione->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Persona') ?></th>
            <td><?= $this->Number->format($inscripcione->id_persona) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Colectivo') ?></th>
            <td><?= $this->Number->format($inscripcione->id_colectivo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pago') ?></th>
            <td><?= $this->Number->format($inscripcione->pago) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deuda') ?></th>
            <td><?= $this->Number->format($inscripcione->deuda) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= $this->Number->format($inscripcione->estado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($inscripcione->fecha) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Cierre') ?></th>
            <td><?= h($inscripcione->fecha_cierre) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Tipo') ?></h4>
        <?= $this->Text->autoParagraph(h($inscripcione->tipo)); ?>
    </div>
</div>
