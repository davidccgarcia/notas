@extends('layouts.default')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-book fa-fw" ></i> Crear Examen Físico
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="alertMessage"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('examen.index') }}" class="btn btn-primary">Editar examen físico</a>
                            </div>
                            <div class="col-md-6">
                                {{ Form::open(['route' => 'examen.create', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) }}
                                    @include('Examen::partials.form_search')
                                {{ Form::close() }}
                            </div>
                        </div>

                        @if (! empty($evolucion)) 
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ingreso</th>
                                            <th>Descripción de la evolución</th>
                                            <th>Fecha Registro de la evolución</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                            <th>#{{ $evolucion->ingreso }} </th>
                                            <td class="text-justify">{{ $evolucion->descripcion }}</td>
                                            <td>{{ $evolucion->fecha_registro }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            {{ Form::open(['route' => 'examen.store', 'method' => 'POST', 'id' => 'form-exam', 'class' => 'form-exam form-horizonal', 'role' => 'form']) }}
                                {{ Form::hidden('ingreso', $evolucion->ingreso, ['id' => 'ingreso']) }}
                                {{ Form::hidden('evolucion_id', $evolucion->evolucion_id, ['id' => 'evolucion_id']) }}

                                <div class="table-responsive col-md-6 scrollable">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sistema</th>
                                                <th class="text-center">Normal</th>
                                                <th class="text-center">Anormal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tiposSistemas as $key => $value)
                                                <tr>
                                                    <td>{{ $value->nombre }}</td>
                                                    <td class='text-center'>
                                                        {{ Form::radio("sw_nomal_$key", 'N', false, ['tipo_sistema' => $value->tipo_sistema_id, 'class' => 'sw_normal']) }}
                                                    </td>
                                                    <td class='text-center'>
                                                        {{ Form::radio("sw_nomal_$key", 'A', false, ['tipo_sistema' => $value->tipo_sistema_id, 'class' => 'sw_normal']) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::textarea('hallazgo', null, ['class' => 'form-control', 'placeholder' => 'Descripción del hallazgo', 'id' => 'hallazgo']) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::submit('Registrar', ['id' => 'save', 'class' => 'btn btn-primary']) }}
                                    </div>
                                </div>
                            {{ Form::close() }}
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
