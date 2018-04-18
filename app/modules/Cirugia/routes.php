<?php

Route::group(array('before' => 'auth'), function() {
    Route::post('cirugias/usuarios', function() {
        $usuarios = DB::connection('siis')->table('system_usuarios')->select('nombre','usuario_id','usuario')
                        ->where('nombre', 'like', '%' . Input::get('usuario_text') . '%')
                        ->orWhere('usuario', 'like', '%' . Input::get('usuario_text') . '%')
                        ->take(30)->get();
        
        
        
        echo json_encode($usuarios);
    });

    Route::get('cirugias/list/{ingreso}', array('as' => 'cirugias.list', 'uses' => 'App\Modules\Cirugia\Controllers\CirugiaController@getCirugias'));
    Route::get('cirugias/buscar', array('as' => 'cirugias.buscar', 'uses' => 'App\Modules\Cirugia\Controllers\CirugiaController@buscar'));
    Route::post('cirugias/buscar', array('as' => 'cirugias.buscar.post', 'uses' => 'App\Modules\Cirugia\Controllers\CirugiaController@postBuscar'));




    Route::resource('cirugias', 'App\Modules\Cirugia\Controllers\CirugiaController');
});

