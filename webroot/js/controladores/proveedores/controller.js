/**
 * Created by jorge on 12/28/16.
 */
var app = angular.module('contalapp');
app.controller('proveedorIndex',function ($scope,kConstant,$http,$window,$filter,$timeout,proveedoresByTerm) {
    console.log("index");
    $scope.proveedores = [];
    $scope.getProveedores = function (idEmpresa) {

        $http.get(kConstant.url+"/proveedores/getEntityAll/"+idEmpresa)
            .then(function(data){
                $scope.proveedores=data.data.proveedores;
                console.log(data.data.proveedores);

            });
    }
    $scope.focus_buscar = function(){
        $(".buscador").focus();
    }

    $scope.obtener_entity = function (id) {
        $window.location.href = kConstant.url+"proveedores/edit/"+id;
    }

    $scope.agregar_entity = function () {
        $window.location.href = kConstant.url+"proveedores/add/";
    }


    $scope.ver_entity = function (id) {
        $window.location.href = kConstant.url+"proveedores/view/"+id;
    }


    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"proveedores/index";
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
            $http.post(kConstant.url+"proveedores/deleteEntity/"+id).
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


    $scope.proveedor='';
    $scope.proveedores = function(proveedorValue){
       console.log(proveedorValue);
        var futureEmpresas = proveedoresByTerm.async(proveedorValue);
        return futureEmpresas.then(function (response){
            return response.data.proveedores;
        });
    };

    $scope.onSelect = function ($item,$model,$labels) {
        var id = $model.id;
        $window.location.href = kConstant.url+"proveedores/view/"+id;
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


    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);

    $('#desde').val($scope.formatDate(ultimoDia));
    //$('#hasta').val($scope.formatDate(ultimoDia));
     $scope.consultando = "none";
     $("#buscar").focus();
});

app.controller('proveedorAdd',function($scope,kConstant,$http,$window){

    var hoy = new Date();

    $scope.proveedor={
         "id": 0,
         "id_emrpesa":0,
         "descripcion":"",
         "email":"",
         "documento":"",
         "contactos":"",
         "telefono":"",
         "telefono_2":"",
         "celular":"",
         "celular_2":"",
         "direccion":"",
         "observacion":"",
         "estado":1
        }

    $scope.formatDate = function(date) {
        var d = new Date(date || Date.now()),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();
            hour = date.getHours();
            minutes = date.getMinutes();
            second = date.getSeconds();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        var fecha =[year,month,day].join('-')
        return fecha;
    }

    $scope.guardar = function (){
        if($scope.verificar_campos()){
            $scope.proveedor.id_empresa = $('#empresa').val();
            $http.post(kConstant.url+"proveedores/addEntity",$scope.proveedor).
            then(function(response){
                //console.log(response);
                if(response.data.mensaje="ok"){
                    $window.location.href = kConstant.url+"proveedores/index";

                }else{
                    toastr.error('No se puedieron guardar los datos.','Notificación!');
                }
            },function (error) {
                console.log(error);
            });
        }
    }


    $scope.verificar_campos = function () {
        console.log($scope.proveedor);
        if($scope.proveedor==null || $scope.proveedor==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#email" ).focus();
            return false;
        };

        if($scope.proveedor.email==null || $scope.proveedor.email==""){
            toastr.error('El campo email no puede estar vacio.','Notificación!');
            $( "#email" ).focus();
            return false;
        };
        if($scope.proveedor.documento==null || $scope.proveedor.documento==""){
            toastr.error('El campo cedula no puede estar vacio.','Notificación!');
            $( "#cedula" ).focus();
            return false;
        };
        
        
        if($scope.proveedor.telefono==null || $scope.proveedor.telefono==""){
            toastr.error('El campo telefono no puede estar vacio..','Notificación!');
            $( "#telefono" ).focus();
            return false;
        };

        return true;
    }

     $("#descripcion").focus();
});

app.controller('proveedorEdit',function ($scope,$http,kConstant,$window) {

    $scope.cargar_datos = function (id,idEmpresa) {
        $scope.proveedor = [];
        $http.get(kConstant.url+"/proveedores/getEntity/empresa/"+idEmpresa+"/proveedor/"+id)
            .then(function(data){
                $scope.proveedor=data.data.proveedor[0];

            });

    }

    $scope.modificar = function (id) {
        console.log("ID: "+id);
        if($scope.verificar_campos()){
            $http.post(kConstant.url+"proveedores/editEntity/"+id,$scope.proveedor).
            then(function(response){
                $window.location.href = kConstant.url+"proveedores/index";
            },function (response) {

            });
        }
    }


    $scope.verificar_campos = function () {

        if($scope.proveedor==null || $scope.proveedor==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };

        if($scope.proveedor.email==null || $scope.proveedor.email==""){
            toastr.error('El campo email no puede estar vacio.','Notificación!');
            $( "#email" ).focus();
            return false;
        };
        if( ($scope.proveedor.documento==null || $scope.proveedor.documento=="") && ($scope.proveedor.ruc==null || $scope.proveedor.ruc=="")){
            toastr.error('Debes completar al menos un documento.','Notificación!');
            $( "#cedula" ).focus();
            return false;
        };


        return true;
    }
});
