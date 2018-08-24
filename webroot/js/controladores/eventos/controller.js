/**
 * Created by jorge on 09/11/17.
 */
var app = angular.module('contalapp');
app.controller('eventoIndex',function ($scope,kConstant,$http,$window,$filter,$timeout,usuariosByTerm) {
   
    $scope.usuarios = [];
    $scope.getUsuarios = function () {

        $http.get(kConstant.url+"/usuarios/getEntityAll/")
            .then(function(data){
                $scope.usuarios=data.data.usuarios;
                console.log(data.data.usuarios);

            });
    }

    $scope.focus_buscar = function(){
        $(".buscador").focus();
    }

    $scope.obtener_entity = function (id) {
         $window.location.href = kConstant.url+"eventos/edit/"+id;
    }

    $scope.agregar_entity = function () {
        $window.location.href = kConstant.url+"eventos/add/";
    }


    $scope.ver_entity = function (id) {
        $window.location.href = kConstant.url+"eventos/view/"+id;
    }


    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"eventos/index";
    }

    $scope.volver = function () {
        $window.location.href = kConstant.url+"pages/home";
    }



    $scope.buscar = function(valor) {
        var rex = new RegExp(valor, 'i');
        $('.buscar tr').hide();
        $('.buscar tr').filter(function () {
            return rex.test($(this).text());
        }).show();
    }

    $('#filtrar').keyup(function () {
        $scope.buscar($('#filtrar').val());

    });

    $scope.borrar_entity = function (id) {

        swal({
            title: "Deseas eliminar el registro # "+id+"?",
            text: "Atencion. al eliminar el registro ya no podras recuperarlo!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, eliminar!",
            closeOnConfirm: false
        }, function () {
            $http.post(kConstant.url+"eventos/deleteEntity/"+id).
            then(function(response){
                swal("Eliminado!", "El registro se elimino correctamente.", "success");
                $timeout(function () {
                    $scope.listar_entity();
                }, 1000);

            },function (response) {
                console.log(response);
            });

        });

    }


    $scope.usuario='';
    $scope.usuarios = function(usuarioValue){
       console.log(usuarioValue);
        var futureEmpresas = usuariosByTerm.async(usuarioValue);
        return futureEmpresas.then(function (response){
            return response.data.usuarios;
        });
    };

    $scope.onSelect = function ($label) {
        console.log($label);
        var id = ($label || '').split('-');
        console.log(id);
        $window.location.href = kConstant.url+"usuarios/view/"+id[0];
    }


    /******************PAGINACION**********************/
    $scope.currentPage = 0;
    $scope.pageSize = 50;
    $scope.data = [];
    $scope.q = '';

    $scope.getData = function () {
        return $filter('filter')($scope.usuarios, $scope.q)

    }

    $scope.numberOfPages=function(){
        var numero = 1;
        numero = Math.ceil($scope.getData().length/$scope.pageSize);
        if(numero==0){
            numero=1;
        }else{
            numero = Math.ceil($scope.getData().length/$scope.pageSize);
        }
        return numero;
    }

    $scope.$watch('q', function(newValue,oldValue){
        if(oldValue!=newValue){
            $scope.currentPage = 0;

        }
    },true);
    /**********************************************************/

    $('#filtrar').focus();

});

app.controller('eventoAdd',function($scope,kConstant,$http,$window,lugaresByTerm,$timeout){


    $scope.formatDate = function(date) {
        var d = new Date(date || Date.now()),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year,month,day].join('-');
    }
    $scope.formatDateDMY = function(date) {
        var d = new Date(date || Date.now()),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [day,month,year].join('/');
    }

    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);

    $('#fecha').val($scope.formatDateDMY(date));
    $('#fecha2').val($scope.formatDateDMY(date));

      $scope.guardar = function (){

        if($scope.verificar_campos()){
           $scope.evento.estado=1;
           var fecha = $("#fecha").val();
           fecha = fecha.split("/");
           fecha = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
           $scope.evento.fecha_inicio = fecha;

            var fecha2 = $("#fecha2").val();
            fecha2 = fecha2.split("/");
            fecha2 = fecha2[2]+'-'+fecha2[1]+'-'+fecha2[0];
            $scope.evento.fecha_fin = fecha2;

           console.log($scope.evento);
           $http.post(kConstant.url+"eventos/addEntity/",$scope.evento).
           then(function(response){
              console.log(response);
              $window.location.href = kConstant.url+"eventos/index";
           },function (response) {

           });
       }
    }



    $scope.lugar='';
    $scope.lugares = function(value){
        var future = lugaresByTerm.async(value);
        return future.then(function (response){
            return response.data.lugares;
        });
    };

    $scope.onSelect = function ($item,$model,$label) {
        console.log($model);
        if($model.id=="00"){
            $("#form-lugar").modal();
            setTimeout(function(){ $( "#descripcionl" ).focus(); }, 500);
        }
    }

    $scope.guardarLugar = function(){
        if($scope.verificar_campos_lugar()) {
            $scope.lugarl.estado = 1;
            console.log($scope.lugarl);
            $http.post(kConstant.url + "lugares/addEntity/", $scope.lugarl).then(function (response) {
                toastr.success('El lugar se guardo correctamente.', 'Notificación!');
                $("#form-lugar").modal('hide');
            }, function (response) {

            });
        }

    }

    $scope.verificar_campos_lugar = function () {

        if($scope.evento==null || $scope.evento==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcionl" ).focus();
            return false;
        };

        return true;
    }


    $scope.verificar_campos = function () {

        if($scope.evento==null || $scope.evento==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };

        if($scope.evento.descripcion==null || $scope.evento.descripcion==""){
            toastr.error('Debes completar la descripcion.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };

        if($("#fecha").val()==null || $("#fecha").val()==""){
            toastr.error('Debes completar la fecha.','Notificación!');
            $( "#fecha" ).focus();
            return false;
        };



        return true;
    }

    $("#descripcion").focus();
});

