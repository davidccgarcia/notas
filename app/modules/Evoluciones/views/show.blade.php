@extends('layouts.default')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-heart fa-fw"></i> Ver Evolucion

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart">


                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::model($evolucion, array('class'=>'form-horizontal')) }}    


                                <div class="form-group">
                                    {{ Form::label('descripcion', 'descripcion',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        {{ Form::textarea('descripcion',null,array('class'=>'form-control', 'type'=>'textarea')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('medico', 'Medico',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        {{ Form::text('medico',$usuario->nombre,array('class'=>'form-control')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('fecha_registro', 'fecha_registro',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        {{ Form::text('fecha_registro',null,array('class'=>'form-control', 'type'=>'date')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('sw_epicrisis', 'sw_epicrisis',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        <select name="sw_epicrisis" id="sw_epicrisis" class="form-control">
                                            <option value="1" <?php echo ($evolucion->sw_epicrisis == 1) ? 'selected' : '' ?>>SI </option>
                                            <option value="0"  <?php echo ($evolucion->sw_epicrisis == 0) ? 'selected' : '' ?>>NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        {{link_to('evoluciones?ingreso='.$evolucion->ingreso,'volver',array('class'=>'btn btn-info btn-xs'))}}
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