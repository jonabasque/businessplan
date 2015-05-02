(function(){
    var app = angular.module('BusinessPlans', [
        'ngRoute',
        'bp.controllers',
        'bp.directives',
        'bp.filters',
        'bp.services'
    ]);


    app.config(['$routeProvider', function($routeProvider){

        $routeProvider
            .when('/', {
                templateUrl: 'views/bp-mini.html',
                //TODO: que se vea la grande en resoluciones grandes, quizás con un metodo por default en el controlador, o con tempales dinamicos.
                controller: 'bpController'
            });
    }]);



})();
