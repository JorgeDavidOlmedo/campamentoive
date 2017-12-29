/**
 * Created by jorge on 09/11/17.
 */
var app = angular.module('contalapp');
app.controller('perfilIndex',function ($scope,kConstant,$http,$window,$filter,$timeout,perfilByTerm) {

    $scope.focus_buscar = function(){
        $(".buscador").focus();
    }
    $scope.obtener_entity = function (id) {
         $window.location.href = kConstant.url+"perfil/edit/"+id;
    }
    $scope.agregar_entity = function () {
        $window.location.href = kConstant.url+"perfil/add/";
    }
    $scope.ver_entity = function (id) {
        $window.location.href = kConstant.url+"perfil/view/"+id;
    }
    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"perfil/index";
    }
    $scope.borrar_entity = function (id) {
        swal({
            title: "Deseas Anular el registro # "+id+"?",
            text: "Atencion. al anular el registro ya no podras recuperarlo!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, eliminar!",
            closeOnConfirm: false
        }, function () {
            $http.post(kConstant.url+"perfil/deleteEntity/"+id).
            then(function(response){
                console.log(response.data);
                if(response.data.message=="pendiente"){
                    swal("Atencion!", "No se puede anular la compra. posee una deuda pendiente.", "warning");
                    return;
                }
                if(response.data.message=="ok"){
                    swal("Eliminado!", "El registro se elimino correctamente.", "success");
                    $timeout(function () {
                        $scope.listar_entity();
                    }, 1000);
                }
            },function (response) {
                console.log(response);
            });
        });
    }
    $scope.id_search='';
    $scope.perfil='';
    $scope.perfiles = function(perfilValue){
        var futurePerfiles = perfilByTerm.async(perfilValue);
        return futurePerfiles.then(function (response){
            $scope.id_search=response.data.perfiles[0].id;
            return response.data.perfiles;

        });
    };
    $scope.onSelect = function ($label) {
        $window.location.href = kConstant.url+"perfil/view/"+$scope.id_search;
    }
});
app.controller('perfilAdd',function($scope,kConstant,$http,$window,$rootScope){

    /****Inicializar valores**********/

      $scope.inicializarPerfil = function () {
          $scope.detallePerfil=[];
          $scope.perfil = {
              id:0,
              descripcion:"",
              estado:1,
              detalle_perfil:$scope.detallePerfil
          }
          $("#descripcion").focus();

      }

    $scope.removeRow= function(id){
        var index = -1;
        var comArr = eval( $scope.detallePerfil);
        for( var i = 0; i < comArr.length; i++ ) {
            if( comArr[i].id_model === id) {
                index = i;
                break;
            }
        }
        $scope.detallePerfil.splice( index, 1 );

    }


    $scope.inicializarPerfil();
    $scope.agregarPerfil=function(){
        var models = $("#models").val();
        var modelsText = $("#models :selected").text();
        var guardar = $("#guardar").val();
        var modificar = $("#modificar").val();
        var eliminar = $("#eliminar").val();
        var consultar = $("#consultar").val();
        var flagRepetido=0;
        if(modelsText=='Seleccionar'){
          toastr.error('Debes seleccionar un modelo.','Notificación!');
          $("#models").focus();
        }else{

          if($scope.detallePerfil.length>0){
            for(var i=0;$scope.detallePerfil.length>i;i++){
               if(models==$scope.detallePerfil[i].id_model){
                 flagRepetido=1;
               }
            }
          }

          if(flagRepetido==1){
            flagRepetido=0;
            toastr.error('Ya existe un modelo en la lista.','Notificación!');
          }else{
            var s = {
                id_model:models,
                modelsText:modelsText,
                guardar:guardar,
                modificar:modificar,
                eliminar:eliminar,
                consultar:consultar,
                estado:1

            };
            $scope.detallePerfil.push(s);
          }

        }
    }

   $scope.guardarPerfil = function(){
    if($scope.verificarPerfil()){
      $scope.perfil.descripcion=$scope.descripcion;
      $scope.perfil.estado=1;
      $scope.perfil.detalle_perfil=$scope.detallePerfil;

      $http.post(kConstant.url+"perfil/addEntity",$scope.perfil).
            then(function(response){
               if(response.data.mensaje="ok"){
                    $window.location.href = kConstant.url+"perfil/index";
                }else{
                    toastr.error('No se puedieron guardar los datos.','Notificación!');
                }
            },function (error) {
                console.log(error);
            });
    }

   }

   $scope.verificarPerfil = function(){
     if($('#descripcion').val()==null ||$('#descripcion').val()==""){
         toastr.error('Debes ingresar la descripcion del perfil.','Notificación!');
         $( "#descripcion" ).focus();
         return false;
     }
     if($scope.detallePerfil.length<=0){
       toastr.error('Debes ingresar al menos un modelo en la lista.','Notificación!');
       $( "#descripcion" ).focus();
       return false;
     }
     return true;
   }


});

