/**
 * Created by jorge on 09/11/17.
 */
var app = angular.module('contalapp', ['ui.bootstrap']);

app.filter('startFrom', function () {
    return function (input, start) {
        if (input) {
            start = +start;
            return input.slice(start);
        }
        return [];
    };
}).constant("kConstant",{
    //"url":"http://localhost/restorapp/",
    //"base":"/restorapp/"
    //http://174.138.53.240/
    "url":"http://174.138.53.240/restorApp/",
    "base":"/"

}).service('usuariosByTerm',function($http,kConstant,$rootScope){
    return {
        async:function(term){
            return $http.get(kConstant.url+"/usuarios/getEntityUsuarioAllByTerm/"+term);
        }
    }
}).service('empresasByTerm',function($http,kConstant,$rootScope){
    return {
        async:function(term){
            return $http.get(kConstant.url+"/empresas/getEntityAllByTerm/"+term);
        }
    }

}).service('clientesByTerm',function($http,kConstant,$rootScope){
    return {
        async:function(term){
            return $http.get(kConstant.url+"/clientes/getEntityAllByTerm/"+term);
        }
    }

}).service('perfilByTerm',function($http,kConstant,$rootScope){
    return {
        async:function(term){
            return $http.get(kConstant.url+"perfil/getEntityAllPerfilByTerm/"+term);
        }
    }

}).service('proveedoresByTerm',function($http,kConstant,$rootScope){
    return {
        async:function(term){
            return $http.get(kConstant.url+"/proveedores/getEntityAllByTerm/"+term);
        }
    }
}).service('camarerosByTerm',function($http,kConstant,$rootScope){
    return {
        async:function(term){
            return $http.get(kConstant.url+"/camareros/getEntityAllByTerm/"+term);
        }
    }
}).service('productosByTerm',function($http,kConstant,$rootScope){
    return {
        async:function(term){
            return $http.get(kConstant.url+"/productos/getEntityAllByTerm/"+term);
        }
    }
});