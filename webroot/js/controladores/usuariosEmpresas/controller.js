/**
 * Created by jorge on 09/11/17.
 */
var app = angular.module('contalapp');

app.controller('usuarioEmpresaIndex',function ($scope,kConstant,$http,$window,$filter) {

    $scope.usuariosEmpresas = [];
    $scope.getusuariosEmpresas = function () {

        $http.get(kConstant.url+"/usuariosEmpresas/getEntityAll/")
            .then(function(data){
                $scope.usuariosEmpresas=data.data.usuariosEmpresas;
                console.log(data.data.usuariosEmpresas);

            });
    }


    $scope.focus_buscar = function(){
        $(".buscador").focus();
    }

    $scope.obtener_entity = function (id) {
         $window.location.href = kConstant.url+"usuariosEmpresas/edit/"+id;
    }

    $scope.agregar_entity = function () {
        $window.location.href = kConstant.url+"usuariosEmpresas/add/";
    }

    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"usuariosEmpresas/index";
    }

    $scope.ver_entity_usuario = function (id) {
        $window.location.href = kConstant.url+"usuarios/view/"+id;
    }

    $scope.ver_entity_empresa = function (id) {
        $window.location.href = kConstant.url+"empresas/view/"+id;
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
            $http.post(kConstant.url+"usuariosEmpresas/deleteEntity/"+id).
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

    $scope.getusuariosEmpresas();

    /******************PAGINACION**********************/
    $scope.currentPage = 0;
    $scope.pageSize = 50;
    $scope.data = [];
    $scope.q = '';

    $scope.getData = function () {
        return $filter('filter')($scope.usuariosEmpresas, $scope.q)

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

app.controller('usuarioEmpresaAdd',function($scope,kConstant,$http,$window,usuariosByTerm,empresasByTerm){
     console.log('usuarioEmpresaAdd');
      $("#descripcion").focus();
      var hoy = new Date();
      $scope.usuariosEmpresas={};


      $scope.save = function(){

        $scope.usuariosEmpresas.id_usuario = $scope.usuario.id;
        $scope.usuariosEmpresas.id_empresa = $scope.empresa.id;
        $scope.usuariosEmpresas.estado = 1;
        $scope.usuariosEmpresas.created = hoy;

          console.log($scope.usuariosEmpresas);

        $http.post(kConstant.url+"usuariosEmpresas/addEntity",$scope.usuariosEmpresas).
        then(function(response){
            $window.location.href = kConstant.url+"usuariosEmpresas/index";
        },function (response) {

        });
      }  

      $scope.guardar = function (){

         if($scope.verificar_campos()){

            $http.get(kConstant.url+"usuariosEmpresas/consistenciaDeDatos/"+$scope.usuario.id+"/"+$scope.empresa.id).
            then(function(response){
               if(response.data.message=="false"){
                   $scope.save();
               }else{
                swal("Aviso!", "Ya existe esta combinacion en la Base de Datos.", "error");
               }    
            },function (response) {
    
            });
           
       }
    }


   $scope.verificar_campos = function () {

       if($scope.usuario.nombre==null){

        toastr.error('Debes completar el campo usuario.','Notificación!');
           $( "#usuario" ).focus();
           return false;
       }
       if($scope.empresa.descripcion==null){
        toastr.error('Debes completar el campo empresa.','Notificación!');
           $( "#empresa" ).focus();
           return false;
       };

       return true;
    }

   $scope.usuario='';
   $scope.usuarios = function(usuarioValue){
       //console.log(usuarioValue);
      
        var futureUsuarios = usuariosByTerm.async(usuarioValue);
         return futureUsuarios.then(function (response){
            // console.log(response.data.usuarios);
            return response.data.usuarios;
        });
    };

    
    $scope.empresa='';
    $scope.empresas = function(empresaValue){

        var futureEmpresas = empresasByTerm.async(empresaValue);
        return futureEmpresas.then(function (response){
            return response.data.empresas;
        });
    };

    $scope.detalleUsuarioEmpresa=[];
    $scope.agregar_grilla = function () {

        if($scope.usuario.nombre==null || $scope.empresa.descripcion==null){
                if($scope.usuario==null){
                    alert("Debes llenar correctamente los campos.");
                    $("#usuario").focus();
                }else{
                    alert("Debes llenar correctamente los campos.");
                    $("#empresa").focus();
                }

        }else{

            var comArr = eval( $scope.detalleUsuarioEmpresa);
            var item = 0;
            for(var i=0;i<comArr.length;i++){
                if( comArr[i].usuario.nombre === $scope.usuario.nombre && comArr[i].empresa.descripcion === $scope.empresa.descripcion) {
                    item = 1;
                }
            }

            if(item==1){
                alert('Ya existe el usuario y empresa en la lista.');
                $("#usuario").focus();
            }else{
                var comarray = eval($scope.detalleUsuarioEmpresa);
                var codigo = 0;
                if(comarray.length>0){
                    console.log(comarray[$scope.detalleUsuarioEmpresa.length-1]);
                    codigo = (comarray[$scope.detalleUsuarioEmpresa.length-1].id)+1;
                }else{
                    codigo = 1;
                }

                var x = {
                    id:codigo,
                    usuario: $scope.usuario,
                    empresa : $scope.empresa
                };
                $scope.detalleUsuarioEmpresa.push(x);
                $scope.cancelar();
            }

        }

    }

    $scope.removeRow = function(name,empresa){
        var index = -1;
        var comArr = eval( $scope.detalleUsuarioEmpresa);
        //console.log(comArr[0].usuario.nombre);
        for( var i = 0; i < comArr.length; i++ ) {
            if( comArr[i].usuario.nombre === name && comArr[i].empresa.descripcion === empresa) {
                index = i;
                break;
            }
        }
       $scope.detalleUsuarioEmpresa.splice( index, 1 );
    };

    $scope.cancelar = function () {
  
        $("#usuario").focus();
    }


});

app.controller('empresaEdit',function ($scope,$http,kConstant,$window) {

    $scope.cargar_datos = function (id) {
        $scope.empresa = [];
        $http.get(kConstant.url+"/usuariosEmpresas/getEntity/"+id)
            .then(function(data){
                console.log(data.data);
                //$scope.empresa=data.data.empresa[0];
                //console.log($scope.empresa);

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

        if($scope.empresa==null){

            alert('Debes completar correctamente los datos.');
            $( "#descripcion" ).focus();
            return false;
        }
        if($scope.empresa.descripcion==null){
            alert('El campo descripcion no puede estar vacio.');
            $( "#descripcion" ).focus();
            return false;
        };
        if($scope.empresa.ruc==null){
            alert('El campo ruc no puede estar vacio.');
            $( "#ruc" ).focus();
            return false;
        };
        if($scope.empresa.dv==null){
            alert('El campo dv no puede estar vacio.');
            $( "#dv" ).focus();
            return false;
        };
        if($scope.empresa.telefono==null){
            alert('El campo telefono no puede estar vacio.');
            $( "#telefono" ).focus();
            return false;
        };
        if($scope.empresa.direccion==null){
            alert('El campo direccion no puede estar vacio.');
            $( "#direccion" ).focus();
            return false;
        };

        if($scope.empresa.representante==null){
            alert('El campo representante no puede estar vacio.');
            $( "#representante" ).focus();
            return false;
        };

        if($scope.empresa.ruc_representante==null){
            alert('El campo ruc representante no puede estar vacio.');
            $( "#ruc-representante" ).focus();
            return false;
        };

        if($scope.empresa.dv_representante==null){
            alert('El campo dv representante no puede estar vacio.');
            $( "#dv-representante" ).focus();
            return false;
        };

        return true;
    }
});