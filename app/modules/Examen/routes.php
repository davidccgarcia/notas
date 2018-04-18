<?php

Route::group(array('before' => 'auth'), function() {

    Route::get('examen', [
        'as'    => 'examen.index',
        'uses'  => 'App\Modules\Examen\Controllers\ExamenController@index'
    ]);

    Route::get('examenII/create', [
        'as'    => 'examenII.create',
        'uses'  => 'App\Modules\ExamenII\Controllers\ExamenIIController@create'
    ]);

    Route::get('examen/{ingreso}/edit', [
        'as'    => 'examen.edit',
        'uses'  => 'App\Modules\Examen\Controllers\ExamenController@edit'
    ]);

    Route::post('examen', [
        'as'    => 'examen.store',
        'uses'  => 'App\Modules\Examen\Controllers\ExamenController@store'
    ]);

    Route::post('examen/{ingreso}', [
        'as'    => 'examen.update',
        'uses'  => 'App\Modules\Examen\Controllers\ExamenController@update'
    ]);

    Route::post('examenII/buscar', [
        'as'    => 'examenII.buscar',
        'uses'  => 'App\Modules\ExamenII\Controllers\ExamenIIController@create'
    ]);
});
