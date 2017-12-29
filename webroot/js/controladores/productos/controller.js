/**
 * Created by jorge on 12/28/16.
 */
var app = angular.module('contalapp');

app.controller('productoIndex',function ($scope,kConstant,$http,$window,$filter,$timeout,productosMeByTerm) {

     $scope.productos = [];
     $scope.getProductos = function (idEmpresa) {

         $http.get(kConstant.url+"/productos/getEntityAll/empresa/"+idEmpresa)
             .then(function(data){
                 $scope.productos=data.data.productos;
                 console.log(data.data.productos);


             });
     }

    $scope.getIngrediente = function(id){
        $scope.detalleIngredientes = [];
        $http.get(kConstant.url+"/productos/getProductoForIngrediente/"+id)
        .then(function(data){
            $scope.detalleIngredientes = data.data.producto[0].ingredientes[0].detalle_ingredientes;
            $("#form-ingrediente").modal();
        });
    }
    $scope.obtener_entity = function (id) {
         $window.location.href = kConstant.url+"productos/edit/"+id;
    }

    $scope.agregar_entity = function () {
        $window.location.href = kConstant.url+"productos/add/";
    }

    $scope.ver_entity = function (id) {
        $window.location.href = kConstant.url+"productos/view/"+id;
    }

    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"productos/index";
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
            $http.post(kConstant.url+"productos/deleteEntity/"+id).
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

    $scope.producto='';
    $scope.productos = function(productoValue){
      // console.log(productoValue);
        var futureEmpresas = productosMeByTerm.async(productoValue);
        return futureEmpresas.then(function (response){
            return response.data.productos;
        });
    };

    $scope.onSelect = function ($item,$model,$labels) {
        var id = $model.id;
        $window.location.href = kConstant.url+"productos/view/"+id;
    }

    $("#buscar").focus();
    
});

