<?php

class Sistema extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

    protected $connection = 'siis';

    protected $table = 'hc_tipos_sistemas';

    protected $fillable = ['tipo_sistema_id', 'nombre'];
}
