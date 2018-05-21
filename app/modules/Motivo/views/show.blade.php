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
                                {{ Form::model($evolucion, array('class'=>'form-horizontal')) }}    


                                <div class="form-group">
                                    {{ Form::label('descripcion', 'Descripción',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        {{ Form::textarea('descripcion',null,array('class'=>'form-control', 'type'=>'textarea')) }}
                                    </div>
                                </div>
                                <!-- aqui -->
                                <div class="form-group">
                                    {{ Form::label('enfermedadactual', 'Enfermedad actual',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        {{ Form::textarea('enfermedadactual',null,array('class'=>'form-control', 'type'=>'textarea')) }}
                                    </div>
                                </div>
                                <!-- aqui -->
                                <div class="form-group">
                                    {{ Form::label('medico', 'Médico',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        {{ Form::text('medico',$usuario->nombre,array('class'=>'form-control')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('fecha_registro', 'Fecha Registro',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        {{ Form::text('fecha_registro',null,array('class'=>'form-control', 'type'=>'date')) }}
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        {{link_to('motivo?ingreso='.$evolucion->ingreso,'volver',array('class'=>'btn btn-info btn-xs'))}}
                                    </div>
                                </div>




                                {{ Form::close() }}


                            </div

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