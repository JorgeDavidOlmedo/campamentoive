<?php 
echo '<div class="panel panel-default">';
    echo '<div class="panel-body">';
  
    $ivaForeach=0;
    $imponibleForeach=0;
    $subForeach=0;
    $flag = 0;
    $sumCinco = 0;
    $sumDiez = 0;
       foreach ($invoiceTemplate as $key => $value):
                //Numero de Factura Venta 
                if($value->name=='Numero de Factura' && $value->model=='Sale'):

                    echo '<div class="element" style="top:'.$value->p_top.'px; left:'.$value->p_left.'px;">';
                        echo $sale->documento;
                    echo '</div>';

                 endif;

                  if($value->name=='Fecha de Emision' && $value->model=='Sale'):

                    echo '<div class="element" style="top:'.$value->p_top.'px; left:'.$value->p_left.'px;">';
                        echo date('d/m/Y',strtotime($sale->fecha));
                    echo '</div>';

                  endif;

                  if($value->name=='Monto en texto' && $value->model=='Sale'):

                    echo '<div class="element" style="top:'.$value->p_top.'px; left:'.$value->p_left.'px;">';
                        echo numtoletras($sale->total);
                    echo '</div>';

                  endif;

                 if($value->name=='Monto' && $value->model=='Sale'):

                    echo '<div class="element" style="top:'.$value->p_top.'px; left:'.$value->p_left.'px;">';
                        echo number_format($sale->total);
                    echo '</div>';

                 endif;

                 if($value->name=='Nombre' && $value->model=='Contact'):

                    echo '<div class="element" style="top:'.$value->p_top.'px; left:'.$value->p_left.'px;">';
                         echo $sale->cliente->descripcion;
                    echo '</div>';

                 endif;

                if($value->name=='Identificador' && $value->model=='Contact'):

                    echo '<div class="element" style="top:'.$value->p_top.'px; left:'.$value->p_left.'px;">';

                        if(empty($sale->cliente->dv)){

                            echo $sale->cliente->documento;

                        }else{

                            echo $sale->cliente->documento." - ".$sale->cliente->dv;

                        }

                    echo '</div>';

                   endif;


                  if($value->name=='Telefono' && $value->model=='Contact'):

                    echo '<div class="element" style="top:'.$value->p_top.'px; left:'.$value->p_left.'px;">';
                         echo $sale->user->telefono;
                    echo '</div>';

                  endif;

                  if($value->name=='Direccion' && $value->model=='Contact'):

                    echo '<div class="element" style="top:'.$value->p_top.'px; left:'.$value->p_left.'px;">';
                        echo $sale->cliente->direccion;
                    echo '</div>';

                 endif;

                 if($value->name=='Email' && $value->model=='Contact'):

                    echo '<div class="element" style="top:'.$value->p_top.'px; left:'.$value->p_left.'px;">';
                        echo $sale->cliente->email;
                    echo '</div>';

                endif;

                if($value->name=='Nombre' && $value->model=='Currency'):

                    echo '<div class="element" style="top:'.$value->p_top.'px; left:'.$value->p_left.'px;">';
                        echo $sale->moneda->descripcion;
                    echo '</div>';

                 endif;

                 if($value->name=='Identificador' && $value->model=='Currency'):

                    echo '<div class="element" style="top:'.$value->p_top.'px; left:'.$value->p_left.'px;">';
                        echo $sale->moneda->identificador;
                    echo '</div>';

                 endif;

                
                           $top=$value->p_top;
                       
                            foreach ($salesDetails as $key_pe => $pe){

                             if($value->name=='Nombre del Producto' && $value->model=='SalesExpense'):   
                                
                                echo '<div class="element" style="top:'.$top.'px; left:'.$value->p_left.'px;">';
                                      echo $pe->producto->descripcion;
                                echo '</div>';
 
                             endif;    

                             if($value->name=='Cantidad' && $value->model=='SalesExpense'):

                                echo '<div class="element" style="top:'.$top.'px; left:'.$value->p_left.'px;">';
                                     echo $pe->cantidad;
                                echo '</div>';

                             endif;   

                             if($value->name=='Precio' && $value->model=='SalesExpense'):

                                  echo '<div class="element" style="top:'.$top.'px; left:'.$value->p_left.'px;">';
                                        echo number_format($pe->precio);
                                  echo '</div>';

                             endif;


                             if($value->name=='Imponible Exenta' && $value->model=='Tax'):
                                 // echo $value->p_top.' - '.$value->p_left.'<br>';
                                   if($pe->producto->iva==0){
                                        echo '<div class="element" style="top:'.$top.'px; left:'.$value->p_left.'px;">';
                                        echo number_format($pe->precio*$pe->cantidad);

                                        echo '</div>';
                                    }
                                  

                             endif;

                             if($value->name=='Imponible Iva 5%' && $value->model=='Tax'):
                                   if($pe->producto->iva==5){
                                        echo '<div class="element" style="top:'.$top.'px; left:'.$value->p_left.'px;">';
                                           echo number_format($pe->precio*$pe->cantidad);
                                           $sumCinco = $sumCinco + ($pe->precio*$pe->cantidad);
                                        echo '</div>';
                                   }                                  
                                  

                             endif;

                             if($value->name=='Imponible Iva 10%' && $value->model=='Tax'):
                                   if($pe->producto->iva==10){
                                        echo '<div class="element" style="top:'.$top.'px; left:'.$value->p_left.'px;">';
                                           echo number_format($pe->precio*$pe->cantidad);
                                           $sumDiez = $sumDiez + ($pe->precio*$pe->cantidad);
                                        echo '</div>';
                                   }                                  
                                  

                             endif;

                             

                             $top=$top+16;      
                                //echo $pe->producto->descripcion.'<br>';
                                
                            }
                            
                            
                            if($value->name=='Monto Iva 5%' && $value->model=='Tax'):
                               
                                     echo '<div class="element" style="top:'.$top.'px; left:'.$value->p_left.'px;">';
                                        echo number_format($sumCinco/21);
                                    echo '</div>';
                              
                           endif;

                           if($value->name=='Monto Iva 10%' && $value->model=='Tax'):
                            
                                  echo '<div class="element" style="top:'.$top.'px; left:'.$value->p_left.'px;">';
                                     echo number_format($sumDiez/11);
                                 echo '</div>';
                           
                           endif;
                         
              
