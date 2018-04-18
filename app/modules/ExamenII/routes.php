<?php


Route::group(['before' => 'auth'], function() {

    Route::get('examenII', [
        'as'    => 'examenII.index',
        'uses'  => 'App\Modules\ExamenII\Controllers\ExamenIIController@index'
    ]);

    Route::post('examenII/buscar', [
        'as'    => 'examenII.buscar',
        'uses'  => 'App\Modules\ExamenII\Controllers\ExamenIIController@create'
    ]);

    Route::post('examenII/store', [
        'as'    => 'examenII.store',
        'uses'  => 'App\Modules\ExamenII\Controllers\ExamenIIController@store'
    ]);

    Route::get('examenII/{ingreso}/{evolucion}/show', [
        'as'    => 'examenII.show',
        'uses'  => 'App\Modules\ExamenII\Controllers\ExamenIIController@show'
    ]);

    Route::get('examenII/{ingreso}/{evolucion}/edit', [
        'as'    => 'examenII.edit',
        'uses'  => 'App\Modules\ExamenII\Controllers\ExamenIIController@edit'
    ]);

    Route::post('examenII/{ingreso}/{evolucion}/update', [
        'as'    => 'examenII.update',
        'uses'  => 'App\Modules\ExamenII\Controllers\ExamenIIController@update'
    ]);
});
