@extends('layouts.default')

@section('title', 'Mi perfil')

@section('content')

    <div id="contenView">
        @include ('usuarios::usuarios.errors', array('errors' => $errors))
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-success">
                    <div class="card-header bg-info text-white">
                        <i class="fa fa-fw fa-user"></i> Mi perfil
                    </div>

                    <div class="card-body">
                        <div class="morris-area-chart">
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


                            {{ Form::button('Guardar Cambios', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
                                <a href="{{ url('/') }}" class="btn btn-primary">Regresar al Menu</a>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
