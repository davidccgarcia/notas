<?php

Route::group(array('before' => 'auth'), function() {
    Route::post('facturacion/usuarios', function() {
        $usuarios = DB::connection('siis')->table('system_usuarios')->select('nombre','usuario_id','usuario')
                        ->where('nombre', 'like', '%' . Input::get('usuario_text') . '%')
                        ->orWhere('usuario', 'like', '%' . Input::get('usuario_text') . '%')
                        ->take(30)->get();
        
        
        
        echo json_encode($usuarios);
    });

    Route::get('facturacion/list/{ingreso}', array('as' => 'facturacion.list', 'uses' => 'App\Modules\Facturacion\Controllers\FacturacionController@getEvoluciones'));
    Route::get('facturacion/buscar', array('as' => 'facturacion.buscar', 'uses' => 'App\Modules\Facturacion\Controllers\FacturacionController@buscar'));
    Route::post('facturacion/buscar', array('as' => 'facturacion.buscar.post', 'uses' => 'App\Modules\Facturacion\Controllers\FacturacionController@postBuscar'));




    Route::resource('facturacion', 'App\Modules\Facturacion\Controllers\FacturacionController');
});

