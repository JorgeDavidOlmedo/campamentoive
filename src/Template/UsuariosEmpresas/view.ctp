<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Usuarios Empresa'), ['action' => 'edit', $usuariosEmpresa->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Usuarios Empresa'), ['action' => 'delete', $usuariosEmpresa->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuariosEmpresa->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios Empresas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuarios Empresa'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usuariosEmpresas view large-9 medium-8 columns content">
    <h3><?= h($usuariosEmpresa->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usuariosEmpresa->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Usuario') ?></th>
            <td><?= $this->Number->format($usuariosEmpresa->id_usuario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Empresa') ?></th>
            <td><?= $this->Number->format($usuariosEmpresa->id_empresa) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Estado') ?></h4>
        <?= $this->Text->autoParagraph(h($usuariosEmpresa->estado)); ?>
    </div>
</div>
