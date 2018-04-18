<?php

namespace App\Modules\tareas\Controllers;

use View,
    DB,
    Datatable,
    Form;

class TareasController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return View::make('tareas::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('tareas::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return View::make('tareas::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        return View::make('tareas::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
//
    }

    public function getTareas() {

        $proyectos = DB::table('tareas as t')->select('t.id', DB::raw('p.nombre as proyecto '), 't.tarea_padre_id', 't.nombre', 't.descripcion', 't.alias', 't.fecha_inicio', 't.fecha_fin', 't.porcentaje_avance')
                ->join('proyectos as p', 't.proyecto_id', '=', 'p.id');

        if (!isAdmin()) {
            $proyectos->where('t.usuario_id', '=', Auth::id());
        }


        return Datatable::query($proyectos)
                        ->showColumns('id', 'tarea_padre_id', 'proyecto', 'nombre', 'descripcion', 'alias', 'fecha_inicio', 'fecha_fin', 'porcentaje_avance')
                        ->searchColumns('t.id', 'p.nombre', 't.tarea_padre_id', 't.nombre', 't.descripcion', 't.alias', 't.fecha_inicio', 't.fecha_fin', 't.porcentaje_avance')
                        ->orderColumns('id', 'tarea_padre_id', 'proyecto', 'nombre', 'descripcion', 'alias', 'fecha_inicio', 'fecha_fin', 'porcentaje_avance')
                        ->addColumn('acciones', function($model) {
                            $link = link_to('tareas/' . $model->id . '/edit', '', $attributes = array('class' => 'fa fa-edit', 'title' => 'editar'), $secure = null);
                            $link.=link_to('tareas/' . $model->id, '', $attributes = array('class' => 'fa fa-eye', 'title' => 'ver'), $secure = null);
                            $link.= Form::delete('tareas/' . $model->id, 'X', array('class' => 'delete-form'), array('class' => 'btn-link fa fa-remove'));

                            return $link;
                        })
                        ->make();
    }

}
