(function(){
    angular.module('bp.controllers', [])
        .controller('bpController', ['$scope', '$routeParams',function($scope, $routeParams){
            $scope.movimiento = true;

            $scope.bp = {
                titulo : "ASkeTIC Coop",
                ejercicios : ['2015','2016','2017'],
                operations : [{id:'Inversiones',source:'images/inversiones.png'},
                              {id:'Ventas',source:'images/ventas.png'},
                              {id: 'Compras',source:'images/compras.png'},
                              {id: 'Gastos',source:'images/gastos.png'},
                              {id: 'RRHH',source:'images/rrhh.png'}],
                meses : ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE']
            };

            $scope.movimientos = {
                '2015' : {
                    'enero' : {
                        1 : {
                            gastos: [
                                {
                                    code: 'G001'
                                },
                                {
                                    code: 'G002'
                                }

                            ],
                            compras: [
                                {
                                    code: 'C001'
                                },
                                {
                                    code: 'C002'
                                }
                            ],
                            RRHH: [

                                {
                                    code: 'R001'
                                },
                                {
                                    code: 'R002'
                                }

                            ],
                            inversiones: [
                                {
                                    code: 'I001'
                                },
                                {
                                    code: 'I002'
                                }
                            ],
                            ventas: [
                                {
                                    code: 'V001'
                                },
                                {
                                    code: 'V002'
                                }
                            ]
                        },
                        2 : {
                            gastos: [
                                {
                                    code: 'G003'
                                },
                                {
                                    code: 'G004'
                                }

                            ],
                            compras: [
                                {
                                    code: 'C003'
                                },
                                {
                                    code: 'C004'
                                }
                            ],
                            RRHH: [

                                {
                                    code: 'R003'
                                },
                                {
                                    code: 'R004'
                                }

                            ],
                            inversiones: [
                                {
                                    code: 'I003'
                                },
                                {
                                    code: 'I004'
                                }
                            ],
                            ventas: [
                                {
                                    code: 'V003'
                                },
                                {
                                    code: 'V004'
                                }
                            ],
                        }
                    },

                    'febrero' : {

                    }
                },

                '2016' : {

                },

                '2017' : {}
            };

            $scope.movimientos = {

                movimientosMes: function(ejercicio, mes){

                },
                movimientosTipo: function(ejercicio, mes){

                }

            };

        }])
        .controller('mesesController', '$scope', function($scope){
            $scope.mes = 0;
            $scope.selectMes = function(mes){

                $scope.mes = mes;
            };


        });
})();
