<?php

namespace App\Modules\Notas\models;

use Eloquent;

class Notas extends \Eloquent {

    protected $connection = 'siis';
    protected $table = 'hc_notas_enfermeria_descripcion';

}
