<?php

namespace App\Modules\Examen\models;

use Eloquent;

class Log extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

    protected $connection = 'mysql';

    protected $table = 'logs';
}