app.controller('eventoEdit',function ($scope,$http,kConstant,$window,lugaresByTerm,$timeout) {

    String.prototype.replaceAll = function(str1, str2, ignore)
    {
        return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
    }

     $scope.cargar_datos = function (id) {
        $scope.evento = [];
        $http.get(kConstant.url+"/eventos/getEntity/"+id)
            .then(function(data){
                $scope.evento=data.data.evento[0];
                var fecha = data.data.evento[0].fecha_inicio;
                fecha = fecha.substring(0,10);
                fecha = fecha.split('-');
                $("#fecha").val(fecha[2]+"/"+fecha[1]+"/"+fecha[0]);

                var fecha2 = data.data.evento[0].fecha_fin;
                fecha2 = fecha2.substring(0,10);
                fecha2 = fecha2.split('-');
                $("#fecha2").val(fecha2[2]+"/"+fecha2[1]+"/"+fecha2[0]);

                $scope.evento.costo_participante = numeral($scope.evento.costo_participante).format('0,0.[00]');
                $scope.evento.costo_participante =$scope.evento.costo_participante.replaceAll(".","_");
                $scope.evento.costo_participante = $scope.evento.costo_participante.replaceAll(",",".");
                $scope.evento.costo_participante = $scope.evento.costo_participante.replaceAll("_",",");

                $scope.evento.costo_colaborador = numeral($scope.evento.costo_colaborador).format('0,0.[00]');
                $scope.evento.costo_colaborador =$scope.evento.costo_colaborador.replaceAll(".","_");
                $scope.evento.costo_colaborador = $scope.evento.costo_colaborador.replaceAll(",",".");
                $scope.evento.costo_colaborador = $scope.evento.costo_colaborador.replaceAll("_",",");

                $scope.evento.costo_voluntario = numeral($scope.evento.costo_voluntario).format('0,0.[00]');
                $scope.evento.costo_voluntario = $scope.evento.costo_voluntario.replaceAll(".","_");
                $scope.evento.costo_voluntario = $scope.evento.costo_voluntario.replaceAll(",",".");
                $scope.evento.costo_voluntario = $scope.evento.costo_voluntario.replaceAll("_",",");
        
            });

      }

      $scope.modificar = function (id) {
          var fecha = $("#fecha").val();
          fecha = fecha.split("/");
          fecha = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
          console.log(fecha);
          $scope.evento.fecha_inicio = fecha;

          var fecha2 = $("#fecha2").val();
          fecha2 = fecha2.split("/");
          fecha2 = fecha2[2]+'-'+fecha2[1]+'-'+fecha2[0];
          $scope.evento.fecha_fin = fecha2;

          console.log($scope.evento);
          if($scope.verificar_campos()){
              $http.post(kConstant.url+"eventos/editEntity/"+id,$scope.evento).
              then(function(response){
                  $window.location.href = kConstant.url+"eventos/index";
              },function (response) {

              });
          }
      }

    $scope.lugar='';
    $scope.lugares = function(value){
        var future = lugaresByTerm.async(value);
        return future.then(function (response){
            return response.data.lugares;
        });
    };

    $scope.onSelect = function ($item,$model,$label) {
        console.log($model);
        if($model.id=="00"){
            $("#form-lugar").modal();
            setTimeout(function(){ $( "#descripcionl" ).focus(); }, 500);
        }
    }

    $scope.guardarLugar = function(){
        if($scope.verificar_campos_lugar()) {
            $scope.lugarl.estado = 1;
            console.log($scope.lugarl);
            $http.post(kConstant.url + "lugares/addEntity/", $scope.lugarl).then(function (response) {
                toastr.success('El lugar se guardo correctamente.', 'Notificación!');
                $("#form-lugar").modal('hide');
            }, function (response) {

            });
        }

    }

    $scope.verificar_campos_lugar = function () {

        if($scope.lugarl==null || $scope.lugarl==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcionl" ).focus();
            return false;
        };

        return true;
    }


    $scope.verificar_campos = function () {

        if($scope.evento==null || $scope.evento==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };

        if($scope.evento.descripcion==null || $scope.evento.descripcion==""){
            toastr.error('Debes completar la descripcion.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };


        return true;
    }

    $("#descripcion").focus();
});

function format(input)
{
    //console.log("VIEJO: "+input.value);
    var num = input.value.replace(/\./g,'');
    //console.log("NUEVO: "+num);
    if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        //console.log("NUM: "+num);
        input.value = num;
    }
    else{
        //console.log("NAN: "+num);
        //input.value = input.value.replace(/[^\d\.]*/g,'');
    }
}
