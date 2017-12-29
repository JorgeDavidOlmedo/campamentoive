<?php
    $productos = $_POST['productos'];
      echo '<div class="wrapper wrapper-content animated fadeInRight">';
      echo '<div class="row">';
        foreach ($productos as $value){
            echo '<div class="col-md-3">';
            echo '<div class="ibox">';
            echo '<div class="ibox-content product-box">';
            echo '<div class="product-imitation mylink">';
            $foto_descripcion = "../uploads/".$value["foto"];
            echo '<div onclick=foto("'.$value["descripcion"].'","'.$value["id"].'")><IMG SRC="'.$foto_descripcion.'" WIDTH=200></div>';
            echo '</div>';
            echo '<div class="product-desc">';
            echo '<span class="product-price">';
            echo 'PYG '.$value["precio"];
            echo '</span>';
            echo '<small class="text-muted">'.ucwords($value["grupo"]).'</small>';
            echo '<a href="#" class="product-name">'.ucwords($value["descripcion"]).'</a>';


            echo '<div class="small m-t-xs">';
            echo $value["informacion"];
            echo '</div>';

                      echo '<div class="m-t text-righ">';
            echo '<a class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
           
        }

   echo '</div>';
 echo '</div>';


    echo '<div class="modal fade mymodal" id="product-detail" tabindex="-1" role="dialog" aria-labelledby="product-detail" aria-hidden="true">';
    echo '<div class="modal-dialog">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo '<strong><h4><div id="one">FOTOS</div></h4></strong>';
    echo '</div>';
    echo '<div class="modal-body">';
    echo '<div id="msg">';
     echo '</div>';
    echo '</div>';
    echo '<div class="modal-footer">';
    echo '<form action="../../funciones/borrar-album.php" method="POST">';
    echo '<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>';
    echo '<input type="hidden" name="myValue" id="myValue" value=""/>';
    //echo '<button class="btn btn-primary" data-title="Delete">Si</button>';
    echo '<form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';


?>

<style>

    .mylink {
        cursor:pointer;
    }

</style>

<script type="text/javascript">

    function foto(descripcion,id){
         $('#one').text(descripcion);
         var urlBase= "../productos/buscarFotoProducto";
         $.ajax({
            type: "POST",
            url: urlBase,
            data: { 'idproducto':id},
            dataType: 'json',
            beforeSend: function(){
                      
                    },
            success: function(data){
                    $("#product-detail").modal();
                    $( "#msg" ).load("../ajax/fotos.php",{fotos:data.resultado});
                   
            }  
          });

    }

</script>



