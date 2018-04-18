
miApp.config(function ($routeProvider) {


    $routeProvider
            .when('/', {
                templateUrl: 'modules/menu/views/inicio.html',
                controller: 'homeController'
            })


            .when('/categoria/:id', {
                templateUrl: 'modules/servicios/views/categoria.html',
                controller: 'categoriaController'
            })
            .otherwise({
                redirectTo: '/'
            });


});

