<?php

Route::group(array('before' => 'auth'), function() {

    Route::get('examen', [
        'as'    => 'examen.index', 
        'uses'  => 'App\Modules\Examen\Controllers\ExamenController@index'
    ]);

    Route::get('examen/create', [
        'as'    => 'examen.create', 
        'uses'  => 'App\Modules\Examen\Controllers\ExamenController@create'
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

});
