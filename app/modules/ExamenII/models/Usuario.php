<?php

namespace App\Modules\ExamenII\Models;

use Eloquent;
use Auth;
use DB;

class Usuario extends Eloquent
{
	protected $guarded = [];

	public static $rules = [];

    protected $connection = 'siis';

    protected $table = 'system_usuarios';

    protected $fillable = ['usuario_id'];

    public static function usuario()
    {
        return DB::connection('siis')
            ->table('system_usuarios')
            ->select('usuario_id')
            ->where('usuario', Auth::user()->usuario)
            ->first();
    }
}
