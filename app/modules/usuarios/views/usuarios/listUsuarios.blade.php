@extends('layouts.default')

@section('title') Usuarios @stop

@section('content')
    <div  id="contenView">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-success">
                    <div class="card-header bg-info text-white">
                        <i class="fa fa-fw fa-users"></i> Usuarios
                    </div>
                    <div class="card-body">
                        <div id="morris-area-chart">
                        <h4 class="card-title">Lista de usuarios</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Crear usuario</a>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4 justify-content-end d-flex" style="margin-top: -10px">
                                    {{ Form::open(['route' => 'usuarios.index', 'method' => 'GET', 'class' => 'form-inline my-2 my-lg-0 mr-lg-2', 'role' => 'search']) }}
                                        <div class="input-group">
                                            {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Buscar...']) }}
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-search fa-fw"></i>
                                                </button>
                                            </span>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                                <br><br>
                                <hr>
                                <div class="col-md-12">
                                    <table class="table table-bordered text-center">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                        @foreach ($usuarios as $usuario)
                                            <tr>
                                                <th scope="row">{{ $usuario->id }}</th>
                                                <td>{{ $usuario->usuario }}</td>
                                                <td>{{ $usuario->nombre }}</td>
                                                <td>{{ $usuario->role }}</td>
                                                <td>
                                                    <a href="{{ route('usuarios.show',array( $usuario->id)) }}"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('usuarios.edit',array( $usuario->id)) }}"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>

                                    <div class="text-center">
                                        {{ $usuarios->links() }}
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ Form::open(array('route' => array('usuarios.destroy', 'USER_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
    {{ Form::close() }}
@stop

@section('scripts')
    {{ HTML::script('../app/modules/usuarios/assets/js/usuario.js') }}
@stop
