/**
 * Created by jorge on 09/11/17.
 */

var app = angular.module('contalapp');

app.controller('homeIndex',function ($scope,kConstant,$http,$window,$filter) {
  
    $scope.show = function(data){
        console.log(data);
    }



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