app.controller('productoUpload',function ($scope,kConstant,$http,$window,$filter,$timeout,productosByTerm) {

    $scope.producto='';
    $scope.productos = function(productoValue){
        var futureEmpresas = productosByTerm.async(productoValue);
        return futureEmpresas.then(function (response){
            return response.data.productos;
        });
    };

    $scope.buscar = function(descripcion){
       $http.get(kConstant.url+"productos/buscarGrilla/"+descripcion)
            .then(function(data){
              console.log(data.data.resultado);
              $( "#result" ).load(kConstant.url+"ajax/productos.php",{productos:data.data.resultado});
            });
    }

    
    $scope.onSelect = function ($label) {
        console.log('seek...'+$label);
        $scope.buscar($label);
    }

    $scope.foto = function () {
        alert('foto');
    }

    $scope.buscar("");
});  
app.controller('productoAdd',function($scope,kConstant,$http,$window){

   
   $scope.detalleIngredientes=[];

   $('.deta').hide();
   $( "#tipo_producto" ).change(function() {
         var elemento = $("#tipo_producto").val();
         if(elemento=="menu"){
            $('.deta').show();
         }else{
            $('.deta').hide();
            $scope.ingredientes=[];
            $scope.detalleIngredientes=[];
         }
         
  });
   $scope.openModel = function(){
       $("#form-permiso").modal();
   }
  
   $scope.agregarIngrediente = function(){
        var flagRepetido=0;
        var ingrediente_id = $("#ingrediente").val();

        if($("#cantidad").val()==""){
            toastr.error("Debes ingresar la cantidad.");
            $("#cantidad").focus();
        }else{

            if($scope.detalleIngredientes.length>0){
                for(var i=0;$scope.detalleIngredientes.length>i;i++){
                   if(ingrediente_id==$scope.detalleIngredientes[i].id_producto){
                     flagRepetido=1;
                   }
                }
              }
    
              if(flagRepetido==1){
                flagRepetido=0;
                toastr.error('Ya existe un ingrediente en la lista.','Notificación!');
                $("#ingrediente").focus();
              }else{

                var detalle = {
                    id:0,
                    id_producto:$("#ingrediente").val(),
                    producto:{
                     descripcion:$("#ingrediente :selected").text()
                    },
                    unidad_medida:$("#unidad").val(),
                    cantidad:$("#cantidad").val(),
                    estado:1
                }
                $scope.detalleIngredientes.push(detalle);
                $("#cantidad").val("");
                $("#ingrediente").focus();

              }

        }

   }
  
   $scope.cancelarIngrediente = function(){
       // $scope.ingredientes=[];
        $scope.detalleIngredientes=[];
   }

  
   $scope.removeRow= function(id){
    var index = -1;
    var comArr = eval( $scope.detalleIngredientes);
    for( var i = 0; i < comArr.length; i++ ) {
        if( comArr[i].id_producto === id) {
            index = i;
            break;
        }
    }
    $scope.detalleIngredientes.splice( index, 1 );

}

   $scope.verificar_campos = function () {

        if($("#descripcion").val()==""){
            toastr.error('Debes ingresar la descripcion del producto.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        }


        if($("#precioventa").val()==""){
            toastr.error('Debes ingresar el precio de venta.','Notificación!');
            $( "#precioventa" ).focus();
            return false;
        }

        return true;
    }
         
      var hoy = new Date();
      $scope.guardar = function (){

        if($scope.verificar_campos()){
            var codigo_interno = $("#codigointerno").val();
           if(codigo_interno==""){
              codigo_interno=0;
           }
           var informacion = $("#info").val();
           var id_empresa = $("#empresa").val();
           var iva = $("#ivaprod").val();
           var precio_costo = $("#preciocosto").val();
           precio_costo = (precio_costo || '').split('.').join('');
           if(precio_costo==""){
              precio_costo=0;
           }
           var precio_venta = $("#precioventa").val();
           precio_venta = (precio_venta || '').split('.').join('');
           var precio_medio = $("#preciomedio").val();
           precio_medio = (precio_medio || '').split('.').join('');
           if(precio_medio==""){
              precio_medio=0;
           }
           var stock_minimo = $("#stockminimo").val();
           stock_minimo = (stock_minimo || '').split('.').join('');
           if(stock_minimo==""){
              stock_minimo=0;
           }
           var tipo_producto =$("#tipo_producto").val();

           var contador = eval( $scope.detalleIngredientes);
           if(contador.length>0){
               // $scope.ingredientes.detalle_ingredientes = ;    
                $scope.ingredientes=[{
                    id:0,
                    descripcion:$("#descripcion").val(),
                    estado:1,
                    detalle_ingredientes:$scope.detalleIngredientes
            }];

           }
    
            $scope.producto.codigo_interno=codigo_interno;
            $scope.producto.informacion = informacion;
            $scope.producto.descripcion = $("#descripcion").val();
            $scope.producto.id_empresa=id_empresa;
            $scope.producto.iva=iva;
            $scope.producto.precio_costo=precio_costo;
            $scope.producto.precio_venta=precio_venta;
            $scope.producto.precio_medio=precio_medio;
            $scope.producto.stock_minimo=stock_minimo;
            $scope.producto.tipo_producto=tipo_producto;
            $scope.producto.id_categoria=$("#categoria").val();
            $scope.producto.unidad_medida=$("#unidad_medida").val();
            $scope.producto.estado=1;
            $scope.producto.ingredientes=$scope.ingredientes;
            console.log($scope.producto);
            $http.post(kConstant.url+"productos/addEntity",$scope.producto).
            then(function(response){
              if(response.data.mensaje="ok"){
                $window.location.href = kConstant.url+"productos/index";
              }else{
                toastr.error('No se puedieron guardar los datos.','Notificación!');
              }
                           
            },function (response) {
                console.log(response);
            });
       }
    }

    $("#codigointerno").focus();

});

app.controller('productoEdit',function ($scope,$http,kConstant,$window,$timeout) {

    $scope.listar_entity = function () {
        $window.location.href = kConstant.url+"productos/index/";
    }

    $scope.openModel = function(){
        $("#form-permiso").modal();
    }

    $scope.cargar_datos = function (id,idEmpresa) {
        $scope.producto = [];
        $scope.detalleIngredientes = [];
            
        $http.get(kConstant.url+"/productos/getEntity/empresa/"+idEmpresa+"/producto/"+id)
            .then(function(data){

                if(data.data.producto[0]==null || data.data.producto[0]==""){

                    toastr.error('El dato no existe.','Notificación!');
                    $timeout(function () {
                        $scope.listar_entity();
                    }, 1500);

                }else{
                    $scope.producto=data.data.producto[0];
                    $("#codigointerno").val($scope.producto.codigo_interno);
                    $("#info").val($scope.producto.informacion);
                    $("#ivaprod").val($scope.producto.iva);
                    var precio_costo = numeral($scope.producto.precio_costo).format('0,0');
                    precio_costo = (precio_costo || '').split(',').join('.');
                    var precio_venta = numeral($scope.producto.precio_venta).format('0,0');
                    precio_venta = (precio_venta || '').split(',').join('.');
                    var precio_medio = numeral($scope.producto.precio_medio).format('0,0');
                    precio_medio = (precio_medio || '').split(',').join('.');
                    var stock_minimo = numeral($scope.producto.stock_minimo).format('0,0');
                    stock_minimo = (stock_minimo || '').split(',').join('.');
                    $("#preciocosto").val(precio_costo);
                    $("#precioventa").val(precio_venta);
                    $("#preciomedio").val(precio_medio);
                    $("#stockminimo").val(stock_minimo);
                    $("#tipo_producto").val(data.data.producto[0].tipo_producto);
                    $("#categoria").val(data.data.producto[0].id_categoria);
                    $("#unidad_medida").val(data.data.producto[0].unidad_medida);

                    if(data.data.producto[0].tipo_producto=="menu"){
                        $('.deta').show();
                    }else{
                        $('.deta').hide();
                    }
                    console.log(data.data.producto[0].ingredientes[0]);
                   // $("#controlar").prop("selectedIndex", $scope.producto.controlar_stock);
                   //$("#controlar").val($scope.producto.controlar_stock);
                    if(data.data.producto[0].ingredientes!=""){
                        $scope.ingredientes=data.data.producto[0].ingredientes;
                        $scope.producto.ingredientes = $scope.ingredientes;

                        if(data.data.producto[0].ingredientes[0].detalle_ingredientes!=""){
                            $scope.detalleIngredientes = data.data.producto[0].ingredientes[0].detalle_ingredientes;
                            console.log(data.data.producto[0].ingredientes[0].detalle_ingredientes);
                        }
                    }
                   
     
                }

            });

      }

      $scope.agregarIngrediente = function(){
       
        var flagRepetido=0;
        var ingrediente_id = $("#ingrediente").val();

        if($("#cantidad").val()==""){
            toastr.error("Debes ingresar la cantidad.");
            $("#cantidad").focus();
        }else{

            if($scope.detalleIngredientes.length>0){
                for(var i=0;$scope.detalleIngredientes.length>i;i++){
                   if(ingrediente_id==$scope.detalleIngredientes[i].id_producto){
                     flagRepetido=1;
                   }
                }
              }
    
              if(flagRepetido==1){
                flagRepetido=0;
                toastr.error('Ya existe un ingrediente en la lista.','Notificación!');
                $("#ingrediente").focus();
              }else{

                var detalle = {
                    id:0,
                    id_producto:$("#ingrediente").val(),
                    producto:{
                     descripcion:$("#ingrediente :selected").text()
                    },
                    unidad_medida:$("#unidad").val(),
                    cantidad:$("#cantidad").val(),
                    estado:1
                }
                $scope.detalleIngredientes.push(detalle);
                $("#cantidad").val("");
                $("#ingrediente").focus();

              }

        }

   }

    $scope.removeRow= function(id){
        var index = -1;
        var comArr = eval( $scope.detalleIngredientes);
        for( var i = 0; i < comArr.length; i++ ) {
            if( comArr[i].id_producto === id) {
                index = i;
                break;
            }
        }
            $scope.detalleIngredientes.splice( index, 1 );

        }

      $scope.modificar = function (id) {

          if($scope.verificar_campos()){
               var codigo_interno = $("#codigointerno").val();
           if(codigo_interno==""){
              codigo_interno=0;
           }
           var informacion = $("#info").val();
           var id_empresa = $("#empresa").val();
           var iva = $("#ivaprod").val();
           var precio_costo = $("#preciocosto").val();
           precio_costo = (precio_costo || '').split('.').join('');
           if(precio_costo==""){
              precio_costo=0;
           }
           var precio_venta = $("#precioventa").val();
           precio_venta = (precio_venta || '').split('.').join('');
           var precio_medio = $("#preciomedio").val();
           precio_medio = (precio_medio || '').split('.').join('');
           if(precio_medio==""){
              precio_medio=0;
           }
           var stock_minimo = $("#stockminimo").val();
           stock_minimo = (stock_minimo || '').split('.').join('');
           if(stock_minimo==""){
              stock_minimo=0;
           }
           var tipo_producto =$("#tipo_producto").val();
           
            $scope.producto.codigo_interno=codigo_interno;
            $scope.producto.informacion = informacion;
            $scope.producto.id_empresa=id_empresa;
            $scope.producto.iva=iva;
             $scope.producto.precio_costo=precio_costo;
            $scope.producto.precio_venta=precio_venta;
            $scope.producto.precio_medio=precio_medio;
            $scope.producto.stock_minimo=stock_minimo;
            $scope.producto.tipo_producto=tipo_producto;
            $scope.producto.id_categoria=$("#categoria").val();
            $scope.producto.unidad_medida=$("#unidad_medida").val();
            delete $scope.producto.created;
            delete $scope.producto.modified;
           
            $scope.producto.estado=1;
            var id_ingrediente = 0;
            if($scope.producto.ingredientes[0]!=null){
                id_ingrediente = $scope.producto.ingredientes[0].id;
            }
             
            
            $http.post(kConstant.url+"productos/editEntity/"+id+"/"+id_ingrediente,$scope.producto).
              then(function(response){
                if(response.data.mensaje="ok"){
                       $window.location.href = kConstant.url+"productos/index";
                }else{
                  toastr.error('No se puedieron guardar los datos.','Notificación!');
                }
              },function (response) {
                //console.log(response);
              });
          }
      }


   

    $scope.verificar_campos = function () {

        if($("#descripcion").val()==""){
            toastr.error('Debes ingresar la descripcion del producto.','Notificación!');
            $( "#descripcion" ).focus();
            return false;
        }


        if($("#precioventa").val()==""){
            toastr.error('Debes ingresar el precio de venta.','Notificación!');
            $( "#precioventa" ).focus();
            return false;
        }

        return true;
    }
         
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