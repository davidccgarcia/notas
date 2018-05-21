@extends('layouts.default')

@section('title', 'Generar evolución')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="card border-success">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-heart fa-fw"></i> Crear Evolución

                </div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div id="morris-area-chart">


                        <div class="row">
                            <div class="col-md-12">



                                {{ Form::open( array('url'=>'evoluciones?ingreso='.$ingreso,'method'=>'post','class'=>'form-horizontal','id'=>'formCreate','name'=>'formCreate')) }}    
                                <input type="hidden" class="form-control" value="{{$ingreso}}" name="ingreso" id="ingreso" >

                                <div class="form-group">
                                    {{ Form::label('descripcion', 'Descripción',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        {{ Form::textarea('descripcion',null,array('class'=>'form-control','id'=>'descripcion', 'type'=>'textarea')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('medico', 'Médico',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-8">
                                        <input type="hidden" class="form-control" value="" required name="usuario" id="usuario" >

                                        {{ Form::text('medico',null,array('class'=>'form-control','id'=>'usuario_text','disabled','required')) }}

                                    </div>
                                    <div class="col-sm-2">
                                        <button  type="button" class="btn btn-info"  data-toggle="modal" data-target="#modalUsuario"  title="Buscar Medico"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('fecha_registro', 'Fecha de registro',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        <input type="date" name="fecha_registro" placeholder="Fecha" id="fecha_registro" class="form-control" required>
                                    </div>
                                </div>
                                  <div class="form-group">
                                    {{ Form::label('fecha_registro_hora', 'Hora',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        <input type="time" name="fecha_registro_hora" placeholder="Hora Registro" id="fecha_registro_hora"  max="23:59" min="00:00" class="form-control" required>
                                    </div>
                                </div>
                              <div class="form-group">
                                    {{ Form::label('sw_epicrisis', 'Epicrisis',array('class'=>'col-sm-2 control-label')) }}
                                    <div class="col-sm-10">
                                        <select name="sw_epicrisis" id="sw_epicrisis" class="form-control">
                                            <option value="1">SI</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                </div>
                             
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        {{link_to('evoluciones?ingreso='.$ingreso,'volver',array('class'=>'btn btn-info btn-xs'))}}
                                        <button type="button" onclick="enviar_formulario()" class="btn btn-warning btn-xs">Guardar</button>
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


    function enviar_formulario() {
        if ($('#descripcion').val().length< 2) {
            alert('Descripcion obligatorio');
            return false;
        }
        if ($('#usuario').val().length < 1) {
            alert('Medico obligatorio');
            return false;
        }
        if ($('#usuario_text').val().length < 1) {
            alert('Medico obligatorio');
            return false;
        }

        if ($('#fecha_registro').val().length < 8) {
            alert('Fecha registro obligatorio');
            return false;
        }
         if ($('#fecha_registro_hora').val().length < 4) {
            alert('hora registro obligatorio');
            return false;
        }
        document.formCreate.submit()
    }
</script>
@stop