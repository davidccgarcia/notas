<?php

namespace App\Modules\ExamenII\Controllers;

use App\Modules\ExamenII\Models\Cuenta;
use BaseController;
use Input;

class CuentaController extends BaseController
{
    /**
    * Obtiene el ingreso asociado a la cuenta
    *
    */
   /**
    * Obtiene el ingreso asociado a la cuenta
    * @param  Integer $cuenta numero de la cuenta
    * @return Integer numero del ingreso asociado a la cuenta
    */
    public static function ingreso($cuenta)
    {
        return Cuenta::cuenta($cuenta)->first()->ingreso;
    }

    public static function get($cuenta)
    {
        return Cuenta::cuenta($cuenta)->first();
    }
}
