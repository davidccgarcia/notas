<!DOCTYPE html>
<html  ng-app="miApp"  lang="es">

    <head>



        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> @yield('title')</title>


        <!-- Bootstrap Core CSS -->
        <link href="{{asset('lib/bt3/css/bootstrap.css')}}" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="{{asset('lib/datatables/css/dataTables.bootstrap.css')}}" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="{{asset('lib/datatables/css/dataTables.responsive.css')}}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{asset('template/sb-admin/css/sb-admin-2.css')}}" rel="stylesheet">

        <!-- Custom Fonts -->

        <link href="{{asset('template/sb-admin/font-awesome-4.3.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">


        <!--scripts-->
        <script src="{{asset('/lib/jQuery/js/jquery.min.js')}}" type="text/javascript"></script>



        @yield('head')
    </head>



    <body ng-controller="principalController">

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Notas</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">


                    <!-- /.dropdown -->
                    <li class="dropdown" >
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> {{Auth::user()->nombre}}   <i class="fa fa-caret-down"></i>

                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="{{url('usuarios/editar_mi_perfil')}}" ><i class="fa fa-user fa-fw"></i> Perfil</a>
                            </li>

                            <li class="divider"></li>
                            <li><a href="{{url('logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu"  >
                            <li>
                                <a href="{{url('/')}}"><i class="fa fa-home fa-fw" ></i> Inicio</a>
                            </li>
                            
                            @if (Auth::user()->rol_id == '2' || Auth::user()->rol_id == '1' || Auth::user()->rol_id == '4') 
                                <li>
                                    <a href="{{url('evoluciones/buscar')}}"><i class="fa fa-heart fa-fw" ></i> Evoluciones
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->rol_id == '2' || Auth::user()->rol_id == '1' || Auth::user()->rol_id == '4') 
                            
                                <li>
                                    <a href="{{url('examen')}}"><i class="fa fa-stethoscope" ></i> Examen Físico
                                    </a>
                                </li>
                                @endif
                            @if (Auth::user()->rol_id == '2' || Auth::user()->rol_id == '1' || Auth::user()->rol_id == '4') 
                                <li>
                                    <a href="{{url('examenII')}}">
                                        <i class="fa fa-stethoscope" ></i> Examen FísicoII
                                    </a>
                                </li>
                            @endif
                            <!--<li>
                                <a href="{{url('notas/buscar')}}"><i class="fa fa-heart fa-fw" ></i> Nota Enfermera
                                </a>
                            </li>-->
                            @if (Auth::user()->id == 107 || Auth::user()->id == 109 || Auth::user()->id == 121 || Auth::user()->id == 158 || Auth::user()->id == 157 ||  Auth::user()->id == 162 || Auth::user()->id == 137 || Auth::user()->id == 167 || Auth::user()->rol_id == '1' || Auth::user()->rol_id == '4')
                                <li>
                                    <a href="{{url('cirugias/buscar')}}">
                                        <i class="fa fa-heart" ></i> Cirugía
                                    </a>
                                </li>
                            @endif

                            @if (Auth::user()->rol_id == '2' || Auth::user()->rol_id == '1' || Auth::user()->rol_id == '4') 
                                <li>
                                    <a href="{{url('notas/buscar')}}">
                                        <i class="fa fa-file-o" ></i> Notas de enfermería
                                    </a>
                                </li>
                            @endif
                            
                            @if ((Auth::user()->rol_id == '2') || (Auth::user()->rol_id == '1') || (Auth::user()->rol_id == '4'))
                                <li>
                                    <a href="{{url('motivo/buscar')}}"><i class="fa fa-file fa-fw" ></i> Motivo de Consulta
                                    </a>
                                </li>
                            @endif
                            

                            @if ((Auth::user()->rol_id == '3') || (Auth::user()->rol_id == '1') || (Auth::user()->rol_id = '4')) 
                                <li>
                                    <a href="{{url('facturacion/buscar')}}"><i class="fa fa-file fa-fw" ></i> Facturacion
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->rol_id == '1') 
                                <li>
                                    <a href="{{url('usuarios')}}"><i class="fa fa-users fa-fw" ></i> Usuarios
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>


            <div id="page-wrapper">
                @if(Session::has('alert'))
                <div class="alert alert-info">{{ Session::get('alert') }}</div>
                @endif
                @yield('content')

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->


        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" ng-include="rutaModal">

                    </div>

                </div>
            </div>
        </div>
        <script>
            var base_url = "{{URL::to('/')}}";
        </script>


        <script src="{{ asset('/lib/bt3/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('lib/datatables/js/jquery.dataTables.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('lib/datatables/js/dataTables.bootstrap.min.js')}}"></script>

        <script src="{{ asset('/template/sb-admin/js/sb-admin-2.js')}}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{ asset('/template/sb-admin/js/plugins/metisMenu/metisMenu.min.js')}}"></script>
        <!--Angular js-->
        <script src="{{asset('/lib/angularjs/angular.js')}}"></script>
        <script src="{{asset('/modules/principal/assets/js/modulo.js')}}"></script>
      <!--<script src="{{asset('/modules/menu/assets/js/routes.js')}}" ></script>-->
        <script src="{{asset('/modules/principal/assets/js/controllers.js')}}" ></script>
        <script src="{{asset('/modules/principal/assets/js/main.js')}}" ></script>
        <script src="{{asset('/modules/principal/assets/js/mainII.js')}}" ></script>

        <script>

            $(document).on('submit', '.delete-form', function () {
                return confirm('Esta seguro de Remover este registro?');
            });

        </script>
        @yield('angularjs')

        @yield('scripts')
    </body>
</html>

