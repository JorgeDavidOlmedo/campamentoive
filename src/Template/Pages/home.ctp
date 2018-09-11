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

                            </div>
                            <div class="content">
                            <div class="content all-icons">

                            <div class="row" id="inscrip">
                                <div class="row">
                                    <div class="col-6 col-sm-4">
                                        <label><p>Cantidad de Inscriptos (Pendientes y Confirmados)</p></label>
                                        <label><strong>Cantidad de Participantes</strong></label>
                                        <br>
                                        <ul>
                                            <li>Cantidad de Mujeres: {{p_y_c_participante_femenino}}</li>
                                            <li>Cantidad de Varones: {{p_y_c_participante_masculino}}</li>
                                        </ul>
                                        <br>
                                        <label><strong>Cantidad de Voluntarios</strong></label>
                                        <br>
                                        <ul>
                                            <li>Cantidad de Mujeres : {{p_y_c_voluntario_femenino}}</li>
                                            <li>Cantidad de Varones: {{p_y_c_voluntario_masculino}}</li>
                                        </ul>
                                    </div>
                                    <div class="col-6 col-sm-4">

                                        <label><p>Cantidad de Inscriptos (Confirmados)</p></label>
                                        <br><br>
                                        <label><strong>Cantidad de Participantes</strong></label>
                                        <br>
                                        <ul>
                                            <li>Cantidad de Mujeres: {{c_participante_femenino}}</li>
                                            <li>Cantidad de Varones: {{c_participante_masculino}}</li>
                                        </ul>
                                        <br>
                                        <label><strong>Cantidad de Voluntarios</strong></label>
                                        <br>
                                        <ul>
                                            <li>Cantidad de Mujeres: {{c_voluntario_femenino}}</li>
                                            <li>Cantidad de Varones: {{c_voluntario_masculino}}</li>
                                        </ul>

                                    </div>

                                    <!-- Force next columns to break to new line -->
                                    <div class="w-100"></div>

                                    <div class="col-6 col-sm-4">

                                        <label><p>Datos de Acompañantes (Participantes y Voluntarios)</p></label>
                                        <br>
                                        <label><strong>Cantidad de Inscriptos (Pendientes y Confirmados)</strong></label>
                                        <br>
                                        <ul>
                                            <li>Cantidad de Mujeres: {{a_c_y_p_femenino}}</li>
                                            <li>Cantidad de Varones: {{a_c_y_p_masculino}}</li>
                                        </ul>
                                        <br>
                                        <label><strong>Cantidad de Inscriptos (Confirmados)</strong></label>
                                        <br>
                                        <ul>
                                            <li>Cantidad de Mujeres: {{a_c_femenino}}</li>
                                            <li>Cantidad de Varones: {{a_c_masculino}}</li>
                                        </ul>

                                    </div>
                                    <div class="col-6 col-sm-4"></div>
                                </div>
                             </div>


                           <div class="row" id="colour">

                                 <div class="font-icon-list col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xs-3 ">
                                        <a><div class="font-icon-detail rojo">
                                                <div class="pedido">
                                                <h5> <strong>Varones Grandes: {{rojo_mayor}}</strong></h5>
                                                <h5> <strong>Varones Menores: {{rojo_menor}}</strong></h5>
                                                <hr>
                                                <h5> <strong>Subtotal Varones: {{rojo_mayor + rojo_menor}}</strong></h5>
                                                <hr>
                                                <h5> <strong>Mujeres Grandes: {{ rojo_mayor_fem }}</strong></h5>
                                                <h5> <strong>Mujeres Menores: {{ rojo_menor_fem}}</strong></h5>
                                                <hr>
                                                <h5> <strong>Subtotal Mujeres: {{rojo_mayor_fem + rojo_menor_fem}}</strong></h5>
                                                <hr>
                                                <h5> <strong>Total Por Equipo: {{rojo_mayor + rojo_menor + rojo_mayor_fem + rojo_menor_fem}}</strong></h5>
                                                <hr>
                                                </div>
                                                
                                                
                                            </div></a>
                                      </div>

                                      <div class="font-icon-list col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xs-3 ">
                                      <a><div class="font-icon-detail azul">
                                              <div class="pedido">
                                                  <h5> <strong>Varones Grandes: {{azul_mayor}}</strong></h5>
                                                  <h5> <strong>Varones Menores: {{azul_menor}}</strong></h5>
                                                  <hr>
                                                  <h5> <strong>Subtotal Varones: {{azul_mayor + azul_menor}}</strong></h5>
                                                  <hr>
                                                  <h5> <strong>Mujeres Grandes: {{ azul_mayor_fem }}</strong></h5>
                                                  <h5> <strong>Mujeres Menores: {{azul_menor_fem}}</strong></h5>
                                                  <hr>
                                                  <h5> <strong>Subtotal Mujeres: {{azul_mayor_fem + azul_menor_fem}}</strong></h5>
                                                  <hr>
                                                  <h5> <strong>Total Por Equipo: {{azul_mayor + azul_menor + azul_mayor_fem + azul_menor_fem}}</strong></h5>

                                                  <hr>
                                              </div>
                                              
                                              
                                          </div></a>
                                      </div>

                                      <div class="font-icon-list col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xs-3 ">
                                   <a><div class="font-icon-detail verde">
                                           <div class="pedido">
                                               <h5> <strong>Varones Grandes: {{verde_mayor}}</strong></h5>
                                               <h5> <strong>Varones Menores: {{verde_menor}}</strong></h5>
                                               <hr>
                                               <h5> <strong>Subtotal Varones: {{verde_mayor + verde_menor}}</strong></h5>
                                               <hr>
                                               <h5> <strong>Mujeres Grandes: {{ verde_mayor_fem }}</strong></h5>
                                               <h5> <strong>Mujeres Menores: {{ verde_menor_fem}}</strong></h5>
                                               <hr>
                                               <h5> <strong>Subtotal Mujeres: {{verde_mayor_fem + verde_menor_fem}}</strong></h5>
                                               <hr>
                                               <h5> <strong>Total Por Equipo: {{verde_mayor + verde_menor + verde_mayor_fem + verde_menor_fem}}</strong></h5>

                                               <hr>
                                           </div>


                                       </div></a>
                               </div>

                                      <div class="font-icon-list col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xs-3 ">
                                      <a><div class="font-icon-detail naranja">
                                              <div class="pedido">
                                                  <h5> <strong>Varones Grandes: {{amarillo_mayor}}</strong></h5>
                                                  <h5> <strong>Varones Menores: {{amarillo_menor}}</strong></h5>
                                                  <hr>
                                                  <h5> <strong>Subtotal Varones: {{amarillo_mayor + amarillo_menor}}</strong></h5>
                                                  <hr>
                                                  <h5> <strong>Mujeres Grandes: {{ amarillo_mayor_fem }}</strong></h5>
                                                  <h5> <strong>Mujeres Menores: {{ amarillo_menor_fem}}</strong></h5>
                                                  <hr>
                                                  <h5> <strong>Subtotal Mujeres: {{amarillo_mayor_fem + amarillo_menor_fem}}</strong></h5>
                                                  <hr>
                                                  <h5> <strong>Total Por Equipo: {{amarillo_mayor + amarillo_menor + amarillo_mayor_fem + amarillo_menor_fem}}</strong></h5>

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

        background-color: rgba(234, 255, 15, 0.68);
    }

    .naranja{

        background-color: #f76d1e

    }

h5{
    color:#080505;
}
</style>


</html>

