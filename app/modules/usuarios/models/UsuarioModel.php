<?php

namespace App\Modules\Usuarios\Models;

use Auth,
    Validator,
    Eloquent,Hash;

class UsuarioModel extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usuarios';
    public $errors;
    protected $fillable = array('password', 'nombre', 'email','avatar','rol_id','usuario');

    public function isValid($data) {
        $rules = array(
            'nombre' => 'required',
            'email' => 'required',
            'password' => 'min:4|confirmed',
            'usuario' => 'required',
            
        );

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }

    public function setPasswordAttribute($value) {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

}
