<?php
Route::group(array('before' => 'auth'), function() {
    Route::get('tareas/list', array('as' => 'tareas.list', 'uses' => 'App\Modules\tareas\Controllers\TareasController@getTareas'));
    Route::resource('tareas', 'App\Modules\tareas\Controllers\TareasController');
});