app.controller('perfilEdit',function ($scope,$http,kConstant,$window) {
    $scope.cargar_datos = function (id) {
        $scope.perfil = [];
        $scope.detallePerfil=[];
        $http.get(kConstant.url+"/perfil/getEntity/"+id)
            .then(function(data){
                $scope.perfil=data.data.perfil[0];
                $scope.detallePerfil=data.data.perfil[0].detalle_perfil;

            });
      }
      $scope.modificar = function (id) {
          if($scope.verificar_campos()){
              $http.post(kConstant.url+"empresas/editEntity/"+id,$scope.empresa).
              then(function(response){
                  $window.location.href = kConstant.url+"empresas/index";
              },function (response) {

              });
          }
      }

      $scope.inicializarPerfil = function () {
          $scope.detallePerfil=[];
          $scope.perfil = {
              id:0,
              descripcion:"",
              estado:1,
              detalle_perfil:$scope.detallePerfil
          }
          $("#descripcion").focus();

      }

    $scope.removeRow= function(id){
        var index = -1;
        var comArr = eval( $scope.detallePerfil);
        for( var i = 0; i < comArr.length; i++ ) {
            if( comArr[i].id_model === id) {
                index = i;
                break;
            }
        }
        $scope.detallePerfil.splice( index, 1 );

    }


    $scope.inicializarPerfil();
    $scope.agregarPerfil=function(){
      var models = $("#models").val();
      var modelsText = $("#models :selected").text();
      var guardar = $("#guardar").val();
      var modificar = $("#modificar").val();
      var eliminar = $("#eliminar").val();
      var consultar = $("#consultar").val();
      var flagRepetido=0;
      if(modelsText=='Seleccionar'){
        toastr.error('Debes seleccionar un modelo.','Notificación!');
        $("#models").focus();
      }else{

        if($scope.detallePerfil.length>0){
          for(var i=0;$scope.detallePerfil.length>i;i++){
             if(models==$scope.detallePerfil[i].id_model){
               flagRepetido=1;
             }
          }
        }

        if(flagRepetido==1){
          flagRepetido=0;
          toastr.error('Ya existe un modelo en la lista.','Notificación!');
        }else{
          var s = {
              id_model:models,
              model:{
                descripcion:modelsText
              },
              guardar:guardar,
              modificar:modificar,
              eliminar:eliminar,
              consultar:consultar,
              estado:1

          };
          $scope.detallePerfil.push(s);
        }

      }
    }

   $scope.editarPerfil = function(){
    if($scope.verificarPerfil()){
      $scope.perfil.estado=1;
      $scope.perfil.detalle_perfil=$scope.detallePerfil;
      var id = $scope.perfil.id;

      $http.post(kConstant.url+"perfil/editEntity/"+id,$scope.perfil).
            then(function(response){
               if(response.data.mensaje="ok"){
                    $window.location.href = kConstant.url+"perfil/index";
                }else{
                    toastr.error('No se puedieron guardar los datos.','Notificación!');
                }
            },function (error) {
                console.log(error);
            });
    }

   }

   $scope.verificarPerfil = function(){
     if($('#descripcion').val()==null ||$('#descripcion').val()==""){
         toastr.error('Debes ingresar la descripcion del perfil.','Notificación!');
         $( "#descripcion" ).focus();
         return false;
     }
     if($scope.detallePerfil.length<=0){
       toastr.error('Debes ingresar al menos un modelo en la lista.','Notificación!');
       $( "#descripcion" ).focus();
       return false;
     }
     return true;
   }

   $scope.consularModel = function(id){
     $http.post(kConstant.url+"perfil/getEntityPerfilModel/"+id).
           then(function(response){
              $("#id_detalle").val(response.data.perfil_detalle[0].id);
              $("#models-2").val(response.data.perfil_detalle[0].id_model);
              $("#guardarModel").val(response.data.perfil_detalle[0].guardar);
              $("#modificarModel").val(response.data.perfil_detalle[0].modificar);
              $("#eliminarModel").val(response.data.perfil_detalle[0].eliminar);
              $("#consultarModel").val(response.data.perfil_detalle[0].consultar);
           },function (error) {
               console.log(error);
           });
   }


   $scope.editarPermiso = function(id){
        $("#form-permiso").modal();
        setTimeout(function(){ $( "#descripcion" ).focus(); }, 500);
        $scope.consularModel(id);
   }

   $scope.inicializar=function(){
     $scope.perfilModel = {
       id_perfil:0,
       id_model:  '',
       guardar: '',
       modificar: '',
       eliminar: '',
       consultar:''
     }

   }

   $scope.guardarPerfilModel = function(){

          $scope.perfilModel.id_perfil=$("#id_detalle").val();
          $scope.perfilModel.id_model=  $("#models-2").val();
          $scope.perfilModel.guardar= $("#guardarModel").val();
          $scope.perfilModel.modificar= $("#modificarModel").val();
          $scope.perfilModel.eliminar= $("#eliminarModel").val();
          $scope.perfilModel.consultar= $("#consultarModel").val();

          $http.post(kConstant.url+"perfil/editarPerfilModel/",$scope.perfilModel).
              then(function(response){
              $scope.cargar_datos($scope.perfil.id);
              $('#form-permiso').modal('toggle');
              },function (error) {
                  console.log(error);
              });
   }

   $scope.inicializar();

});
function format(input)
{
    var num = input.value.replace(/\./g,'');
    if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        input.value = num;
    }
    else{
        input.value = input.value.replace(/[^\d\.]*/g,'');
    }
}
