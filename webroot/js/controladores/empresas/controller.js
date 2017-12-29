/**
 * Created by jorge on 12/28/16.
 */
var app = angular.module('contalapp');

app.controller('empresaIndex',function ($scope,kConstant,$http,$window,$filter,$timeout,empresasByTerm) {

     $scope.empresas = [];
     $scope.getEmpresas = function () {

         $http.get(kConstant.url+"/empresas/getEntityAll/")
             .then(function(data){
                 $scope.empresas=data.data.empresas;
                 console.log(data.data.empresas);

             });
     }


     $scope.focus_buscar = function(){
        $(".buscador").focus();
    }

    $scope.obtener_entity = function (id) {
         $window.location.href = kConstant.url+"empresas/edit/"+id;
    }

    $scope.agregar_entity = function () {
        $window.location.href = kConstant.url+"empresas/add/";
    }

    $scope.ver_entity = function (id) {
        $window.location.href = kConstant.url+"empresas/view/"+id;
    }

    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"empresas/index";
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
            $http.post(kConstant.url+"empresas/deleteEntity/"+id).
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



   // $scope.getEmpresas();

    $scope.empresa='';
    $scope.empresas = function(empresaValue){
        console.log(empresaValue);
        var futureEmpresas = empresasByTerm.async(empresaValue);
        return futureEmpresas.then(function (response){
            //console.log('datos: '+response.data.clientes);
            return response.data.empresas;
        });
    };

    $scope.onSelect = function ($label) {
        var id = ($label || '').split('-');
        $window.location.href = kConstant.url+"empresas/view/"+id[0];
    }

    /******************PAGINACION**********************/
    $scope.currentPage = 0;
    $scope.pageSize = 50;
    $scope.data = [];
    $scope.q = '';

    $scope.getData = function () {
      return $filter('filter')($scope.empresas, $scope.q)

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

app.controller('empresaAdd',function($scope,kConstant,$http,$window){

      $("#descripcion").focus();
      var hoy = new Date();


     $scope.clientes=[];
     $scope.proveedores=[];
     $scope.cuentasCajas=[];
     $scope.camareros=[];

      $scope.empresa = {
          descripcion:"",
          ruc:"",
          dv:"",
          telefono:"",
          direccion:"",
          direccion:"",
          representante:"",
          ruc_representante:"",
          dv_representante:"",
          clientes:$scope.clientes,
          proveedores:$scope.proveedores,
          cuentas_cajas:$scope.cuentasCajas,
          camareros:$scope.camareros
      };

      $scope.guardar = function (){
        var c={
          id:0,
          descripcion:"Sin Denominacion",
          email:"sindatos@gmail.com",
          documento:1,
          telefono:"01",
          direccion:"Sin Direccion",
          descuento:0,
          estado:1
        }  
        $scope.clientes.push(c);

        var p={
            id:0,
            descripcion:"Sin Denominacion",
            email:"sindatos@gmail.com",
            documento:1,
            telefono:"01",
            direccion:"Sin Direccion",
            descuento:0,
            estado:1
          }  
          $scope.proveedores.push(p);

          var cc = {
              id:0,
              tipo:"debe",
              descripcion:"Cobranzas",
              estado:1
          }
          $scope.cuentasCajas.push(cc);

          cc = {
            id:0,
            tipo:"haber",
            descripcion:"Saque de Efectivo",
            estado:1
        }
        $scope.cuentasCajas.push(cc);

        cc = {
            id:0,
            tipo:"haber",
            descripcion:"Saque de Cheque",
            estado:1
        }
        $scope.cuentasCajas.push(cc);

        var cam= {
            id:0,
            descripcion:"Sin Denominacion",
            email:"sindatos@gmail.com",
            documento:1,
            telefono:"01",
            direccion:"Sin Direccion",
            descuento:0,
            estado:1
        }
        $scope.camareros.push(cam);


        if($scope.verificar_campos()){
           $scope.empresa.estado=1;
           $scope.empresa.created=hoy;
           console.log($scope.empresa);
           $http.post(kConstant.url+"empresas/addEntity",$scope.empresa).
           then(function(response){
               $window.location.href = kConstant.url+"empresas/index";
              //console.log(response);
           },function (response) {

           });
       }
    }


   $scope.verificar_campos = function () {

       if($scope.empresa==null || $scope.empresa==""){
           toastr.error('Debes completar correctamente los datos.','Notificación!');
           $( "#descripcion" ).focus();
           return false;
       }
       if($scope.empresa.descripcion==null || $scope.empresa.descripcion==""){
           toastr.error('El campo descripcion no puede estar vacio.','Notificación!');
           $( "#descripcion" ).focus();
           return false;
       };
       if($scope.empresa.ruc==null || $scope.empresa.ruc==""){
           toastr.error('El campo ruc no puede estar vacio.','Notificación!');
           $( "#ruc" ).focus();
           return false;
       };
       
       if($scope.empresa.telefono==null || $scope.empresa.telefono==""){
           toastr.error('El campo telefono no puede estar vacio.','Notificación!');
           $( "#telefono" ).focus();
           return false;
       };
       if($scope.empresa.direccion==null || $scope.empresa.direccion==""){
           toastr.error('El campo direccion no puede estar vacio.','Notificación!');
           $( "#direccion" ).focus();
           return false;
       };


       return true;
    }



});

app.controller('empresaEdit',function ($scope,$http,kConstant,$window) {

    $scope.cargar_datos = function (id) {
        $scope.empresa = [];
        $http.get(kConstant.url+"/empresas/getEntity/"+id)
            .then(function(data){
                $scope.empresa=data.data.empresa[0];
                console.log($scope.empresa);

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


    $scope.verificar_campos = function () {

        if($scope.empresa==null || $scope.empresa==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        }
        if($scope.empresa.descripcion==null || $scope.empresa.descripcion==""){
            toastr.error('El campo descripcion no puede estar vacio.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };
        if($scope.empresa.ruc==null || $scope.empresa.ruc==""){
            toastr.error('El campo ruc no puede estar vacio.','Notificación!');
            $( "#ruc" ).focus();
            return false;
        };
       
        if($scope.empresa.telefono==null || $scope.empresa.telefono==""){
            toastr.error('El campo telefono no puede estar vacio.','Notificación!');
            $( "#telefono" ).focus();
            return false;
        };
        if($scope.empresa.direccion==null || $scope.empresa.direccion==""){
            toastr.error('El campo direccion no puede estar vacio.','Notificación!');
            $( "#direccion" ).focus();
            return false;
        };

        if($scope.empresa.representante==null || $scope.empresa.representante==""){
            toastr.error('El campo representante no puede estar vacio.','Notificación!');
            $( "#representante" ).focus();
            return false;
        };

        if($scope.empresa.ruc_representante==null || $scope.empresa.ruc_representante==""){
            toastr.error('El campo ruc representante no puede estar vacio.','Notificación!');
            $( "#ruc-representante" ).focus();
            return false;
        };

        if($scope.empresa.dv_representante==null || $scope.empresa.dv_representante==""){
            toastr.error('El campo dv representante no puede estar vacio.','Notificación!');
            $( "#dv-representante" ).focus();
            return false;
        };

        return true;
    }
});