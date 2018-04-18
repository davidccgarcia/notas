<?php

namespace App\Modules\Notas\Controllers;

use View,
    DB,
    Datatable,
    Auth,
    Form,
    Response,
    App\Modules\Notas\models\Notas,
    Validator,
    Redirect,
    Input;

class NotasController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        return View::make('Notas::index', array('ingreso' => Input::get('ingreso')));
    }

    /**
     * retorna Vista para buscar Evoluciones
     *
     */
    public function buscar() {
        return View::make('Notas::buscar');
    }

    public function postBuscar() {
        $cuenta = Input::get('cuenta');
        $ingreso = $this->getIngresoOfCuenta($cuenta);
        $cont = DB::connection('siis')->table('hc_notas_enfermeria_descripcion')->where('ingreso', '=', $ingreso)->count();
        if($cont<1) {
            Return Redirect::action('App\Modules\Notas\Controllers\NotasController@create', array('ingreso' => $ingreso));
          // return Redirect::to('notas/buscar')->with('alert', 'No se puede acceder porque no tiene ningun registro en hc_notas_enfermeria_descripcion con el ingreso='.$ingreso);
        }
        return Redirect::action('App\Modules\Notas\Controllers\NotasController@index', array('ingreso' => $ingreso));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        return View::make('Notas::create', array('ingreso' => Input::get('ingreso')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        $proyecto['descripcion'] = Input::get('descripcion');
        $proyecto['usuario_id'] = Input::get('usuario');
        $proyecto['fecha_registro'] = Input::get('fecha_registro') . ' ' . Input::get('fecha_registro_hora');

        $evolucion = DB::connection('siis')->table('hc_evoluciones')->where('ingreso', '=', Input::get('ingreso'))->first();

        if (empty($evolucion->evolucion_id)) {
            return Redirect::to('notas/create?ingreso=' . Input::get('ingreso'));
        }

        DB::connection('siis')->statement('ALTER TABLE hc_notas_enfermeria_descripcion DISABLE TRIGGER USER');

        $res = DB::connection('siis')->table('hc_notas_enfermeria_descripcion')->insert(array(
            'descripcion' => $proyecto['descripcion'],
            'evolucion_id' => $evolucion->evolucion_id,
            'usuario_id' => $proyecto['usuario_id'],
            'fecha_registro' => $proyecto['fecha_registro'],
            'ingreso' => Input::get('ingreso'),
            'fecha_registro_nota' => $proyecto['fecha_registro']
            )
        );

        $submodulo = DB::connection('siis')
            ->table('hc_evoluciones_submodulos')
            ->select('submodulo')
            ->where('ingreso', '=', Input::get('ingreso'))
            ->where('evolucion_id', '=', $evolucion->evolucion_id)
            ->where('submodulo', '=', 'NotasEnfermeria')
            ->first();

        if ($submodulo == null) {
            DB::connection('siis')->table('hc_evoluciones_submodulos')->insert(array(
                'ingreso' => Input::get('ingreso'),
                'evolucion_id' => $evolucion->evolucion_id,
                'submodulo' => 'NotasEnfermeria'
            ));
        }

        DB::connection('siis')->statement('ALTER TABLE hc_notas_enfermeria_descripcion ENABLE TRIGGER USER');

        if ($res == 1) {

            return Redirect::to('notas?ingreso=' . Input::get('ingreso'))->with('alert', 'La nota ha sido creada  correctamente');
        } else {
            return Redirect::to('evoluciones?ingreso=' . Input::get('ingreso'))->with('alert', 'La nota no se ha podido crear');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($hc_notas_enfermeria_descripcion_id) {
        $evolucion = Notas::where('hc_notas_enfermeria_descripcion_id', '=', $hc_notas_enfermeria_descripcion_id)->first();
        $usuario = $this->getUsuario($evolucion->usuario_id);
        return View::make('Notas::show', array('evolucion' => $evolucion, 'usuario' => $usuario));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $evolucion = Notas::where('hc_notas_enfermeria_descripcion_id', '=', $id)->first();
        $usuario = $this->getUsuario($evolucion->usuario_id);
        return View::make('Notas::edit', array('evolucion' => $evolucion, 'usuario' => $usuario));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        DB::connection('siis')->statement('ALTER TABLE hc_notas_enfermeria_descripcion DISABLE TRIGGER USER');

        $evolucion['ingreso'] = Input::get('ingreso');
        $evolucion['descripcion'] = Input::get('descripcion');
        $evolucion['usuario_id'] = Input::get('usuario');
        $evolucion['fecha_registro'] = Input::get('fecha_registro') . ' ' . Input::get('fecha_registro_hora');
        $evolucion['fecha_registro_nota'] = Input::get('fecha_registro') . ' ' . Input::get('fecha_registro_hora');

        if ($evolucion['descripcion'] == '' ) {
            return \Illuminate\Support\Facades\Redirect::to('notas/' . $id . '/edit')->with('alert', 'Los campos son obligatorios');
        }


        $res = DB::connection('siis')->table('hc_notas_enfermeria_descripcion')
                ->where('hc_notas_enfermeria_descripcion_id', $id)
                ->update($evolucion);

        DB::connection('siis')->statement('ALTER TABLE hc_notas_enfermeria_descripcion ENABLE TRIGGER USER');

        if ($res == 1) {
            $evolucions['id_usuario'] = Auth::user()->id;
                $evolucions['nombre'] = Auth::user()->nombre;
                $evolucions['tabla'] = "hc_notas_enfermeria_descripcion";
                $evolucions['ingreso'] = Input::get('ingreso');
                DB::connection('mysql')->table('logs')
                ->insert($evolucions);


            return \Illuminate\Support\Facades\Redirect::to('notas?ingreso=' . $evolucion['ingreso'])->with('alert', 'La nota ha sido modificado correctamente');
        } else {
            return \Illuminate\Support\Facades\Redirect::to('notas?ingreso=' . $evolucion['ingreso'])->with('alert', 'La nota no se ha podido modificar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $proyecto = Proyecto::where('alias', '=', $id)->first();

        /**
         * consultar si tiene estados asignados
         *
         */
        $tareas = DB::table('tareas as t')->where('t.proyecto_id', '=', $proyecto->id)->count();

        if ($tareas > 0) {
            return \Illuminate\Support\Facades\Redirect::to('proyectos')->with('alert', 'EL proyecto tiene tareas asignadas');
        }
        /**
         * consultar si tiene tareas asignadas
         *
         */
        $estados = DB::table('proyectos_estados_asignados as p')->where('p.proyecto_id', '=', $proyecto->id)->count();

        if ($estados > 0) {
            return \Illuminate\Support\Facades\Redirect::to('proyectos')->with('alert', 'EL proyecto tiene estados asignados');
        }



        $res = DB::table('proyectos')->where('alias', '=', $id)->delete();

        if ($res) {
            return \Illuminate\Support\Facades\Redirect::to('proyectos')->with('alert', 'Proyecto eliminado correctamente');
        }
    }

    /**
     * retorna un array de las evoluciones
     * @return type
     */
    public function getEvoluciones($ingreso) {

        $evoluciones = DB::connection('siis')->table('hc_notas_enfermeria_descripcion as ed')->select('ed.hc_notas_enfermeria_descripcion_id', DB::raw('substring(ed.descripcion from 1 for 100) as descripcion'), 'ed.evolucion_id', 'ed.ingreso', DB::raw('to_char(ed.fecha_registro_nota, \'DD-MM-YYYY HH24:MI:SS\') as fecha_registro'), 'su.nombre')
                ->join('system_usuarios as su', 'ed.usuario_id', '=', 'su.usuario_id')
                ->where('ingreso', '=', $ingreso);



        return Datatable::query($evoluciones)
                        ->showColumns('ingreso', 'nombre', 'descripcion', 'fecha_registro')
                        ->searchColumns('ed.descripcion', 'su.nombre')
                        ->orderColumns('ingreso', 'nombre', 'descripcion', 'fecha_registro')
                        ->addColumn('acciones', function($model) {
                            $link = link_to('notas/' . $model->hc_notas_enfermeria_descripcion_id . '/edit', '', $attributes = array('class' => 'fa fa-edit', 'title' => 'editar'), $secure = null);
                            $link.=link_to('notas/' . $model->hc_notas_enfermeria_descripcion_id, '', $attributes = array('class' => 'fa fa-eye', 'title' => 'ver'), $secure = null);

                            return $link;
                        })
                        ->make();
    }

    public function getIngresoOfCuenta($numerodecuenta) {
        $cuenta = DB::connection('siis')->table('cuentas')->where('numerodecuenta', '=', $numerodecuenta)->first();

        return $cuenta->ingreso;
    }

    public function getUsuario($usuario_id) {
        $usuario = DB::connection('siis')->table('system_usuarios')->where('usuario_id', '=', $usuario_id)->first();

        return $usuario;
    }

}
