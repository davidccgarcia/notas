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

                        {{ Form::open(['route' => ['examen.update', $examen->ingreso], 'method' => 'POST', 'class' => 'form-horizontal']) }}
                            <div class="form-group">
                                {{ Form::label('hallazgo', 'Hallazgo', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::textarea('hallazgo', $examen->hallazgo, ['class' => 'form-control', 'id' => 'hallazgo']) }}                                    
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
