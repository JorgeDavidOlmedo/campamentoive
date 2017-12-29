<?= $this->Html->css(['login']) ?>
<div class="row" style="margin-top:150px">
    <div class="col-xs-12 col-sm-8 col-md-3 col-sm-offset-2 col-md-offset-4 login">
       <?= $this->Form->create() ?>
            <fieldset>
                <div class="img">

                 </div>
                <div class="myclass">
                <h2>Recuperar Password</h2>
                </div>
                <br>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <?= $this->Form->input('email',['class'=>"form-control input-lg", 'placeholder'=>"Email",'label'=>false,'required']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <?= $this->Form->button('Enviar',['class'=>'btn btn-md btn-lg btn-rojo']);?>
                     </div>
                     </div>
                </div>
            </fieldset>
            <?= $this->Form->end() ?>
    </div>
</div>
<style>
    .myclass{
        margin-left: 20px;
        color: black;
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

    h2{
        font-weight: bold;
        font-size: 22px;
        margin-left: 25px;
    }
</style>