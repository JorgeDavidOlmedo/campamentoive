/**
 * Created by jorge on 09/11/17.
 */
var app = angular.module('contalapp');
app.controller('lugarIndex',function ($scope,kConstant,$http,$window,$filter,$timeout,usuariosByTerm) {
   
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
         $window.location.href = kConstant.url+"lugares/edit/"+id;
    }

    $scope.agregar_entity = function () {
        $window.location.href = kConstant.url+"lugares/add/";
    }


    $scope.ver_entity = function (id) {
        $window.location.href = kConstant.url+"lugares/view/"+id;
    }


    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"lugares/index";
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
            $http.post(kConstant.url+"lugares/deleteEntity/"+id).
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

app.controller('lugarAdd',function($scope,kConstant,$http,$window){

      var hoy = new Date();
      $scope.guardar = function (){

        if($scope.verificar_campos()){
           $scope.lugar.estado=1;
           console.log($scope.lugar);
           $http.post(kConstant.url+"lugares/addEntity/",$scope.lugar).
           then(function(response){
       
              console.log(response);
              $window.location.href = kConstant.url+"lugares/index";
           },function (response) {

           });
       }
    }


    $scope.verificar_campos = function () {

        if($scope.lugar==null || $scope.llugar==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };

        if($scope.lugar.descripcion==null || $scope.lugar.descripcion==""){
            toastr.error('Debes completar la descripcion.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };


        return true;
    }

    $("#descripcion").focus();
});

app.controller('lugarEdit',function ($scope,$http,kConstant,$window) {

     $scope.cargar_datos = function (id) {
        $scope.lugar = [];
        $http.get(kConstant.url+"/lugares/getEntity/"+id)
            .then(function(data){
                $scope.lugar=data.data.lugar[0];
        
            });

      }

      $scope.modificar = function (id) {
         if($scope.verificar_campos()){
              $http.post(kConstant.url+"lugares/editEntity/"+id,$scope.lugar).
              then(function(response){
                  $window.location.href = kConstant.url+"lugares/index";
              },function (response) {

              });
          }
      }


    $scope.verificar_campos = function () {

        if($scope.lugar==null || $scope.lugar==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };

        if($scope.lugar.descripcion==null || $scope.lugar.descripcion==""){
            toastr.error('Debes completar la descripcion.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };


        return true;
    }

    $("#descripcion").focus();
});
