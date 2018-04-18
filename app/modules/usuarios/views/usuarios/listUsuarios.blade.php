@extends('layouts.default')


@section('title')
Nuevo usuario
@stop


@section('content')
<h1>Lista de usuarios</h1>
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Crear un nuevo usuario</a>
    </div>
    <div class="col-md-6">
        {{ Form::open(['route' => 'usuarios.index', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) }}
            <div class="form-group">
                {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Buscar usuario']) }}
            </div>
            <button type="submit" class="btn btn-success"><i class="fa fa-search fa-fw"></i> Buscar</button>
        {{ Form::close() }}
    </div>
</div>
<br>

<table class="table table-striped">
    <tr>

        <th>Id</th>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>rol_id</th>
        <!--<th>Avatar</th>-->
        <th>Acciones</th>
    </tr>
    @foreach ($usuarios as $usuario)

    <tr>
        <td>{{ $usuario->id }}</td>
        <td>{{ $usuario->usuario }}</td>
        <td>{{ $usuario->nombre }}</td>
        <td>{{ $usuario->rol_id }}</td>
        <!--<td>{{ $usuario->avatar }}</td>-->      
        <td>
            <a href="{{ route('usuarios.show',array( $usuario->id)) }}"><i class="fa fa-eye"></i></a>
            <a href="{{ route('usuarios.edit',array( $usuario->id)) }}"><i class="fa fa-edit"></i></a>
            <a href="#" data-id="{{ $usuario->id }}" class="btn-delete"><i class="fa fa-remove"></i></a>
        </td>
    </tr>    
    
    @endforeach
</table>

<div class="text-center">
    {{ $usuarios->links() }}
</div>



{{ Form::open(array('route' => array('usuarios.destroy', 'USER_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
{{ Form::close() }}



@stop

@section('scripts')
{{HTML::script('../app/modules/usuarios/assets/js/usuario.js')}}

@stop
