<?php

namespace App\Modules\ExamenII\Models;
use Eloquent;

class Cuenta extends Eloquent
{
    protected $guarded = [];

    public static $rules = [];

    protected $connection = 'siis';

    protected $fillable = ['ingreso'];

    public function scopeCuenta($query, $cuenta)
    {
        if (trim($cuenta) != "") {
            $query->where('numerodecuenta', $cuenta);
        }
    }
}
