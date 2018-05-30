@extends('layouts.default')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="card border-success">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-stethoscope" ></i> Editar Examen Físico
                </div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div id="morris-area-chart">

                        {{ Form::open(['route' => ['examen.update', $examen->ingreso], 'method' => 'POST']) }}
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    {{ Form::label('hallazgo', 'Hallazgo') }}
                                    {{ Form::textarea('hallazgo', $examen->hallazgo, ['class' => 'form-control', 'id' => 'hallazgo', 'type' => 'textarea']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a href="{{ route('examen.index') }}" class="btn btn-info btn-sm">Volver</a>
                                    {{ Form::submit('Modificar', ['class' => 'btn btn-warning btn-sm']) }}
                                </div>
                            </div>
                        {{ Form::close() }}
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
