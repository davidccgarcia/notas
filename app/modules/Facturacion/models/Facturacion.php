<?php

namespace App\Modules\Facturacion\models;

use Eloquent;

class Facturacion extends \Eloquent {

    protected $connection = 'siis';
    protected $table = 'ingresos_salidas';

}
