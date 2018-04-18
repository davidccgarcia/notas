@extends('layouts.default')
<?php
if ($usuario->exists):
    $form_data = array('route' => array('usuarios.update', $usuario->id), 'method' => 'PATCH');
    $action = 'Editar';
else:
    $form_data = array('route' => 'usuarios.store', 'method' => 'POST');
    $action = 'Crear';
endif;
?>


@section('title')
{{$action}} Usuario
@stop


@section('content')

<h1>{{$action}} Usuario</h1>

@include ('usuarios::usuarios.errors', array('errors' => $errors))

@if ($action == 'Editar')  
{{ Form::model($usuario, array('route' => array('usuarios.destroy', $usuario->id), 'method' => 'DELETE', 'role' => 'form')) }}
<div class="row">
    <div class="form-group col-md-4">
        {{ Form::submit('Eliminar Usuario', array('class' => 'btn btn-danger')) }}
    </div>
</div>
{{ Form::close() }}
@endif


{{ Form::model($usuario,$form_data, array('role' => 'form')) }}
<div class="row">

    <div class="form-group col-md-4">
        {{ Form::label('nombre', 'Nombre') }}
        {{ Form::text('nombre', null, array('placeholder' => 'Ingrese nombre de usuario', 'class' => 'form-control')) }}        
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('rol_id', 'Rol') }}
        {{  Form::select('rol_id', array('1' => 'Administrador', '2' => 'Lider','3'=>'Registrado', '4' => 'Mixto'), (isset($usuario->rol_id)?$usuario->rol_id:'1'),array('class'=>'form-control'));     }}
    </div>

</div>
<div class="row">
    <div class="form-group col-md-4">
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', null, array('placeholder' => 'Ingrese email', 'class' => 'form-control')) }}   
    </div>

    <div class="form-group col-md-4">
        {{ Form::label('usuario', 'Usuario') }}
        {{ Form::text('usuario', null, array('placeholder' => 'Ingrese usuario', 'class' => 'form-control')) }}        
    </div>

</div>


<div class="row">
    <div class="form-group col-md-4">
        {{ Form::label('password', 'Contraseña') }}
        {{ Form::password('password', array('class' => 'form-control','placeholder'=>'Escriba su clave')) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('password_confirmation', 'Confirmar contraseña') }}
        {{ Form::password('password_confirmation', array('class' => 'form-control','placeholder'=>'Vuelva a escribir su clave')) }}
    </div>
</div>


{{ Form::button($action.' Usuario', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
<a href="{{ route('usuarios.index') }}" class="btn btn-primary">Regresar a la Lista</a>
{{ Form::close() }}



@stop
