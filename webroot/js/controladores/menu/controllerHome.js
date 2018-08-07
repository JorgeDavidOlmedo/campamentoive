/**
 * Created by jorge on 09/11/17.
 */

var app = angular.module('contalapp');

app.controller('homeIndex',function ($scope,kConstant,$http,$window,$filter) {
  
    $scope.show = function(data){
        console.log(data);
    }

    $scope.amarillo_menor = 0;
    $scope.amarillo_menor_fem = 0;
    $scope.amarillo_mayor = 0;
    $scope.amarillo_masculino_total = 0;
    $scope.rojo_masculino_total = 0;
    $scope.verde_masculino_total = 0;
    $scope.azul_masculino_total = 0;

    $scope.amarillo_fem_total = 0;
    $scope.rojo_fem_total = 0;
    $scope.verde_fem_total = 0;
    $scope.azul_fem_total = 0;

    $scope.amarillo_mayor_fem = 0;
    $scope.rojo_menor = 0;
    $scope.rojo_menor_fem = 0;
    $scope.rojo_mayor = 0;
    $scope.rojo_mayor_fem = 0;
    $scope.verde_menor = 0;
    $scope.verde_menor_fem = 0;
    $scope.verde_mayor = 0;
    $scope.verde_mayor_fem = 0;
    $scope.azul_menor = 0;
    $scope.azul_menor_fem = 0;
    $scope.azul_mayor = 0;
    $scope.azul_mayor_fem = 0;
    $scope.verInscripciones = function(){
        $http.get(kConstant.url + "inscripciones/getInscriptos/").then(function (response) {

           $scope.amarillo_mayor = response.data.resultado[0].amarillo.masculino.mayor;
           $scope.amarillo_menor = response.data.resultado[0].amarillo.masculino.menor;
           $scope.amarillo_menor_fem = response.data.resultado[0].amarillo.femenino.menor;
           $scope.amarillo_mayor_fem = response.data.resultado[0].amarillo.femenino.mayor;

           $scope.azul_mayor = response.data.resultado[0].azul.masculino.mayor;
           $scope.azul_menor = response.data.resultado[0].azul.masculino.menor;
           $scope.azul_menor_fem = response.data.resultado[0].azul.femenino.menor;
           $scope.azul_mayor_fem = response.data.resultado[0].azul.femenino.mayor;

           $scope.verde_mayor = response.data.resultado[0].verde.masculino.mayor;
           $scope.verde_menor = response.data.resultado[0].verde.masculino.menor;
           $scope.verde_menor_fem = response.data.resultado[0].verde.femenino.menor;
           $scope.verde_mayor_fem = response.data.resultado[0].verde.femenino.mayor;

            $scope.rojo_mayor = response.data.resultado[0].rojo.masculino.mayor;
            $scope.rojo_menor = response.data.resultado[0].rojo.masculino.menor;
            $scope.rojo_menor_fem = response.data.resultado[0].rojo.femenino.menor;
            $scope.rojo_mayor_fem = response.data.resultado[0].rojo.femenino.mayor;

        }, function (response) {

        });
    }

    $scope.verInscripciones();

    $scope.formatDate = function(date) {

        var d = new Date(date || Date.now()),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [day,month,year].join('/');
    }

    $scope.formatDateYMD = function(date) {

        var d = new Date(date || Date.now()),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year,month,day].join('-');
    }


    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);

    $scope.inicializarFecha = function(fecha_ini,fecha_fin){
       
        var i;
        var f;
        var verificar_fecha_ini = fecha_ini;
        verificar_fecha_ini = verificar_fecha_ini.split("-");

        var verificar_fecha_fin = fecha_fin;
        verificar_fecha_fin = verificar_fecha_fin.split("-");

        var estado_ini = isNaN(verificar_fecha_ini[0]);
        var estado_fin = isNaN(verificar_fecha_fin[0]);    
       
        if(estado_ini==true || fecha_ini=="" || fecha_ini==null){

            primerDia = primerDia.split("-");
            primerDia = primerDia[2]+'/'+primerDia[1]+'/'+primerDia[0];
            i = primerDia;

           }else{
            
            fecha_ini = fecha_ini.split("-");
           // alert(fecha_ini[1]);
            fecha_ini = fecha_ini[2]+'/'+fecha_ini[1]+'/'+fecha_ini[0];
            i = fecha_ini;
        }

        if(estado_fin==true ||fecha_fin=="" || fecha_fin==null){
            ultimoDia = ultimoDia.split("-");
            ultimoDia = ultimoDia[2]+'/'+ultimoDia[1]+'/'+ultimoDia[0];
            f = ultimoDia;
        }else{

           fecha_fin = fecha_fin.split("-");
           fecha_fin = fecha_fin[2]+'/'+fecha_fin[1]+'/'+fecha_fin[0];
           f = fecha_fin;
        }

        $('#mydate').val(i);
        $('#mydate2').val(f);
      

    }


    $('#mydate').on('change dp.change', function(e){
           if(e.oldDate!=null){
               
           }
    });

    $('#mydate2').on('change dp.change', function(e){
        if(e.oldDate!=null){
           
        }
    });





});