@extends('layouts.default')

@section('title')
    ProyectoX | examenII Físico
@stop

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-stethoscope"></i> Buscar Evolucion

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart">


                        <div class="row" >
                            <div class="col-md-12">
                                {{ Form::open(['route' => 'examenII.buscar', 'class' => 'form-horizontal', 'mehtod' => 'POST']) }}
                                    <div class="form-group">
                                        {{ Form::label('cuenta', 'Cuenta', ['class' => 'col-sm-2 control-label']) }}

                                        <div class="col-sm-10">
                                            {{ Form::number('cuenta', null, ['class' => 'form-control', 'id' => 'cuenta', 'placeholder' => 'Ingrese Cuenta', 'required' => true, 'min' => '0']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-search fa-fw"></i> BUSCAR</button>
                                        </div>
                                    </div>
                                {{ Form::close() }}

                            </div>

                            <div class="col-md-12">
                                {{ Form::open(['route' => 'examenII.store', 'class' => 'form-horizontal', 'mehtod' => 'POST']) }}

                                    {{ Form::hidden('ingreso', $hcEvolucion->ingreso) }}
                                    {{ Form::hidden('evolucion_id', $hcEvolucion->evolucion_id) }}
                                    {{ Form::hidden('fecha', $hcEvolucion->fecha) }}
                                    {{ Form::hidden('usuario_id', $hcEvolucion->usuario_id) }}

                                    <table class="table table-striped">
                                        <thead>
                                            <tr">
                                                <th class="text-center">Sistema</th>
                                                <th class="text-center">Normal</th>
                                                <th class="text-center">Anormal</th>
                                                <th class="text-center">Hallazgo</th>
                                            </tr>
                                            <tr class="info">
                                                <th></th>
                                                <th class="text-center">{{ Form::radio('todos', 'N', false, ['id' => 'selected']) }}</th>
                                                <th class="text-center">{{ Form::radio('todos', 'A', false, ['id' => 'unselected']) }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($sistemas as $sistema)
                                            {{ Form::hidden('parametros', $sistema->texto,
                                                [
                                                    'class' => 'parametros',
                                                    'id'    => 'hallazgo_'.$sistema->tipo_sistema_id.'_N'
                                                ]
                                            ) }}
                                            <tr>
                                                <th scope="row">{{ $sistema->nombre }}</th>
                                                <td class="text-center">
                                                    {{
                                                        Form::radio(
                                                            'tipo_sistema_id['.$sistema->tipo_sistema_id.']',
                                                            $sistema->tipo_sistema_id.'_N',
                                                            false,
                                                            [
                                                                'class' => 'selectedNormal',
                                                                'id' => 'tipo_sistema_id_'.$sistema->tipo_sistema_id.'_N'
                                                            ]
                                                        )
                                                    }}
                                                </td>
                                                <td class="text-center">
                                                    {{
                                                        Form::radio(
                                                            'tipo_sistema_id['.$sistema->tipo_sistema_id.']',
                                                            $sistema->tipo_sistema_id.'_A',
                                                            false,
                                                            [
                                                                'class' => 'unselectedAnormal',
                                                                'id' => 'tipo_sistema_id_'.$sistema->tipo_sistema_id.'_A'
                                                            ]
                                                        )
                                                    }}
                                                </td>
                                                <td>
                                                    {{ Form::textarea('hallazgo['.$sistema->tipo_sistema_id.']', null, [
                                                        'class' => 'form-control hallazgo',
                                                        'rows' => 2,
                                                        'id' => 'hallazgo_'.$sistema->tipo_sistema_id.'_A'
                                                    ]) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <div class="col-sm-12 text-right">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> GUARDAR</button>
                                        </div>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>


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
