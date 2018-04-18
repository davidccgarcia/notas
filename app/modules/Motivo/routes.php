<?php

Route::group(array('before' => 'auth'), function() {
    Route::post('motivo/usuarios', function() {
        $usuarios = DB::connection('siis')->table('system_usuarios')->select('nombre','usuario_id','usuario')
                        ->where('nombre', 'like', '%' . Input::get('usuario_text') . '%')
                        ->orWhere('usuario', 'like', '%' . Input::get('usuario_text') . '%')
                        ->take(30)->get();
        
        
        
        echo json_encode($usuarios);
    });

    Route::get('motivo/list/{ingreso}', array('as' => 'motivo.list', 'uses' => 'App\Modules\Motivo\Controllers\MotivoController@getEvoluciones'));
    Route::get('motivo/buscar', array('as' => 'motivo.buscar', 'uses' => 'App\Modules\Motivo\Controllers\MotivoController@buscar'));
    Route::post('motivo/buscar', array('as' => 'motivo.buscar.post', 'uses' => 'App\Modules\Motivo\Controllers\MotivoController@postBuscar'));




    Route::resource('motivo', 'App\Modules\Motivo\Controllers\MotivoController');
});

