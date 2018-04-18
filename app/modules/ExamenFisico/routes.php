<?php

Route::group(array('before' => 'auth'), function() {

    Route::get('examen', array(
        'as'    => 'crear', 
        'uses'  => 'App\Modules\ExamenFisico\Controllers\ExamenFisicoController@index'
    ));

    Route::post('examen/save_examen', array(
        'as'    => 'examen.store', 
        'uses'  => 'App\Modules\ExamenFisico\Controllers\ExamenFisicoController@store'
    ));

    Route::post('examen/buscar', array(
        'as'    => 'examen.buscar', 
        'uses'  => 'App\Modules\ExamenFisico\Controllers\ExamenFisicoController@search'
    ));

});
