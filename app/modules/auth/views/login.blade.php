<!DOCTYPE html>
<html lang="es">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" href="{{ asset('images/los_andes.png') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('template/sb-admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-15 p-b-20">
                {{ Form::open(['route' => 'login.post', 'class' => 'login100-form validate-form', 'role' => 'form']) }}
                    <span class="login100-form-title p-b-40">
                        Clínica Los Andes
                    </span>
                    @if (Session::has('errors')) 
                        <div class="alert alert-danger">
                            {{ Session::get('errors') }}
                        </div>
                    @endif
                    <span class="login100-form-avatar">
                        <img src="{{ asset('images/los_andes.png') }}" alt="AVATAR">
                    </span>

                    <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Ingrese nombre de usuario">
                        <input class="input100" type="text" name="usuario">
                        <span class="focus-input100" data-placeholder="Usuario"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-50" data-validate="Ingrese password">
                        <input class="input100" type="password" name="passwd">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Iniciar Sesion
                        </button>
                    </div>
                </form>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    

    <div id="dropDownSelect1"></div>
    
    <script src="{{ asset('lib/jQuery/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>