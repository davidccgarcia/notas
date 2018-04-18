@extends('layouts.default')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-book fa-fw" ></i> Editar Examen Físico
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('examen.create') }}" class="btn btn-primary">Crear examen físico</a>
                            </div>
                            <div class="col-md-6">
                                {{ Form::open(['route' => 'examen.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) }}
                                    @include('Examen::partials.form_search')
                                {{ Form::close() }}
                            </div>
                        </div>

                        @if (isset($examen))
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Evolución</th>
                                        <th>Ingreso</th>
                                        <th>Hallazgo</th>
                                        <th>Fecha de registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>{{ $examen->evolucion_id }}</td>
                                        <td>{{ $examen->ingreso }}</td>
                                        <td>{{ $examen->hallazgo }}</td>
                                        <td>{{ $examen->fecha_registro }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('examen.edit', $examen->ingreso) }}" class="fa fa-edit" title="editar"></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

        </div>
        <!-- /.col-lg-8 -->

        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->

</div>




@stop

@section('script')



@stop
