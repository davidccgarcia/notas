<?php

Route::group(array('before' => 'auth'), function() {
    Route::group(array('before' => 'admin'), function() {
        Route::get('usuarios', ['as' => 'usuarios.index', 'uses' => 'App\Modules\Usuarios\Controllers\UsuariosController@index']);
        Route::get('usuarios/crear_usuario', array('as' => 'usuarios.create', 'uses' => 'App\Modules\Usuarios\Controllers\UsuariosController@create'));
        Route::post('usuarios/save_usuario', array('as' => 'usuarios.store', 'uses' => 'App\Modules\Usuarios\Controllers\UsuariosController@store'));
        Route::get('usuarios/show/{id}', array('as' => 'usuarios.show', 'uses' => 'App\Modules\Usuarios\Controllers\UsuariosController@show'));
        Route::get('usuarios/edit/{id}', array('as' => 'usuarios.edit', 'uses' => 'App\Modules\Usuarios\Controllers\UsuariosController@edit'));
        Route::PATCH('usuarios/update/{id}', array('as' => 'usuarios.update', 'uses' => 'App\Modules\Usuarios\Controllers\UsuariosController@update'));
        Route::DELETE('usuarios/destroy/{id}', array('as' => 'usuarios.destroy', 'uses' => 'App\Modules\Usuarios\Controllers\UsuariosController@destroy'));
    });
    Route::get('usuarios/editar_mi_perfil', array('as' => 'usuarios.edit.perfil', 'uses' => 'App\Modules\Usuarios\Controllers\UsuarioController@editPerfil'));
    Route::PATCH('usuarios/actualizar_mi_perfil', array('as' => 'usuarios.update.perfil', 'uses' => 'App\Modules\Usuarios\Controllers\UsuarioController@updatePerfil'));

    Route::get('usuarios/cambiar_clave', array('as' => 'usuarios.edit.password', 'uses' => 'App\Modules\Usuarios\Controllers\UsuarioController@changePassword'));
});

