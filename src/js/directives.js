(function(){

    angular.module('bp.directives', [])
        .directive('bpNavEjercicios', function(){
            return {
                //Hay varios tipos de directivas, está será de tipo elemento.
                restrict: 'E',
                templateUrl: 'partials/bp-nav-ejercicios.html',
                controller: 'bpController'
            };
        })
        .directive('bpNavOperaciones', function(){
            return {
                //Hay varios tipos de directivas, está será de tipo elemento.
                restrict: 'E',
                templateUrl: 'partials/bp-nav-operaciones.html',
                controller: 'bpController'
            };
        })
        .directive('bpNavMeses', function(){
            return {
                restrict: 'E',
                templateUrl: 'partials/bp-nav-meses.html',
                controller: 'bpController'
            };
        });
})();
