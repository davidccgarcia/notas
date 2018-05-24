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
                                {{ Form::open(['url' => 'evoluciones?ingreso=' . $ingreso, 'method' => 'post']) }}
                                
                                    <input type="hidden" value="{{ $ingreso }}" name="ingreso" id="ingreso">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            {{ Form::label('descripcion', 'Descripción') }}
                                            {{ Form::textarea('descripcion', null, ['class' => 'form-control', 'type' => 'textarea']) }}
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <input type="hidden" value="" name="usuario" id="usuario">
                                            {{ Form::label('medico', 'Médico') }}
                                            {{ Form::text('medico', null , ['class' => 'form-control', 'id' => 'usuario_text', 'readonly']) }}
                                        </div>
                                        <div class="col-md-1 align-self-center" style="margin-bottom:-13px">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUsuario" title="Buscar médico">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{ Form::label('fecha_registro', 'Fecha de registro', ['class' => 'control-label']) }}
                                            <input type="date" name="fecha_registro" id="fecha_registro" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-2">
                                            {{ Form::label('fecha_registro_hora', 'Hora', ['class' => 'control-label']) }}
                                            <input type="time" name="fecha_registro_hora" id="fecha_registro_hora" class="form-control" required>
                                        </div>
                                    </div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <legend class="col-form-label col-md-2 pt-0">Epicrisis</legend>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    {{ Form::radio('sw_epicrisis', 1, false, ['class' => 'form-check-input', 'id' => 'si']) }}
                                                    {{ Form::label('si', 'Si', ['class' => 'form-check-label']) }}
                                                </div>
                                                <div class="form-check">
                                                    {{ Form::radio('sw_epicrisis', 0, false, ['class' => 'form-check-input', 'id' => 'no']) }}
                                                    {{ Form::label('no', 'No', ['class' => 'form-check-label']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-row">
                                        <div class="form-group col-md-1">
                                            {{ link_to('evoluciones?ingreso=' . $ingreso, 'Volver', ['class'=>'btn btn-info btn-xs'] ) }}
                                        </div>
                                        <div class="form-group col-md-1">
                                            <button type="submit" onclick="enviar_formulario()" class="btn btn-warning btn-xs">Guardar</button>
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