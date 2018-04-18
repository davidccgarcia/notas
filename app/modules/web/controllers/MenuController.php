<?php

namespace App\modules\web\Controllers;

use View,
    Auth;
  

class MenuController extends \BaseController {

    function index() {
        return View::make('web::index');
    }

}
