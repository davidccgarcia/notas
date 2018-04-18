<?php

namespace App\Modules\ExamenII\Models;
use Eloquent;

class Evolucion extends Eloquent
{
	protected $guarded = [];

	public static $rules = [];

    protected $connection = 'siis';

    protected $table = 'hc_evoluciones';

    protected $fillable = ['ingreso', 'evolucion_id'];

    public function scopeEvolucion($query, $ingreso)
    {
        if (trim($ingreso) != "") {
            $query->join('profesionales', 'hc_evoluciones.usuario_id', '=', 'profesionales.usuario_id')
                ->select('evolucion_id', 'ingreso', 'fecha', 'hc_evoluciones.usuario_id')
                ->where('ingreso', $ingreso)
                ->whereIn('profesionales.tipo_profesional', ['1', '2'])
                ->orderBy('hc_evoluciones.fecha_registro', 'desc')
                ->get();
        }
    }
}
