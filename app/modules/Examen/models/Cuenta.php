<?php

namespace App\Modules\Examen\models;

use Eloquent;

class Cuenta extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

    protected $connection = 'siis';

    protected $table = 'cuentas';

    protected $fillable = array('ingreso');

    public function scopeCuenta($query, $cuenta)
    {
        if (trim($cuenta) != "") {
            $query->where('numerodecuenta', '=', $cuenta);
        }
    }
}
