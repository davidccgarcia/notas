<?php

Route::group(array('before' => 'guest'), function() {
    Route::get('login', array('as' => 'login', 'uses' => 'App\modules\auth\Controllers\AuthController@getLogin'));
    Route::post('login', array('as' => 'login.post', 'uses' => 'App\modules\auth\Controllers\AuthController@postLogin'));
});


Route::get('logout', array('as' => 'logout', 'uses' => 'App\modules\auth\Controllers\AuthController@getLogout'));




// Custom 404 page
App::missing(function($exception) {
    return Redirect::to('/');
});
