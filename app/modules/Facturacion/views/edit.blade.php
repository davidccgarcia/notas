@extends('layouts.default')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file fa-fw"></i> Editar Fecha Salida

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart">


                        <div class="row">
                            <div class="col-md-12">



                                {{ Form::model($evolucion, array('url'=>'facturacion/'.$evolucion->ingreso,'method'=>'PATCH','class'=>'form-horizontal')) }}    
                                <input type="hidden" class="form-control" value="{{$evolucion->ingreso}}" name="ingreso" id="ingreso" >
                               
                                <!-- aqui -->
                                <div class="form-group">
                                    {{ Form::label('medico', 'Medico',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-8">
                                        <input type="hidden" class="form-control" value="{{$usuario->usuario_id}}" name="usuario" id="usuario" >

                                        {{ Form::text('medico',$usuario->nombre,array('class'=>'form-control','id'=>'usuario_text','readonly')) }}

                                    </div>
                                    
                                </div>
                                <?php
                                
                                $fecha=  explode(" ", $evolucion->fecha_registro);
                                $hora=  explode(".", $fecha[1])
                                ?>

                                <div class="form-group">
                                    {{ Form::label('fecha_registro', 'fecha_registro',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        <input type="date" name="fecha_registro" value="{{$fecha[0]}}" id="fecha_registro" class="form-control" required>
                                    </div>
                                </div>
                               
                                  <div class="form-group">
                                    {{ Form::label('fecha_registro_hora', 'fecha_registro_hora',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        <input type="time" name="fecha_registro_hora" id="fecha_registro_hora" value="{{$hora[0]}}" class="form-control" required>
                                    </div>
                                </div>
                               

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        {{link_to('facturacion?ingreso='.$evolucion->ingreso,'volver',array('class'=>'btn btn-info btn-xs'))}}
                                        <button type="submit" class="btn btn-warning btn-xs">Modificar</button>
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


<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalUsuarioLabel">Buscar Medico</h4>
            </div>
            <div class="modal-body">
                <form id="formulario">
                    <div class="form-group">

                        <input type="text" class="form-control" name="usuario_text" id="usuario_text" placeholder="Indicio de nombre del medico">
                    </div>
                </form>
                <div id="resultado">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="submitUsuario()">Buscar</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
<script>
    function submitUsuario() {
        $.ajax({
            type: "POST",
            url: "{{url('evoluciones/usuarios')}}",
            data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
            dataType: "json",
            success: function (datas) {
                var html = '<table class="table">';
                html += '<tr><th>Usuario</th><th>Nombre Completo</th><th></th></tr>';
                for (var i = 0; i < datas.length; i++) {
                    html += '<tr><td>' + datas[i].usuario + '</td><td>' + datas[i].nombre + '</td><td><input type="radio" value="' + datas[i].usuario_id + '" name="usuario_r" id="usuario_r" onchange="cambiarUsuario(' + datas[i].usuario_id + ',\'' + datas[i].nombre + '\')"></td></tr>';
                }
                html += '</table>';
                $('#resultado').html('');
                $('#resultado').append(html);
            }
        });
    }


    function cambiarUsuario(id, nombre) {
        $('#usuario').val(id);
        $('#usuario_text').val(nombre);
    }
</script>
@stop