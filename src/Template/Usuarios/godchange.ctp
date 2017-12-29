<?= $this->Html->css(['login']) ?>
<div class="row" style="margin-top:150px">
    <div class="col-xs-12 col-sm-8 col-md-3 col-sm-offset-2 col-md-offset-4 login">
       <?= $this->Form->create() ?>

                <div class="img">

                 </div>
                <div class="myclass">
                <h2>El password se modifico correctamente!!!</h2>
                </div>
                <br>
                <div class="row">

                    <div class="form-group link">
                        <?php echo $this->Html->link('Inicio', ['controller' => 'usuarios', 'action' => 'login'], ['class' => "btn bad"]); ?>
                    </div>

                </div>

            <?= $this->Form->end() ?>
    </div>
</div>
<style>
    .myclass{
        margin-left: 20px;
        color: black;
        font-weight: bold;
    }
    
    .btn{
        cursor: pointer;
        height: auto;
    }

    .btn-rojo:hover, .btn-default.active, .btn-default:active, .btn-default.focus, .btn-default:focus {
        background-color: #f5f5f5;
        color: #333;
        outline: none !important;
    }

    .bad{
        margin-left: 110px;
        font-size: 22px;
        text-decoration: underline;

    }

    h2{
        font-weight: bold;
        font-size: 22px;
        margin-left: 25px;
    }

</style>