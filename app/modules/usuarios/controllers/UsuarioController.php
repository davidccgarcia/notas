<?php

namespace App\Modules\Usuarios\Controllers;

use App\Modules\Usuarios\Models\UsuarioModel,
    View,
    Auth,
    Input,
    Redirect;

class UsuarioController extends \BaseController {

    public function editPerfil() {
        
        $usuario = UsuarioModel::find(Auth::id());
        if (is_null($usuario)) {
            App::abort(404);
        }

        return View::make('usuarios::usuario.formPerfil', compact('usuario'));
    }

    public function updatePerfil() {
        // Creamos un nuevo objeto para nuestro nuevo usuario
        $usuario = UsuarioModel::find(Auth::id());

        // Si el usuario no existe entonces lanzamos un error 404 :(
        if (is_null($usuario)) {
            App::abort(404);
        }

        // Obtenemos la data enviada por el usuario
        $data = Input::all();

        // Revisamos si la data es válido
        if ($usuario->isValid($data)) {
            // Si la data es valida se la asignamos al usuario
            $usuario->fill($data);
            // Guardamos el usuario
            $usuario->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('usuarios.index');
        } else {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('usuarios.edit.perfil')->withInput()->withErrors($usuario->errors);
        }
    }

    function changePassword() {
        return View::make('usuarios::usuario.changePassword');
    }

}
