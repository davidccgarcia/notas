/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var miApp = angular.module('miApp', ['ngRoute'])

miApp.config(function ($routeProvider) {


    $routeProvider
            .when('/', {
                templateUrl: 'form/prueba.html',
                controller: 'homeController'
            })
            .when('/nueva_programacion', {
                templateUrl: 'form/Nueva_Programacion_Cx.html',
                controller: 'homeController'
            })
            .when('/consultar_programacion', {
                templateUrl: 'form/consultar_programacion.html',
                controller: 'homeController'
            })
            .when('/admision', {
                templateUrl: 'form/admision.html',
                controller: 'homeController'
            })
            .when('/actualizar_admision', {
                templateUrl: 'form/actualizar_admision.html',
                controller: 'homeController'
            })
            .when('/recepcion_pacientes_qx', {
                templateUrl: 'form/recepcion_pacientes_qx.html',
                controller: 'homeController'
            })
            .when('/hc', {
                templateUrl: 'form/hc.html',
                controller: 'homeController'
            })
            .when('/panel_quirofano', {
                templateUrl: 'form/panelQuirofano.html',
                controller: 'homeController'
            })
            .when('/crear_quirofano', {
                templateUrl: 'form/nuevo_quirofano.html',
                controller: 'homeController'
            })
              .when('/consulta_quirofano', {
                templateUrl: 'form/consulta_quirofano.html',
                controller: 'homeController'
            })
            .when('/crear_usuario', {
                templateUrl: 'form/crear_usuario.html',
                controller: 'homeController'
            })
            .otherwise({
                redirectTo: '/'
            });


});



miApp.controller('homeController', function ($scope) {
    $scope.tablaPacienteVisibility = false;
    $scope.mostrarPaciente = function () {

        if ($scope.tablaPacienteVisibility == true) {
            $scope.tablaPacienteVisibility = false;
        } else {
            $scope.tablaPacienteVisibility = true;
        }
    }
});

miApp.controller('activeController', function ($scope, $location) {
    $scope.isActive = function (viewLocation) {
        return viewLocation === $location.path();
    };
});



