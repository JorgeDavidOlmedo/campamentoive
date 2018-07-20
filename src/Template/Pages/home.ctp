<?php echo $this->element('head');?>
<?= $this->Html->script('controladores/menu/controllerHome');?>

<div class="wrapper">
<?php 
    $host= $_SERVER["HTTP_HOST"];
    $url= $_SERVER["REQUEST_URI"];
    $url = explode("/",$url);
    $imagen = "";
    if(count($url)<=3){
        $imagen = "img/sidebar-5.jpg";
    } else{
        $imagen = "../img/sidebar-5.jpg";
    }

    ?>

<div class="sidebar" data-color="purple" data-image="<?php echo $imagen;?>">
    <?php echo $this->element('portrait');?>
   
   
    <div class="main-panel" >
     
    <?php echo $this->element('nav');?>

        <div class="content" ng-controller="homeIndex">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Inscripciones</h4>
                                
                                <?= $this->Html->link($this->Html->tag('p','Lista de Inscripciones',['class' => '']).'', 
                                ['controller' => 'Ventas', 'action' => 'index'],
                                ['escape' => false])?>  
                            </div>
                            <div class="content">
                            <div class="content all-icons">
                           
                           <div class="row">

                                 <div class="font-icon-list col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xs-3 ">
                                        <a><div class="font-icon-detail rojo">
                                                <div class="pedido">
                                                <h5> <strong>Varones Grandes: 50</strong></h5>
                                                <h5> <strong>Varones Menores: 50</strong></h5>
                                                <hr>
                                                <h5> <strong>Subtotal Varones: 100</strong></h5>
                                                <hr>
                                                <h5> <strong>Mujeres Grandes: 50</strong></h5>
                                                <h5> <strong>Mujeres Menores: 50</strong></h5>
                                                <hr>
                                                <h5> <strong>Subtotal Mujeres: 100</strong></h5>
                                                <hr>
                                                <h5> <strong>Total Por Equipo: 200</strong></h5>
                                                <hr>
                                                </div>
                                                
                                                
                                            </div></a>
                                      </div>

                                      <div class="font-icon-list col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xs-3 ">
                                      <a><div class="font-icon-detail azul">
                                              <div class="pedido">
                                              <h5> <strong>Varones Grandes: 50</strong></h5>
                                              <h5> <strong>Varones Menores: 50</strong></h5>
                                              <hr>
                                              <h5> <strong>Subtotal Varones: 100</strong></h5>
                                              <hr>
                                              <h5> <strong>Mujeres Grandes: 50</strong></h5>
                                              <h5> <strong>Mujeres Menores: 50</strong></h5>
                                              <hr>
                                              <h5> <strong>Subtotal Mujeres: 100</strong></h5>
                                              <hr>
                                              <h5> <strong>Total Por Equipo: 200</strong></h5>
                                              <hr>
                                              </div>
                                              
                                              
                                          </div></a>
                                      </div>

                                      <div class="font-icon-list col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xs-3 ">
                                      <a><div class="font-icon-detail verde">
                                              <div class="pedido">
                                              <h5> <strong>Varones Grandes: 50</strong></h5>
                                              <h5> <strong>Varones Menores: 50</strong></h5>
                                              <hr>
                                              <h5> <strong>Subtotal Varones: 100</strong></h5>
                                              <hr>
                                              <h5> <strong>Mujeres Grandes: 50</strong></h5>
                                              <h5> <strong>Mujeres Menores: 50</strong></h5>
                                              <hr>
                                              <h5> <strong>Subtotal Mujeres: 100</strong></h5>
                                              <hr>
                                              <h5> <strong>Total Por Equipo: 200</strong></h5>
                                              <hr>
                                              </div>
                                              
                                              
                                          </div></a>
                                      </div>

                                      <div class="font-icon-list col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xs-3 ">
                                      <a><div class="font-icon-detail naranja">
                                              <div class="pedido">
                                              <h5> <strong>Varones Grandes: 50</strong></h5>
                                              <h5> <strong>Varones Menores: 50</strong></h5>
                                              <hr>
                                              <h5> <strong>Subtotal Varones: 100</strong></h5>
                                              <hr>
                                              <h5> <strong>Mujeres Grandes: 50</strong></h5>
                                              <h5> <strong>Mujeres Menores: 50</strong></h5>
                                              <hr>
                                              <h5> <strong>Subtotal Mujeres: 100</strong></h5>
                                              <hr>
                                              <h5> <strong>Total Por Equipo: 200</strong></h5>
                                              <hr>
                                              </div>
                                              
                                              
                                          </div></a>
                                      </div>
                                 </div>

                                 
                                 
        </div>
                              
                               
                            </div>
                        </div>
                    </div>

                   
                </div>



                
            </div>
        </div>


        <?php echo $this->element('footer');?>

    </div>
</div>
</div>

</body>


<style>
.rojo{
    background-color: #ff000096;
}

.azul{

    background-color: #2e2ef5cf;
}

.verde{

background-color: #11b9119c;
}

.naranja{

background-color: #ffa500ad;
}

h5{
    color:white;
}
</style>

	<script type="text/javascript">
    	$(document).ready(function(){

            function loadVentas(){
    
               var urlBase= "<?= $this->Url->build(["controller" => "Ventas", "action"=>"ventasForTime"]) ?>";
               var idBuild2 = 0;

               $.ajax({
                   type: "POST",
                   url: urlBase,
                   data: { 'idBuild':idBuild2},
                   dataType: 'json',
                   beforeSend: function(){

                   },
                   success: function(data){

                       console.log(data);
                       var chart = new CanvasJS.Chart("ventasForTime",
                           {
                               title: {
                                   text: ""
                               },
                               axisX: {
                                   labelFormatter: function (e) {
                                       return CanvasJS.formatDate( e.value, "DD MMM");
                                   },
                               },
                               axisX: {
                                   labelAngle: -30,

                               },
                               data: [
                                   {
                                       type: "line",

                                       dataPoints: data
                                   }
                               ]
                           });

                       chart.render();

                       $('.canvasjs-chart-credit').remove();

                       $.each(data, function(i,items){


                       });
                   }
               });
           }
           loadVentas();

    	});
	</script>

</html>

