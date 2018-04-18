<?php

namespace App\Modules\ExamenII\Controllers;

use App\Modules\ExamenII\Controllers\CuentaController;
use App\Modules\ExamenII\Models\HcRevisionPorSistemas;

use App\Modules\ExamenII\Models\Evolucion;
use BaseController;

class EvolucionController extends BaseController
{

    public static function evolucion($ingreso)
    {
        return Evolucion::evolucion($ingreso)->get();
    }

}
