<?php

namespace App\Modules\ExamenII\Models;

use Eloquent;

class Sistemas extends Eloquent
{
	protected $guarded = [];

	public static $rules = [];

    protected $connection = 'siis';

    protected $table = 'hc_tipos_sistemas';

    protected $fillable = ['tipo_sistema_id', 'nombre'];

    public function scopeTipos($query)
    {
        $query->join(
                'parametrizacion_texto_tipos_sistemas',
                'hc_tipos_sistemas.tipo_sistema_id', '=',
                'parametrizacion_texto_tipos_sistemas.tipo_sistema_id'
            )
            ->select(
                'hc_tipos_sistemas.tipo_sistema_id',
                'hc_tipos_sistemas.nombre',
                'parametrizacion_texto_tipos_sistemas.texto'
            )
            ->orderBy('hc_tipos_sistemas.tipo_sistema_id', 'asc')
            ->get();
    }
}
