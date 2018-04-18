<?php

Route::group(array('before' => 'auth'), function() {
    Route::post('evoluciones/usuarios', function() {
        $usuarios = DB::connection('siis')->table('system_usuarios')->select('nombre','usuario_id','usuario')
                        ->where('nombre', 'like', '%' . Input::get('usuario_text') . '%')
                        ->orWhere('usuario', 'like', '%' . Input::get('usuario_text') . '%')
                        ->take(30)->get();
        
        
        
        echo json_encode($usuarios);
    });

    Route::get('evoluciones/list/{ingreso}', array('as' => 'evoluciones.list', 'uses' => 'App\Modules\Evoluciones\Controllers\EvolucionesController@getEvoluciones'));
    Route::get('evoluciones/buscar', array('as' => 'evoluciones.buscar', 'uses' => 'App\Modules\Evoluciones\Controllers\EvolucionesController@buscar'));
    Route::post('evoluciones/buscar', array('as' => 'evoluciones.buscar.post', 'uses' => 'App\Modules\Evoluciones\Controllers\EvolucionesController@postBuscar'));




    Route::resource('evoluciones', 'App\Modules\Evoluciones\Controllers\EvolucionesController');
});

