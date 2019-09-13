/**
 * Created by jorge on 09/11/17.
 */
var app = angular.module('contalapp');
app.controller('inscripcionIndex',function ($scope,kConstant,$http,$window,$filter,$timeout,usuariosByTerm,inscripcionesByTerm) {

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


    $scope.inscripcion='';
    $scope.inscripciones = function(usuarioValue){
        console.log(usuarioValue);
        var futureEmpresas = inscripcionesByTerm.async(usuarioValue);
        return futureEmpresas.then(function (response){
            return response.data.inscripciones;
        });
    };

    $scope.onSelect = function ($label,$model) {
        var id =$model.id
        $window.location.href = kConstant.url+"inscripciones/edit/"+id;
    }


    $scope.obtener_entity = function (id) {
        $window.location.href = kConstant.url+"inscripciones/edit/"+id;
    }

    $scope.agregar_entity = function () {
        $window.location.href = kConstant.url+"inscripciones/add/";
    }


    $scope.ver_entity = function (id) {
        $window.location.href = kConstant.url+"inscripciones/view/"+id;
    }


    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"inscripciones/index";
    }

    $scope.volver = function () {
        $window.location.href = kConstant.url+"pages/home";
    }


    $scope.openBondi = function(){
        $("#form-bondi").modal();
    }


    $scope.openColectivo = function(){
        $scope.openBondi();
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
            $http.post(kConstant.url+"inscripciones/deleteEntity/"+id).
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

app.controller('inscripcionAdd',function($scope,kConstant,$http,$window,personasByTerm,lugaresByTerm,$timeout){

    String.prototype.replaceAll = function(str1, str2, ignore)
    {
        return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
    }

    $scope.inscripcion = {
        pago:0,
        deuda:0
    }
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
    $('#fechai').val($scope.formatDateDMY(date));

    $scope.amarillo_menor = 0;
    $scope.amarillo_menor_fem = 0;
    $scope.amarillo_mayor = 0;
    $scope.amarillo_masculino_total = 0;
    $scope.rojo_masculino_total = 0;
    $scope.verde_masculino_total = 0;
    $scope.azul_masculino_total = 0;

    $scope.amarillo_fem_total = 0;
    $scope.rojo_fem_total = 0;
    $scope.verde_fem_total = 0;
    $scope.azul_fem_total = 0;

    $scope.amarillo_mayor_fem = 0;
    $scope.rojo_menor = 0;
    $scope.rojo_menor_fem = 0;
    $scope.rojo_mayor = 0;
    $scope.rojo_mayor_fem = 0;
    $scope.verde_menor = 0;
    $scope.verde_menor_fem = 0;
    $scope.verde_mayor = 0;
    $scope.verde_mayor_fem = 0;
    $scope.azul_menor = 0;
    $scope.azul_menor_fem = 0;
    $scope.azul_mayor = 0;
    $scope.azul_mayor_fem = 0;
    $scope.verInscripciones = function(){
        $http.get(kConstant.url + "inscripciones/getInscriptos/").then(function (response) {

            $scope.amarillo_mayor = response.data.resultado[0].amarillo.masculino.mayor;
            $scope.amarillo_menor = response.data.resultado[0].amarillo.masculino.menor;
            $scope.amarillo_menor_fem = response.data.resultado[0].amarillo.femenino.menor;
            $scope.amarillo_mayor_fem = response.data.resultado[0].amarillo.femenino.mayor;

            $scope.azul_mayor = response.data.resultado[0].azul.masculino.mayor;
            $scope.azul_menor = response.data.resultado[0].azul.masculino.menor;
            $scope.azul_menor_fem = response.data.resultado[0].azul.femenino.menor;
            $scope.azul_mayor_fem = response.data.resultado[0].azul.femenino.mayor;

            $scope.verde_mayor = response.data.resultado[0].verde.masculino.mayor;
            $scope.verde_menor = response.data.resultado[0].verde.masculino.menor;
            $scope.verde_menor_fem = response.data.resultado[0].verde.femenino.menor;
            $scope.verde_mayor_fem = response.data.resultado[0].verde.femenino.mayor;

            $scope.rojo_mayor = response.data.resultado[0].rojo.masculino.mayor;
            $scope.rojo_menor = response.data.resultado[0].rojo.masculino.menor;
            $scope.rojo_menor_fem = response.data.resultado[0].rojo.femenino.menor;
            $scope.rojo_mayor_fem = response.data.resultado[0].rojo.femenino.mayor;

        }, function (response) {

        });
    }

    $scope.verInscripciones();

    $scope.guardar = function (){

        if($scope.verificar_campos()){
            $scope.inscripcion.estado=1;
            $scope.inscripcion.id_persona = $scope.persona.id;
            var fecha = $("#fecha").val();
            fecha = fecha.split("/");
            fecha = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
            $scope.inscripcion.fecha = fecha;
            $scope.inscripcion.id_lugar = $scope.lugar.id;
            $scope.inscripcion.categoria = $("#categoria").val();
            $scope.inscripcion.moneda = $("#moneda").val();
            $scope.inscripcion.ficha_medica = $("#ficha").val();
            $scope.inscripcion.color = $("#color").val();
            console.log($scope.inscripcion);
            $http.post(kConstant.url+"inscripciones/addEntity/",$scope.inscripcion).
            then(function(response){
                $window.location.href = kConstant.url+"inscripciones/index";
            },function (response) {

            });
        }
    }

    /*$scope.calcularDeuda = function(){
        var pago = $scope.inscripcion.pago;
        pago = pago.replaceAll(".","");
        var deuda = $scope.inscripcion.deuda;
        deuda = deuda.replaceAll(".","");

        if(pago>deuda){
            toastr.error('El pago no puede ser mayor a la deuda.','Notificación!');
            setTimeout(function(){ $( "#pago" ).focus(); }, 500);
            return;
        }

        var resultado = deuda - pago;
        $scope.inscripcion.deuda = numeral(resultado).format('0,0.[00]');
        $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll(".","_");
        $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll(",",".");
        $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll("_",",");
    }*/

    $scope.calcularDeuda = function(){
        var pago = $scope.inscripcion.pago;
        pago = Number(pago.replaceAll(".",""));
        var deuda = Number($scope.deuda);

        if(pago>deuda){
            toastr.error('El pago no puede ser mayor a la deuda.','Notificación!');
            setTimeout(function(){
                $scope.inscripcion.pago = 0;
                $( "#pago" ).focus(); }, 500);
            return;
        }

        var resultado = deuda - pago;
        $scope.inscripcion.deuda = numeral(resultado).format('0,0.[00]');
        $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll(".","_");
        $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll(",",".");
        $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll("_",",");
    }




    $scope.persona='';
    $scope.personas = function(value){
        var future = personasByTerm.async(value);
        return future.then(function (response){
            return response.data.personas;
        });
    };

    $scope.onSelect = function ($item,$model,$label) {
        console.log($model);
        if($model.id=="00"){
            $("#form-part").modal();
            setTimeout(function(){ $( "#descripcioni" ).focus(); }, 500);
            return;
        }
        $("#categoria").val($model.categoria);
        $("#sexo").val($model.sexo);
        $scope.lugar = $model.lugar;
        setTimeout(function(){ $( "#pago" ).focus(); }, 500);

        $http.get(kConstant.url + "eventos/getDeuda/"+$model.categoria).then(function (response) {
            console.log(response.data.deuda);
            $scope.inscripcion.deuda = response.data.deuda;

        }, function (response) {

        });

    }

    $scope.lugar='';
    $scope.lugares = function(value){
        var future = lugaresByTerm.async(value);
        return future.then(function (response){
            return response.data.lugares;
        });
    };

    $scope.onSelectLugar = function ($item,$model,$label) {
        console.log($model);
        if($model.id=="00"){
            $("#form-lugar").modal();
            setTimeout(function(){ $( "#descripcionl" ).focus(); }, 500);
        }
    }

    $scope.openColor = function(){
        $("#form-color").modal();
    }

    $scope.guardarParticipante = function(){
        if($scope.verificar_campos_lugar()) {
            $scope.participante.estado = 1;
            $scope.participante.id_lugar = $scope.lugari.id;
            $scope.participante.sexo = $("#sexoi").val();
            var fecha = $("#fechai").val();
            fecha = fecha.split("/");
            fecha = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
            $scope.participante.fecha_nacimiento = fecha;
            console.log($scope.participante);
            $http.post(kConstant.url + "personas/addEntity/", $scope.participante).then(function (response) {
                console.log(response.data);
                toastr.success('El participante se guardo correctamente.', 'Notificación!');
                $("#form-part").modal('hide');
                $scope.persona = "";
                setTimeout(function(){ $( "#persona" ).focus(); }, 500);

            }, function (response) {

            });
        }

    }

    $scope.verificar_campos_lugar = function () {

        if($scope.participante==null || $scope.participante==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcioni" ).focus();
            return false;
        };

        return true;
    }


    $scope.verificar_campos = function () {

        if($scope.inscripcion==null || $scope.inscripcion==""){
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


        if($("#fecha").val()==null || $("#fecha").val()==""){
            toastr.error('Debes completar la fecha.','Notificación!');
            $( "#fecha" ).focus();
            return false;
        };



        return true;
    }

    $("#persona").focus();
});

app.controller('inscripcionEdit',function ($scope,kConstant,$http,$window,personasByTerm,lugaresByTerm,colectivosByTerm,$timeout){


    String.prototype.replaceAll = function(str1, str2, ignore)
    {
        return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
    }

    $scope.inscripcion = {
        pago:0,
        deuda:0
    }

    $scope.buscar = function(valor) {
        var rex = new RegExp(valor, 'i');
        $('.buscar tr').hide();
        $('.buscar tr').filter(function () {
            return rex.test($(this).text());
        }).show();
    }

    $scope.buscar($("#sexo").val());

    $( "#sexo" ).change(function() {
        $scope.buscar($("#sexo").val());
    });

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
    $('#fechai').val($scope.formatDateDMY(date));

    $scope.amarillo_menor = 0;
    $scope.amarillo_menor_fem = 0;
    $scope.amarillo_mayor = 0;
    $scope.amarillo_masculino_total = 0;
    $scope.rojo_masculino_total = 0;
    $scope.verde_masculino_total = 0;
    $scope.azul_masculino_total = 0;

    $scope.amarillo_fem_total = 0;
    $scope.rojo_fem_total = 0;
    $scope.verde_fem_total = 0;
    $scope.azul_fem_total = 0;

    $scope.amarillo_mayor_fem = 0;
    $scope.rojo_menor = 0;
    $scope.rojo_menor_fem = 0;
    $scope.rojo_mayor = 0;
    $scope.rojo_mayor_fem = 0;
    $scope.verde_menor = 0;
    $scope.verde_menor_fem = 0;
    $scope.verde_mayor = 0;
    $scope.verde_mayor_fem = 0;
    $scope.azul_menor = 0;
    $scope.azul_menor_fem = 0;
    $scope.azul_mayor = 0;
    $scope.azul_mayor_fem = 0;
    $scope.verInscripciones = function(){
        $http.get(kConstant.url + "inscripciones/getInscriptos/").then(function (response) {

            $scope.amarillo_mayor = response.data.resultado[0].amarillo.masculino.mayor;
            $scope.amarillo_menor = response.data.resultado[0].amarillo.masculino.menor;
            $scope.amarillo_menor_fem = response.data.resultado[0].amarillo.femenino.menor;
            $scope.amarillo_mayor_fem = response.data.resultado[0].amarillo.femenino.mayor;

            $scope.azul_mayor = response.data.resultado[0].azul.masculino.mayor;
            $scope.azul_menor = response.data.resultado[0].azul.masculino.menor;
            $scope.azul_menor_fem = response.data.resultado[0].azul.femenino.menor;
            $scope.azul_mayor_fem = response.data.resultado[0].azul.femenino.mayor;

            $scope.verde_mayor = response.data.resultado[0].verde.masculino.mayor;
            $scope.verde_menor = response.data.resultado[0].verde.masculino.menor;
            $scope.verde_menor_fem = response.data.resultado[0].verde.femenino.menor;
            $scope.verde_mayor_fem = response.data.resultado[0].verde.femenino.mayor;

            $scope.rojo_mayor = response.data.resultado[0].rojo.masculino.mayor;
            $scope.rojo_menor = response.data.resultado[0].rojo.masculino.menor;
            $scope.rojo_menor_fem = response.data.resultado[0].rojo.femenino.menor;
            $scope.rojo_mayor_fem = response.data.resultado[0].rojo.femenino.mayor;

        }, function (response) {

        });
    }

    $scope.verInscripciones();

    $scope.mod_pago = 0;
    $scope.deuda = 0;
    $scope.cargar_datos = function (id) {
        $scope.inscripcion = [];
        $http.get(kConstant.url+"/inscripciones/getEntity/"+id)
            .then(function(data){
                console.log(data.data);
                $scope.inscripcion=data.data.inscripcion[0];
                $scope.persona = data.data.inscripcion[0].persona;
                $("#sexo").val($scope.persona.sexo);
                $scope.colectivo = data.data.inscripcion[0].colectivo;
                $scope.persona.edad = data.data.anhos;
                $scope.lugar = data.data.inscripcion[0].persona.lugare;
                $("#categoria").val($scope.inscripcion.categoria);
                $("#ficha").val($scope.inscripcion.ficha_medica);
                $("#aut").val($scope.inscripcion.autorizacion);
                $("#color").val($scope.inscripcion.color);
                $("#moneda").val($scope.inscripcion.moneda);
                $("#confirmacion").val($scope.inscripcion.estado_inscripcion);
                $("#viaja").val($scope.inscripcion.viaja);
                $scope.mod_pago = $scope.inscripcion.pago;
                $scope.deuda = $scope.inscripcion.deuda;
                var fecha = data.data.inscripcion[0].fecha;
                fecha = fecha.substring(0,10);
                fecha = fecha.split('-');
                $("#fecha").val(fecha[2]+"/"+fecha[1]+"/"+fecha[0]);
                $scope.inscripcion.pago = numeral($scope.inscripcion.pago).format('0,0.[00]');
                $scope.inscripcion.pago = $scope.inscripcion.pago.replaceAll(".","_");
                $scope.inscripcion.pago = $scope.inscripcion.pago.replaceAll(",",".");
                $scope.inscripcion.pago = $scope.inscripcion.pago.replaceAll("_",",");

                $scope.inscripcion.deuda = numeral($scope.inscripcion.deuda).format('0,0.[00]');
                $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll(".","_");
                $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll(",",".");
                $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll("_",",");
                $scope.buscar($("#sexo").val());
                //$scope.obtenerDeuda();
            });

    }

    $scope.modificar = function (id) {
        delete $scope.inscripcion.persona;
        delete $scope.inscripcion.colectivo;
        $scope.inscripcion.estado=1;
        $scope.inscripcion.id_persona = $scope.persona.id;
        var fecha = $("#fecha").val();
        fecha = fecha.split("/");
        fecha = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
        $scope.inscripcion.fecha = fecha;
        $scope.inscripcion.id_lugar = $scope.lugar.id;
        $scope.inscripcion.categoria = $("#categoria").val();
        $scope.inscripcion.moneda = $("#moneda").val();
        $scope.inscripcion.ficha_medica = $("#ficha").val();
        $scope.inscripcion.autorizacion = $("#aut").val();
        $scope.inscripcion.color = $("#color").val();
        $scope.inscripcion.viaja = $("#viaja").val();
        $scope.inscripcion.estado_inscripcion = $("#confirmacion").val();

        if($scope.colectivo!=null){
            $scope.inscripcion.id_colectivo = $scope.colectivo.id;
        }


        console.log($scope.inscripcion);
        if($scope.verificar_campos()){
            $http.post(kConstant.url+"inscripciones/editEntityLastInscripcion/"+id,$scope.inscripcion).
            then(function(response){
                console.log(response.data);
                $window.location.href = kConstant.url+"inscripciones/index";
            },function (response) {

            });
        }
    }

    $scope.estadoVehiculo = "";

    /*$scope.calcularDeuda = function(){
        var mod_pago = Number($scope.mod_pago);

        var pago = $scope.inscripcion.pago;
        pago = Number(pago.replaceAll(".",""));

        var deuda = Number($scope.deuda);

        var pago_actual = Number(pago);

        if(mod_pago == pago_actual){

        }else{

            if(pago>deuda){
                toastr.error('El pago no puede ser mayor a la deuda.','Notificación!');
                setTimeout(function(){ $( "#pago" ).focus(); }, 500);
                return;
            }

            var resultado = deuda - pago;
            $scope.inscripcion.deuda = numeral(resultado).format('0,0.[00]');
            $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll(".","_");
            $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll(",",".");
            $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll("_",",");
        }


    }*/

    $scope.calcularDeuda = function(){
        var pago = $scope.inscripcion.pago;
        pago = Number(pago.replaceAll(".",""));
        var deuda = Number($scope.deuda);

        if(pago>deuda){
            toastr.error('El pago no puede ser mayor a la deuda.','Notificación!');
            setTimeout(function(){
                $scope.inscripcion.pago = 0;
                $( "#pago" ).focus(); }, 500);
            return;
        }

        var resultado = deuda - pago;
        $scope.inscripcion.deuda = numeral(resultado).format('0,0.[00]');
        $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll(".","_");
        $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll(",",".");
        $scope.inscripcion.deuda = $scope.inscripcion.deuda.replaceAll("_",",");
    }



    $scope.persona='';
    $scope.personas = function(value){
        var future = personasByTerm.async(value);
        return future.then(function (response){
            return response.data.personas;
        });
    };

    $scope.deuda = 0;
    $scope.onSelect = function ($item,$model,$label) {
        console.log($model);
        if($model.id=="00"){
            $("#form-part").modal();
            setTimeout(function(){ $( "#descripcioni" ).focus(); }, 500);
            return;
        }
        $("#categoria").val($model.categoria);
        $("#sexo").val($model.sexo);
        $scope.buscar($("#sexo").val());
        $scope.lugar = $model.lugar;
        setTimeout(function(){ $( "#pago" ).focus(); }, 500);

        var categoria = $( "#categoria" ).val();
        $scope.obtenerDeuda(categoria);

    }


    $( "#categoria" ).change(function() {
        var categoria = $( "#categoria" ).val();
        $scope.obtenerDeuda(categoria);
    });

    $( "#viaja" ).change(function() {
        var categoria = $( "#categoria" ).val();
        $scope.obtenerDeuda(categoria);
    });


    $scope.obtenerDeuda = function(categoria){
        var viaja = $("#viaja").val();
        $http.get(kConstant.url + "eventos/getDeuda/"+categoria+"/"+viaja).then(function (response) {
            console.log("DEUDA: "+response.data.deuda);
            $scope.inscripcion.deuda = response.data.deuda;
            var deuda = response.data.deuda;
            deuda = deuda.replaceAll(".","");
            $scope.deuda = deuda;
            $scope.calcularDeuda();


        }, function (response) {

        });
    }


    $scope.lugar='';
    $scope.lugares = function(value){
        var future = lugaresByTerm.async(value);
        return future.then(function (response){
            return response.data.lugares;
        });
    };

    $scope.onSelectLugar = function ($item,$model,$label) {
        console.log($model);

        if($model.id=="00"){
            $("#form-lugar").modal();
            setTimeout(function(){ $( "#descripcionl" ).focus(); }, 500);
        }
    }



    $scope.colectivo='';
    $scope.colectivos = function(value){
        var future = colectivosByTerm.async(value);
        return future.then(function (response){
            return response.data.colectivos;
        });
    };

    $scope.onSelectColectivo = function ($item,$model,$label) {
        $scope.estadoVehiculo = "";
        if($("#sexo").val()=="masculino"){
            if($model.sexo=="femenino"){
                $scope.estadoVehiculo = "Este vehiculo pertenece a la categoria Femenino";
            }
        }

        if($("#sexo").val()=="femenino"){
            if($model.sexo=="masculino"){
                $scope.estadoVehiculo = "Este vehiculo pertenece a la categoria Masculino";
            }
        }

        var total_lugar = new Number($model.lugar) - (new Number($model.ocupado) + 1 );
        if(total_lugar<0){
            swal("Aviso!", "El colectivo no esta disponible. Esta lleno.\nLugares Disponibles: "+$model.lugar+"\nLugares Ocupados: "+(new Number($model.ocupado)), "warning");
        }
           console.log($model);
    }

    $scope.openColor = function(){
        $("#form-color").modal();
    }

    $scope.openBondi = function(){
        $("#form-bondi").modal();
    }

    $scope.guardarParticipante = function(){
        if($scope.verificar_campos_lugar()) {
            $scope.participante.estado = 1;
            $scope.participante.id_lugar = $scope.lugari.id;
            $scope.participante.sexo = $("#sexoi").val();
            var fecha = $("#fechai").val();
            fecha = fecha.split("/");
            fecha = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
            $scope.participante.fecha_nacimiento = fecha;
            console.log($scope.participante);
            $http.post(kConstant.url + "personas/addEntity/", $scope.participante).then(function (response) {
                console.log(response.data);
                toastr.success('El participante se guardo correctamente.', 'Notificación!');
                $("#form-part").modal('hide');
                $scope.persona = "";
                setTimeout(function(){ $( "#persona" ).focus(); }, 500);

            }, function (response) {

            });
        }

    }

    $scope.verificar_campos_lugar = function () {

        if($scope.participante==null || $scope.participante==""){
            toastr.error('Debes completar correctamente los datos.','Notificación!');
            $( "#descripcioni" ).focus();
            return false;
        };

        return true;
    }


    $scope.verificar_campos = function () {

        var estado_ins =  $("#confirmacion").val();

        if(estado_ins=='confirmado'){


            var cate =  $("#categoria").val();
            var viaja =  $("#viaja").val();

            if($scope.inscripcion==null || $scope.inscripcion==""){
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


            if($("#fecha").val()==null || $("#fecha").val()==""){
                toastr.error('Debes completar la fecha.','Notificación!');
                $( "#fecha" ).focus();
                return false;
            };

            if($("#ficha").val()=="pendiente" || $("#ficha").val()=="pendiente"){
                toastr.error('Debes completar la ficha medica.','Notificación!');
                $( "#ficha" ).focus();
                return false;
            };

            if($("#aut").val()=="pendiente" || $("#aut").val()=="pendiente"){
                toastr.error('Debes completar la autorizacion.','Notificación!');
                $( "#aut" ).focus();
                return false;
            };

            if(cate=='participante'){
                if($("#color").val()=="sin_definir" || $("#color").val()=="sin_definir"){
                    toastr.error('Debes elegir un equipo.','Notificación!');
                    $( "#color" ).focus();
                    return false;
                };
            }


            if($scope.inscripcion.responsable_tel==null || $scope.inscripcion.responsable_tel==""){
                toastr.error('Debes completar el Nro. de contacto del responsable.','Notificación!');
                $( "#responsable_tel" ).focus();
                return false;
            };

            if(viaja=='si'){
                if($scope.colectivo==null || $scope.colectivo==""){
                    toastr.error('Debes ingresar el colectivo.','Notificación!');
                    $( "#colectivo" ).focus();
                    return false;
                };

                if($scope.colectivo.descripcion==null || $scope.colectivo.descripcion==""){
                    toastr.error('Debes ingresar el colectivo.','Notificación!');
                    $( "#colectivo" ).focus();
                    return false;
                };
            }



        }

        return true;
    }

    $("#persona").focus();
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


