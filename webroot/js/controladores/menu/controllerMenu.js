/**
 * Created by jorge on 09/11/17.
 */

var app = angular.module('contalapp');
app.controller('menuIndex',function ($scope,kConstant,$http,$window,$filter,$timeout) {

    $scope.formatDate = function(date) {

        var d = new Date(date || Date.now()),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year,month,day].join('-');
    }

    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"tiposCambios/index/";
    }

    $scope.cargarTipoCambio = function (idEmpresa) {
        //http://www.cambioschaco.com.py/api/branch_office/1/exchange
        //verificar si ya existe el tc del dia
        $http.post(kConstant.url+"tiposCambios/existExchange/empresa/"+idEmpresa).
        then(function(response){

            if(response.data.mensaje==0){
                console.log('agregar tipo de cambio.');
                var hoy = new Date();

                $scope.detalles = [];
                var id_moneda = 0;
                var compra = 0;
                var venta = 0;

                $http.post("http://www.cambioschaco.com.py/api/branch_office/1/exchange").
                then(function(response){

                    for(var i=0;i<(response.data.items).length;i++){

                        if(response.data.items[i].isoCode=="BRL" || response.data.items[i].isoCode=="EUR" || response.data.items[i].isoCode=="USD" || response.data.items[i].isoCode=="ARS"){

                            if(response.data.items[i].isoCode=="BRL"){

                                var moneda = {
                                    id_moneda:2,
                                    compra:response.data.items[i].purchasePrice,
                                    venta:response.data.items[i].salePrice
                                }

                                $scope.detalles.push(moneda);

                            }

                            if(response.data.items[i].isoCode=="EUR"){

                                var moneda = {
                                    id_moneda:4,
                                    compra:response.data.items[i].purchasePrice,
                                    venta:response.data.items[i].salePrice
                                }

                                $scope.detalles.push(moneda);

                            }

                            if(response.data.items[i].isoCode=="USD"){

                                var moneda = {
                                    id_moneda:1,
                                    compra:response.data.items[i].purchasePrice,
                                    venta:response.data.items[i].salePrice
                                }

                                $scope.detalles.push(moneda);

                            }

                            if(response.data.items[i].isoCode=="ARS"){

                                var moneda = {
                                    id_moneda:3,
                                    compra:response.data.items[i].purchasePrice,
                                    venta:response.data.items[i].salePrice
                                }

                                $scope.detalles.push(moneda);

                            }


                            console.log(response.data.items[i]);
                        }
                    }

                    var tipocambio = {

                        id_empresa:idEmpresa,
                        fecha: $scope.formatDate(hoy),
                        estado:true,
                        detalles:$scope.detalles

                    };
                    $('#resultado').html("Buscando...");
                    $('#myimage').attr('src','img/loader_01.gif');

                    $http.post(kConstant.url+"tiposCambios/addEntityAuto",tipocambio).
                     then(function(response){
                     console.log(response);
                     $('#resultado').html("EL tipo de cambio se registro correctamente.");
                     $('#myimage').attr('src','img/bien.png');

                     $timeout(function () {
                            $scope.listar_entity();
                     }, 1500);
                     },function (response) {
                     console.log(response);
                     });

                },function (response) {

                });

            }else{
                console.log('tipo de cambio ya existe.');
                $('#resultado').html("EL tipo de cambio ya fue registrado.");
                $('#myimage').attr('src','img/bien.png');
            }

        });
    }




});