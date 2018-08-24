/**
 * Created by jorge on 09/11/17.
 */
var app = angular.module('contalapp');
app.controller('usuarioIndex',function ($scope,kConstant,$http,$window,$filter,$timeout,usuariosByTerm) {
   
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
         $window.location.href = kConstant.url+"usuarios/edit/"+id;
    }

    $scope.agregar_entity = function () {
        $window.location.href = kConstant.url+"usuarios/add/";
    }


    $scope.ver_entity = function (id) {
        $window.location.href = kConstant.url+"usuarios/view/"+id;
    }


    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"usuarios/index";
    }

    $scope.volver = function () {
        $window.location.href = kConstant.url+"pages/home";
    }



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
            $http.post(kConstant.url+"usuarios/deleteEntity/"+id).
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

});

app.controller('usuarioAdd',function($scope,kConstant,$http,$window){

      var hoy = new Date();
      $scope.guardar = function (){

        if($scope.verificar_campos()){
           $scope.usuario.estado=1;
           //$scope.usuario.created=hoy;
           $http.post(kConstant.url+"usuarios/addEntity",$scope.usuario).
           then(function(response){
               //
               console.log(response.data.mensaje);
               if(response.data.mensaje=="ok"){
                $window.location.href = kConstant.url+"usuarios/index";
               }else{
                toastr.error('El email no se puede repetir','Notificación!');
               }
            
           },function (response) {

           });
       }
    }


    $scope.verificar_campos = function () {

        if($scope.usuario==null || $scope.usuario==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#email" ).focus();
            return false;
        };

        if($scope.usuario.email==null || $scope.usuario.email==""){
            toastr.error('El campo email no puede estar vacio.','Notificación!');
            $( "#email" ).focus();
            return false;
        };
        if($scope.usuario.password==null || $scope.usuario.password==""){
            toastr.error('El campo password no puede estar vacio.','Notificación!');
            $( "#password" ).focus();
            return false;
        };
        if($scope.usuario.rol==null || $scope.usuario.rol==""){
            toastr.error('Debes definir el rol.','Notificación!');
            $( "#rol" ).focus();
            return false;
        };


        return true;
    }

  $("#email").focus();
});

app.controller('usuarioEdit',function ($scope,$http,kConstant,$window) {

     $scope.cargar_datos = function (id) {
        $scope.usuario = [];
        $http.get(kConstant.url+"/usuarios/getEntity/"+id)
            .then(function(data){
                $scope.usuario=data.data.usuario[0];
                $("#perfil").val($scope.usuario.id_perfil);

            });

      }

      $scope.modificar = function (id) {
         if($scope.verificar_campos()){
              $http.post(kConstant.url+"usuarios/editEntity/"+id,$scope.usuario).
              then(function(response){
                  $window.location.href = kConstant.url+"usuarios/index";
              },function (response) {

              });
          }
      }


    $scope.verificar_campos = function () {

        if($scope.usuario==null || $scope.usuario==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#email" ).focus();
            return false;
        };

        if($scope.usuario.email==null || $scope.usuario.email==""){
            toastr.error('El campo email no puede estar vacio.','Notificación!');
            $( "#email" ).focus();
            return false;
        };
        if($scope.usuario.password==null || $scope.usuario.password==""){
            toastr.error('El campo password no puede estar vacio.','Notificación!');
            $( "#password" ).focus();
            return false;
        };
        if($scope.usuario.rol==null || $scope.usuario.rol==""){
            toastr.error('Debes definir el rol.','Notificación!');
            $( "#rol" ).focus();
            return false;
        };


        return true;
    }
});
