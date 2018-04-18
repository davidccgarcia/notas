<?php

namespace App\Modules\ExamenII\Models;

use Eloquent;

class HcEvolucionesSubmodulos extends Eloquent
{
    protected $guarded = [];

    public static $rules = [];

    protected $connection = 'siis';

    protected $table = 'hc_evoluciones_submodulos';

    protected $fillable = [
        'ingreso',
        'evolucion_id',
        'submodulo',
        'version',
        'subversion',
        'fecha_registro'
    ];
}
