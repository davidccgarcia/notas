
@extends('auth::layouts.login')

@section('title')
Login
@stop

@section('content')


<div class="container">


        {{ Form::open(array('route' => 'login.post','class'=>'form-signin', 'role'=>'form')) }}
        @if(Session::has('errors'))
        <div class="alert alert-danger">{{ Session::get('errors') }}</div>
        @endif
        <h2 class="form-signin-heading">ProyectoX</h2>
        <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuario" >
        <input type="password" id="passwd" class="form-control" placeholder="******" name="passwd" >
        <div class="checkbox">
            <label>
                <input type="checkbox" value="recordarme"> Recordarme
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar</button>
   {{ Form::close() }}

    @stop



