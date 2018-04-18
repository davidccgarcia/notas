<?php

namespace App\Modules\Usuarios\Controllers;

use View,
    Input,
    App\Modules\Usuarios\Models\SystemUsuarios,
    Redirect,
      Response,Request;

class UsuariosController extends \BaseController {

    /**
     * Display a listing of the resource.
     * GET /usuarios
     *
     * @return Response
     */
    public function index() {
        $usuarios = SystemUsuarios::name(Input::get('name'))->paginate();

        return View::make('usuarios::usuarios.listUsuarios')->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     * GET /usuarios/create
     *
     * @return Response
     */
    public function create() {
        $usuario = new SystemUsuarios();
        $action = 'Editar';
        return View::make('usuarios::usuarios.formCreateUsuario', compact('action'))->with('usuario', $usuario);
    }

    /**
     * Store a newly created resource in storage.
     * POST /usuarios
     *
     * @return Response
     */
    public function store() {

        $usuario = new SystemUsuarios();
        $data = Input::all();

        // Revisamos si la data es válido
        if ($usuario->isValid($data)) {
            // Si la data es valida se la asignamos al usuario
            $usuario->fill($data);
            // Guardamos el usuario
            $usuario->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('usuarios.show', array($usuario->id));
        } else {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::route('usuarios.create')->withInput()->withErrors($usuario->errors);
        }
    }

    /**
     * Display the specified resource.
     * GET /usuarios/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $usuario = SystemUsuarios::find($id);
        return View::make('usuarios::usuarios.showUsuario')->with('usuario', $usuario);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /usuarios/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $usuario = SystemUsuarios::find($id);
        if (is_null($usuario)) {
            App::abort(404);
        }
        $form_data = array('route' => array('usuarios.update', $usuario->id), 'method' => 'PATCH');
        $action = 'Editar';

        return View::make('usuarios::usuarios.formCreateUsuario', compact('usuario', 'form_data', 'action'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /usuarios/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        // Creamos un nuevo objeto para nuestro nuevo usuario
        $usuario = SystemUsuarios::find($id);

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
            return Redirect::route('usuarios.show', array($usuario->id));
        } else {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('usuarios.edit', $usuario->id)->withInput()->withErrors($usuario->errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /usuarios/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
     
        $usuario = SystemUsuarios::find($id);
        
        if (is_null ($usuario))
        {
            App::abort(404);
        }
        
        $usuario->delete();

         if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => $usuario->email.'  eliminado',
                'id'      => $usuario->id
            ));
        }
        else
        {
          return Redirect::route('usuarios.index');
        }
        
       
    }

}
