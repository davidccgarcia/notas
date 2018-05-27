@extends('layouts.default')

@section('title', 'Motivo de Consulta - Ver')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="card border-success">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-file fa-fw"></i> Ver Motivo de Consulta

                </div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div id="morris-area-chart">


                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::model($evolucion) }}    

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            {{ Form::label('descripcion', 'Descripción') }}
                                            {{ Form::textarea('descripcion', null, ['class' => 'form-control', 'type' => 'textarea']) }}
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            {{ Form::label('medico', 'Médico') }}
                                            {{ Form::text('medico', $usuario->nombre, ['class' => 'form-control', 'id' => 'usuario_text', 'readonly']) }}
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{ Form::label('fecha_registro', 'Fecha de registro', ['class' => 'control-label']) }}
                                            {{ Form::text('fecha_registro', null, ['class' => 'form-control', 'type' => "text"]) }}
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-1">
                                            {{ link_to('motivo?ingreso=' . $evolucion->ingreso, 'Volver', ['class'=>'btn btn-info btn-xs'] ) }}
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