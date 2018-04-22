<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Notas - @yield('title')</title>
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="#">Notas</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Inicio">
          <a class="nav-link" href="{{ url('/') }}">
            <i class="fa fa-home fa-fw"></i>
            <span class="nav-link-text">Inicio</span>
          </a>
        </li>
        @if ((Auth::user()->rol_id == '3') || (Auth::user()->rol_id == '1') || (Auth::user()->rol_id = '4')) 
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Evoluciones">
              <a class="nav-link" href="{{ url('evoluciones/buscar') }}">
                <i class="fa fa-heart fa-fw"></i>
                <span class="nav-link-text">Evoluciones</span>
              </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Examen Físico">
              <a class="nav-link" href="{{ url('examen') }}">
                <i class="fa fa-stethoscope"></i>
                <span class="nav-link-text">Examen Físico</span>
              </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Cirugía">
              <a class="nav-link" href="{{ url('cirugias/buscar') }}">
                <i class="fa fa-heart fa-fw"></i>
                <span class="nav-link-text">Cirugía</span>
              </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Motivo de Consulta">
              <a class="nav-link" href="{{ url('motivo/buscar') }}">
                <i class="fa fa-file fa-fw"></i>
                <span class="nav-link-text">Motivo de Consulta</span>
              </a>
            </li>
        @endif

        @if (Auth::user()->rol_id == '1')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuarios">
              <a class="nav-link" href="{{ url('usuarios') }}">
                <i class="fa fa-users fa-fw"></i>
                <span class="nav-link-text">Usuarios</span>
              </a>
            </li>
        @endif
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user fa-fw"></i> {{ Auth::user()->nombre }}
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ url('usuarios/editar_mi_perfil') }}">
                <i class="fa fa-user fa-fw"></i> Perfil
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ url('logout') }}">
                <i class="fa fa-fw fa-sign-out"></i>Logout
              </a>
            </div>
            
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
        <div id="page-wrapper">
          @if (Session::has('alert'))
            <div class="alert alert-info">{{ Session::get('alert') }}</div>
          @endif
          @yield('content')
        </div>
    </div>
    <!-- /.container-fluid-->
    
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Notas 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    {{-- <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a> --}}
    <!-- Logout Modal-->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div> --}}

    {{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" ng-include="rutaModal">

                </div>

            </div>
        </div>
    </div> --}}
    <script>
        var base_url = "{{URL::to('/')}}";
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{ asset('js/sb-admin-datatables.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-charts.min.js') }}"></script>
  </div>
</body>

</html>
