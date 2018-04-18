<!DOCTYPE html>
<html ng-app="miApp" lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Notas</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('lib/bootstrap/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('lib/bootstrap/css/dashboard.css') }}" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="{{asset('template/dashboard/font-awesome-4.3.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="{{ asset('lib/bootstrap/js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body ng-controller="principalController">
    
    <div id="wrapper">
        <nav class="navbar custom-navbar-color navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand white" href="/">Notas</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle white" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> 
                            {{ Auth::user()->nombre }}
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="{{ url('usuarios/editar_mi_perfil') }}" >
                                <i class="fa fa-user fa-fw"></i> 
                                Perfil
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="{{ url('logout') }}">
                                <i class="fa fa-sign-out fa-fw"></i> 
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
              <ul class="nav nav-sidebar">
                <li class="active">
                    <a href="{{ url('/') }}">
                        <i class="fa fa-home fa-fw"></i>
                        Inicio <span class="sr-only">(current)</span>
                    </a>
                </li>

                @if (Auth::user()->rol_id == '2' || Auth::user()->rol_id == '1' || Auth::user()->rol_id == '4') 
                    <li>
                        <a href="{{ url('evoluciones/buscar') }}">
                            <i class="fa fa-heart fa-fw" ></i> Evoluciones
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('examen')}} ">
                            <i class="fa fa-stethoscope" ></i> Examen Físico
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('cirugias/buscar') }}">
                            <i class="fa fa-heart" ></i> Cirugía
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('motivo/buscar')}} ">
                            <i class="fa fa-file fa-fw" ></i> Motivo de Consulta
                        </a>
                    </li>
                @endif
                
                @if (Auth::user()->rol_id == '1') 
                    <li>
                        <a href="{{ url('usuarios')}} ">
                            <i class="fa fa-users fa-fw" ></i> Usuarios
                        </a>
                    </li>
                @endif
              </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
              
            </div>
          </div>
        </div>
        <div id="page-wrapper">
            @if(Session::has('alert'))
                <div class="alert alert-info">{{ Session::get('alert') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" ng-include="rutaModal"></div>
            </div>
        </div>
    </div>
    
    <script>
        var base_url = "{{URL::to('/')}}";
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="lib/jQuery/js/jquery.min.js"><\/script>')</script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="{{ asset('lib/bootstrap/js/holder.min.js') }}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('lib/bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>
  </body>
</html>
