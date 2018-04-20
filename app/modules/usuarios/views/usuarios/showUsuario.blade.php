@extends('layouts.default')

@section('title')
Ver Usuario
@stop

@section('content')
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <table class="table table-striped table-hover">
                <tr class="">
                    <th>ID</th>
                    <td>{{ $usuario->id }}</td>
                </tr>
              
                <tr class="">
                    <th>Nombre</th>
                    <td>{{ $usuario->nombre}}</td>
                </tr>
                  <tr class="">
                    <th>Avatar</th>
                    <td>{{ $usuario->avatar}}</td>
                </tr>
                  <tr class="">
                    <th>Rol</th>
                    <td>{{ $usuario->rol_id}}</td>
                </tr>
                
                 <tr class="">
                    <th>Email</th>
                    <td>{{ $usuario->email}}</td>
                </tr>
                
            </table>
            <a href="{{ route('usuarios.index') }}" class="btn btn-success">Regresar a la Lista</a>
    </div>




@stop