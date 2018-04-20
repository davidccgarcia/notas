@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1>Mi Perfil</h1>

            @include ('usuarios::usuarios.errors', array('errors' => $errors))

            {{ Form::model($usuario,array('route' => array('usuarios.update.perfil'), 'method' => 'PATCH'), array('role' => 'form')) }}

            <div class="row">
                <div class="form-group col-md-4">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', null, array('placeholder' => 'Ingrese email', 'class' => 'form-control')) }}   
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('nombre', 'Nombre') }}
                    {{ Form::text('nombre', null, array('placeholder' => 'Ingrese Un nombre', 'class' => 'form-control')) }}   
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

            {{ Form::button('Guardar Cambios', array('type' => 'submit', 'class' => 'btn btn-success')) }}
            <a href="{{ url('/') }}" class="btn btn-success">Regresar al Menu</a>
            {{ Form::close() }}
        </div>
    </div>

@stop