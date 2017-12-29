/**
 * Created by jorge on 09/11/17.
 */
//var app = angular.module('contalapp');
app.controller('clienteIndex',function ($scope,kConstant,$http,$window,$filter,$timeout,clientesByTerm) {

   

    $scope.clientes = [];
    $scope.getClientes = function (idEmpresa) {
    $http.get(kConstant.url+"/clientes/getEntityAll/"+idEmpresa)
            .then(function(data){
                $scope.proveedores=data.data.clientes;
                console.log(data.data.clientes);
            });
    }
    $scope.focus_buscar = function(){
        $(".buscador").focus();
    }
    $scope.obtener_entity = function (id) {
        $window.location.href = kConstant.url+"clientes/edit/"+id;
    }
    $scope.agregar_entity = function () {
        $window.location.href = kConstant.url+"clientes/add/";
    }
    $scope.ver_entity = function (id) {
        $window.location.href = kConstant.url+"clientes/view/"+id;
    }
    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"clientes/index";
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
            $http.post(kConstant.url+"clientes/deleteEntity/"+id).
            then(function(response){
                swal("Eliminado!", "El registro se elimino correctamente.", "success");
                $timeout(function () {
                    $scope.listar_entity();
                }, 2000);

            },function (response) {
                console.log(response);
            });

        });
    }

    $scope.cliente='';
    $scope.clientes = function(clienteValue){
        console.log(clienteValue);
        var futureEmpresas = clientesByTerm.async(clienteValue);
        return futureEmpresas.then(function (response){
            //console.log('datos: '+response.data.clientes);
            return response.data.clientes;
        });
    };

    $scope.onSelect = function ($item,$model,$labels) {
        var id = $model.id;
        $window.location.href = kConstant.url+"clientes/view/"+id;
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

app.controller('clienteAdd',function($scope,kConstant,$http,$window){

    var hoy = new Date();
    $scope.cliente={
         "id": 0,
         "descripcion":"",
         "email":"",
         "documento":"",
         "dv":0,
         "descuento":0,
         "telefono":"",
         "direccion":"",
         "estado":1,
         "id_empresa":0
    }
    $scope.guardar = function (){
        //console.log(idEmpresa)
        if($scope.verificar_campos()){
            $scope.cliente.id_empresa = $('#empresa').val();
            $http.post(kConstant.url+"clientes/addEntity",$scope.cliente).
            then(function(response){
                if(response.data.mensaje="ok") {
                    $window.location.href = kConstant.url+"clientes/index";
                }else{
                    toastr.error('No se puedieron guardar los datos.','Notificación!');
                }

            },function (response) {

            });
        }
    }
    $scope.verificar_campos = function () {
        console.log($scope.cliente);
        if($scope.cliente==null || $scope.cliente==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#email" ).focus();
            return false;
        };
        if($scope.cliente.email==null || $scope.cliente.email==""){
            toastr.error('El campo email no puede estar vacio.','Notificación!');
            $( "#email" ).focus();
            return false;
        };
        if($scope.cliente.documento==null || $scope.cliente.documento==""){
            toastr.error('El campo Documento no puede estar vacio.','Notificación!');
            $( "#cedula" ).focus();
            return false;
        };
        

        if($scope.cliente.telefono==null || $scope.cliente.telefono==""){
            toastr.error('El campo telefono no puede estar vacio..','Notificación!');
            $( "#telefono" ).focus();
            return false;
        };
         return true;
    }

    $("#descripcion").focus();
});

app.controller('clienteEdit',function ($scope,$http,kConstant,$window) {

    $scope.cargar_datos = function (id,idEmpresa) {
        $scope.cliente = [];
        $http.get(kConstant.url+"/clientes/getEntity/empresa/"+idEmpresa+"/cliente/"+id)
            .then(function(data){
                $scope.cliente=data.data.cliente[0];
            });
    }
    $scope.modificar = function (id) {
        console.log("ID: "+id);
        if($scope.verificar_campos()){
            $http.post(kConstant.url+"clientes/editEntity/"+id,$scope.cliente).
            then(function(response){
                $window.location.href = kConstant.url+"clientes/index";
            },function (response) {

            });
        }
    }
    $scope.verificar_campos = function () {
        if($scope.cliente==null || $scope.cliente==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        };
        if($scope.cliente.email==null || $scope.cliente.email==""){
            toastr.error('El campo email no puede estar vacio.','Notificación!');
            $( "#email" ).focus();
            return false;
        };
        if( ($scope.cliente.documento==null || $scope.cliente.documento=="") && ($scope.cliente.ruc==null || $scope.cliente.ruc=="")){
            toastr.error('Debes completar al menos un documento.','Notificación!');
            $( "#cedula" ).focus();
            return false;
        };
        return true;
    }
});
