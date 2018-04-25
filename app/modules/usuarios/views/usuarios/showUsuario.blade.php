@extends('layouts.default')

@section('title') Perfil ({{ $usuario->nombre }}) @stop

@section('content')
    <div id="contenView">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2"></div>
                <div class="col-md-auto">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('images/img_avatar.png') }}" class="card-img-top" alt="Avatar" style="width: 100%;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $usuario->nombre }}</h5>
                            <p class="card-text">{{ $usuario->email }}</p>
                            <p class="card-text">{{ $usuario->usuario }} - {{ $usuario->role }}</p>

                            <a href="{{ route('usuarios.index') }}" class="btn btn-primary">
                                Regresar a la lista
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>
    </div>
@stop
