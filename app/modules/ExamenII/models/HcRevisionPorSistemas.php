<?php

namespace App\Modules\ExamenII\Models;

use Eloquent;

class HcRevisionPorSistemas extends Eloquent
{
    protected $guarded = [];

    public static $rules = [];

    protected $connection = 'siis';

    protected $table = 'hc_revision_por_sistemas';

    protected $fillable = [
        'tipo_sistema_id',
        'evolucion_id',
        'ingreso',
        'sw_normal',
        'hallazgo',
        'usuario_id',
        'fecha_registro'
    ];
}
