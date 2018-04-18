<?php

namespace App\modules\auth\Controllers;

use Auth,
    Input,
    Redirect,
    View,
    DB;

/**
 * Authentication controller
 * @author Boris Strahija <bstrahija@gmail.com>
 */
class AuthController extends \BaseController {

    /**
     * Display login screen
     * @return View
     */
    public function getLogin() {
        return View::make('auth::login');
    }

    /**
     * Attempt to login
     * @return Redirect
     */
    public function postLogin() {
        $credentials = array(
            'usuario' => Input::get('usuario'),
            'password' => Input::get('passwd'),
        );

        if (Auth::attempt($credentials)) {

            return Redirect::to('/');
        }

        return Redirect::route('login')->with('errors', 'Datos Incorrectos!');
    }

    /**
     * Log a user out
     * @return Redirect
     */
    public function getLogout() {
        Auth::logout();
        return Redirect::route('login');
    }

}
