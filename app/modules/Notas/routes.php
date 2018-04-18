<?php

Route::group(array('before' => 'auth'), function() {
    Route::post('notas/usuarios', function() {
        // tipo_profesional != 1 y 2 y activos
        $usuarios = DB::connection('siis')
            ->table('profesionales')
            ->join('system_usuarios', 'system_usuarios.usuario_id', '=', 'profesionales.usuario_id')
            ->select('profesionales.nombre', 'profesionales.usuario_id', 'system_usuarios.usuario')
            ->where('system_usuarios.nombre', 'like', '%' . strtoupper(Input::get('usuario_text')). '%')
            ->whereNotIn('profesionales.tipo_profesional', ['1', '2'])
            ->where('profesionales.estado', '=', '1')
            ->take(30)
            ->get();

        echo json_encode($usuarios);
    });

    Route::get('notas/list/{ingreso}', array('as' => 'notas.list', 'uses' => 'App\Modules\Notas\Controllers\NotasController@getEvoluciones'));
    Route::get('notas/buscar', array('as' => 'notas.buscar', 'uses' => 'App\Modules\Notas\Controllers\NotasController@buscar'));
    Route::post('notas/buscar', array('as' => 'notas.buscar.post', 'uses' => 'App\Modules\Notas\Controllers\NotasController@postBuscar'));




    Route::resource('notas', 'App\Modules\Notas\Controllers\NotasController');
});

