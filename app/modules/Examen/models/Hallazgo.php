<?php

namespace App\Modules\Examen\models;

use Eloquent;

class Hallazgo extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

    protected $connection = 'siis';

    protected $table = 'hc_revision_por_sistemas_hallazgos';

    protected $fillable = array('hallazgo');

    public function scopeHallazgo($query, $ingreso)
    {
        $query->where('ingreso', '=', $ingreso);
    }
}