?>


                <?php /******************** DETALLE VENTAS*********************/?>
                <?php

                $j=0;
                $idExpense=0;
                $agregar=0;

                ?>


                
               
               <?php //////////////Monto de la Expensa Venta?>
               <?php $topGlobal = 0;?>

               

            <?php endforeach;?>

                            
        <!-- ITEMS -->



    </div>
</div>

<style type="text/css">
    .element{
        position: absolute;
    }

    body{
        font-size: 11;
        font-family: sans-serif;
    }

</style>



<?php

    //------    CONVERTIR NUMEROS A LETRAS         ---------------
    //------    Máxima cifra soportada: 18 dígitos con 2 decimales
    //------    999,999,999,999,999,999.99
    // NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE BILLONES
    // NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE MILLONES
    // NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE PESOS 99/100 M.N.
    //------    Creada por:                        ---------------
    //------             ULTIMINIO RAMOS GALÁN     ---------------
    //------            uramos@gmail.com           ---------------
    //------    10 de junio de 2009. México, D.F.  ---------------
    //------    PHP Version 4.3.1 o mayores (aunque podría funcionar en versiones anteriores, tendrías que probar)
    function numtoletras($xcifra)
    {
        $xarray = array(0 => "Cero",
            1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
            "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
            "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
            100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
        );
//
        $xcifra = trim($xcifra);
        $xlength = strlen($xcifra);
        $xpos_punto = strpos($xcifra, ".");
        $xaux_int = $xcifra;
        $xdecimales = "00";
        if (!($xpos_punto === false)) {
            if ($xpos_punto == 0) {
                $xcifra = "0" . $xcifra;
                $xpos_punto = strpos($xcifra, ".");
            }
            $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
            $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
        }

        $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
        $xcadena = "";
        for ($xz = 0; $xz < 3; $xz++) {
            $xaux = substr($XAUX, $xz * 6, 6);
            $xi = 0;
            $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
            $xexit = true; // bandera para controlar el ciclo del While
            while ($xexit) {
                if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                    break; // termina el ciclo
                }

                $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
                $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
                for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                    switch ($xy) {
                        case 1: // checa las centenas
                            if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas

                            } else {
                                $key = (int) substr($xaux, 0, 3);
                                if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                    $xseek = $xarray[$key];
                                    $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                    if (substr($xaux, 0, 3) == 100)
                                        $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                    else
                                        $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                    $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                                }
                                else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                    $key = (int) substr($xaux, 0, 1) * 100;
                                    $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                } // ENDIF ($xseek)
                            } // ENDIF (substr($xaux, 0, 3) < 100)
                            break;
                        case 2: // checa las decenas (con la misma lógica que las centenas)
                            if (substr($xaux, 1, 2) < 10) {

                            } else {
                                $key = (int) substr($xaux, 1, 2);
                                if (TRUE === array_key_exists($key, $xarray)) {
                                    $xseek = $xarray[$key];
                                    $xsub = subfijo($xaux);
                                    if (substr($xaux, 1, 2) == 20)
                                        $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                    else
                                        $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                    $xy = 3;
                                }
                                else {
                                    $key = (int) substr($xaux, 1, 1) * 10;
                                    $xseek = $xarray[$key];
                                    if (20 == substr($xaux, 1, 1) * 10)
                                        $xcadena = " " . $xcadena . " " . $xseek;
                                    else
                                        $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                                } // ENDIF ($xseek)
                            } // ENDIF (substr($xaux, 1, 2) < 10)
                            break;
                        case 3: // checa las unidades
                            if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada

                            } else {
                                $key = (int) substr($xaux, 2, 1);
                                $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                                $xsub = subfijo($xaux);
                                $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                            } // ENDIF (substr($xaux, 2, 1) < 1)
                            break;
                    } // END SWITCH
                } // END FOR
                $xi = $xi + 3;
            } // ENDDO

            if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
                $xcadena.= " DE";

            if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
                $xcadena.= " DE";

            // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
            if (trim($xaux) != "") {
                switch ($xz) {
                    case 0:
                        if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                            $xcadena.= "UN BILLON ";
                        else
                            $xcadena.= " BILLONES ";
                        break;
                    case 1:
                        if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                            $xcadena.= "UN MILLON ";
                        else
                            $xcadena.= " MILLONES ";
                        break;
                    case 2:
                        if ($xcifra < 1) {
                            $xcadena = "CERO ";
                        }
                        if ($xcifra >= 1 && $xcifra < 2) {
                            $xcadena = "UN ";
                        }
                        if ($xcifra >= 2) {
                            $xcadena.= "  "; //
                        }
                        break;
                } // endswitch ($xz)
            } // ENDIF (trim($xaux) != "")
            // ------------------      en este caso, para México se usa esta leyenda     ----------------
            $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
            $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
            $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
            $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
            $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
            $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
            $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
        } // ENDFOR ($xz)
        return trim($xcadena);
    }

    // END FUNCTION

    function subfijo($xx)
    { // esta función regresa un subfijo para la cifra
        $xx = trim($xx);
        $xstrlen = strlen($xx);
        if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
            $xsub = "";
        //
        if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
            $xsub = "MIL";
        //
        return $xsub;
    }

    // END FUNCTION
?>