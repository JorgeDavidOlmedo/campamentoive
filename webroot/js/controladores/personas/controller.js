/**
 * Created by jorge on 09/11/17.
 */
var app = angular.module('contalapp');
app.controller('personaIndex',function ($scope,kConstant,$http,$window,$filter,$timeout,usuariosByTerm) {
   
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
         $window.location.href = kConstant.url+"personas/edit/"+id;
    }

    $scope.agregar_entity = function () {
        $window.location.href = kConstant.url+"personas/add/";
    }


    $scope.ver_entity = function (id) {
        $window.location.href = kConstant.url+"personas/view/"+id;
    }


    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"personas/index";
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
            $http.post(kConstant.url+"personas/deleteEntity/"+id).
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

app.controller('personaAdd',function($scope,kConstant,$http,$window,lugaresByTerm,$timeout){


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

      $scope.guardar = function (){

        if($scope.verificar_campos()){
           $scope.persona.estado=1;
           $scope.persona.sexo = $("#sexo").val();
            $scope.persona.id_pais = $("#pais").val();
           var fecha = $("#fecha").val();
           fecha = fecha.split("/");
           fecha = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
           $scope.persona.fecha_nacimiento = fecha;
           $scope.persona.id_lugar = $scope.lugar.id;
           console.log($scope.persona);
           $http.post(kConstant.url+"personas/addEntity/",$scope.persona).
           then(function(response){
              console.log(response.data.mensaje);
              if(response.data.mensaje=="error"){
                  toastr.error('Este DNI ya existe en la Base de datos.','Notificación!');
                  return;
              }else{
                  $window.location.href = kConstant.url+"personas/index";
              }
              //$window.location.href = kConstant.url+"personas/index";
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

        if($scope.persona==null || $scope.persona==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };

        if($scope.persona.descripcion==null || $scope.persona.descripcion==""){
            toastr.error('Debes completar la descripcion.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };

        if($scope.persona.dni==null || $scope.persona.dni==""){
            toastr.error('Debes completar el dni.','Notificación!');
            $( "#dni" ).focus();
            return false;
        };

        if($scope.lugar==null || $scope.lugar==""){
            toastr.error('Debes completar el lugar.','Notificación!');
            $( "#lugar" ).focus();
            return false;
        };

        if($("#fecha").val()==null || $("#fecha").val()==""){
            toastr.error('Debes completar la fecha.','Notificación!');
            $( "#fecha" ).focus();
            return false;
        };


        if($scope.persona.telefono==null || $scope.persona.telefono==""){
            toastr.error('Debes completar el telefono.','Notificación!');
            $( "#telefono" ).focus();
            return false;
        };



        return true;
    }

    $("#descripcion").focus();
});

app.controller('personaEdit',function ($scope,$http,kConstant,$window,lugaresByTerm,$timeout) {

     $scope.cargar_datos = function (id) {
        $scope.persona = [];
        $http.get(kConstant.url+"/personas/getEntity/"+id)
            .then(function(data){
                $scope.persona=data.data.persona[0];
                $("#sexo").val($scope.persona.sexo);
                $("#pais").val($scope.persona.id_pais);
                $scope.lugar = $scope.persona.lugare;
                var fecha = data.data.persona[0].fecha_nacimiento;
                fecha = fecha.substring(0,10);
                fecha = fecha.split('-');
                $("#fecha").val(fecha[2]+"/"+fecha[1]+"/"+fecha[0]);

        
            });

      }

      $scope.modificar = function (id) {
         delete $scope.persona.lugare;
          $scope.persona.sexo = $("#sexo").val();
          $scope.persona.id_pais = $("#pais").val();
          var fecha = $("#fecha").val();
          fecha = fecha.split("/");
          fecha = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
          console.log(fecha);
          $scope.persona.fecha_nacimiento = fecha;
          $scope.persona.id_lugar = $scope.lugar.id;
          console.log($scope.persona);
         if($scope.verificar_campos()){
              $http.post(kConstant.url+"personas/editEntity/"+id,$scope.persona).
              then(function(response){
                  $window.location.href = kConstant.url+"personas/index";
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

        if($scope.persona==null || $scope.persona==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };

        if($scope.persona.descripcion==null || $scope.persona.descripcion==""){
            toastr.error('Debes completar la descripcion.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };

        if($scope.persona.dni==null || $scope.persona.dni==""){
            toastr.error('Debes completar el dni.','Notificación!');
            $( "#dni" ).focus();
            return false;
        };

        if($scope.lugar==null || $scope.lugar==""){
            toastr.error('Debes completar el lugar.','Notificación!');
            $( "#lugar" ).focus();
            return false;
        };

        if($("#fecha").val()==null || $("#fecha").val()==""){
            toastr.error('Debes completar la fecha.','Notificación!');
            $( "#fecha" ).focus();
            return false;
        };


        if($scope.persona.telefono==null || $scope.persona.telefono==""){
            toastr.error('Debes completar el telefono.','Notificación!');
            $( "#telefono" ).focus();
            return false;
        };






        return true;
    }

    $("#descripcion").focus();
});
