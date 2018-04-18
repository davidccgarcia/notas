<?php
Route::group(array('before' => 'auth'), function() {
Route::GET('/',array('as'=>'menu','uses'=>'App\modules\web\Controllers\MenuController@index'));

});