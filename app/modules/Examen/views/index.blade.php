@extends('layouts.default')

@section('title') Examen Físico @stop

@section('content')
    <div  id="contenView">
        @if (! empty($alert))
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $alert }}
            </div>
        @endif
        <!-- /.row -->
        <div class="row" >
            <div class="col-lg-12">
                <div class="card border-success">
                    <div class="card-header bg-info text-white">
                        <i class="fa fa-stethoscope" ></i> Examen Físico
                    </div>
                    <!-- /.panel-heading -->
                    <div class="card-body">
                        <div id="morris-area-chart">
                            <div class="row">
                                <div class="col-md-12">
                                    @if (Input::get('cuenta') !== null && $examen == null)
                                        {{ Form::open(['route' => 'examenII.buscar', 'method' => 'POST', 'class' => 'form-horizontal']) }}
                                            {{ Form::hidden('cuenta', Input::get('cuenta')) }}
                                            {{ Form::submit('Crear | Editar Examen Físico', ['class' => 'btn btn-primary']) }}
                                        {{ Form::close() }}
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    {{ Form::open(['route' => 'examen.index', 'method' => 'GET', 'class' => 'form-horizontal', 'role' => 'search']) }}
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
