<?php

namespace App\Modules\Usuarios\Models;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface,
        Validator,Hash;
use Eloquent;

class SystemUsuarios extends Eloquent implements UserInterface, RemindableInterface {

    public $timestamps = true;
    public $remember_token = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usuarios';
    public $errors;
    protected $fillable = array('password', 'nombre', 'email', 'avatar', 'rol_id','usuario');
    protected $perPage = 10;

    public function isValid($data) {
        $rules = array(
            'nombre' => 'required',
            'email' => 'required|unique:usuarios',
            'password' => 'min:4|confirmed',
            'rol_id' => 'required',
            'usuario' => 'required'
        );


        // Si el usuario existe:
        if ($this->exists) {
            //Evitamos que la regla “unique” tome en cuenta el email del usuario actual
            $rules['email'] .= ',email,' . $this->id;
        } else { // Si no existe...
            // La clave es obligatoria:
            $rules['password'] .= '|required';
        }

        $validator = Validator::make($data, $rules);



        if ($validator->passes()) {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

    public function getRememberToken() {
        return $this->remember_token;
    }

    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    public function getRememberTokenName() {
        return 'remember_token';
    }

    public function setPasswordAttribute($value) {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function scopeName($query, $name)
    {
        if (trim($name) != "") {
            $query->where('nombre', "LIKE", "%$name%");
        }
    }


}
