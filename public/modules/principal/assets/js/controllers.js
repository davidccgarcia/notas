
miApp.controller('principalController', function($scope, $http) {


    $scope.getViewPerfil = function() {
        $scope.rutaModal = base_url + '/modules/principal/views/perfil.html'
    }

    $scope.getViewNewProyecto = function() {
        $scope.rutaModal = base_url + '/modules/proyectos/views/newProyecto.html'
    }

    $scope.getViewNewTarea = function() {
        $scope.rutaModal = base_url + '/modules/tareas/views/newTarea.html'
    }


    $scope.deleteProyecto = function(alias) {
        console.log(alias);
    }





});


miApp.controller('proyectoController', function($scope, $http) {
    var proyecto = {};
    $scope.isInvalid = function(field) {
        return $scope.formProyecto[field].$invalid && $scope.formProyecto[field].$dirty;
    };



    $scope.isValid = function(field) {
        return $scope.formProyecto[field].$valid && $scope.formProyecto[field].$dirty;
    };

    $scope.submitFormProyecto = function() {
        proyecto.nombre = $scope.nombre;
        proyecto.alias = $scope.alias;
        proyecto.avatar = $scope.avatar;
        proyecto.fecha_inicio = $scope.fecha_inicio;
        proyecto.fecha_fin = $scope.fecha_fin;
        console.log('**submit proyecto**', proyecto);
        $http({
            method: 'POST',
            url: 'proyectos',
            data: proyecto,
        }).success(function(data, status) {
            console.log('***guardado correctamente***', data);

            if (data['status'] == false) {
                $('.content_alert').html('')
                $('.content_alert').append('<div class="alert alert-danger" role="alert">' + data['Mensaje'] + '</div>')
            } else {
                $scope.nombre = null;
                $scope.alias = null;
                $scope.avatar = null;
                $scope.fecha_inicio = null;
                $scope.fecha_fin = null;

                $('.content_alert').html('')
                $('.content_alert').append('<div class="alert alert-success" role="alert">' + data['Mensaje'] + '</div>')
                setInterval(function() {
                    window.location.assign(base_url + '/proyectos');
                }, 2000);



            }

        }).error(function(data, status) {
            console.log('***error***', data);
        });
    }



});


miApp.controller('tareaController', function($scope, $http) {





});



miApp.controller('perfilController', function($scope, $http) {

    var usuario = {};

    var roles = {};

    $http.get('roles').
            success(function(data, status, headers, config) {
                roles = data;
            });



    $http.get('usuarios/perfil').
            success(function(data, status, headers, config) {

                $scope.nombre = data['nombre'];
                $scope.email = data['email'];
                $scope.avatar = data['avatar'];
                $scope.rol_id = roles;
            });


    $scope.validarFormPerfil = function() {
        console.log($scope.formPerfil);
    };

    $scope.isInvalid = function(field) {
        return $scope.formPerfil[field].$invalid && $scope.formPerfil[field].$dirty;
    };

    $scope.isValid = function(field) {
        return $scope.formPerfil[field].$valid && $scope.formPerfil[field].$dirty;
    };

    $scope.isValidPassword = function(field) {
        return $scope.password != $scope.password2;
    };


    $scope.submit = function() {
        usuario.nombre = $scope.nombre;
        usuario.email = $scope.email;
        usuario.password = $scope.password;
        usuario.password2 = $scope.password2;
        console.log('**submit perfil**', usuario);
        $http({
            method: 'POST',
            url: '/usuario/',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $scope.usuario,
        }).success(function(data, status) {
        }).error(function(data, status) {

        });
    }

});



