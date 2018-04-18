<?php

namespace App\Modules\Evoluciones\Controllers;

use View,
    DB,
    Datatable,
    Auth,
    Form,
    Response,
    App\Modules\Evoluciones\models\Evolucion,
    Validator,
    Redirect,
    Input;

class EvolucionesController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        return View::make('Evoluciones::index', array('ingreso' => Input::get('ingreso')));
    }

    /**
     * retorna Vista para buscar Evoluciones
     * 
     */
    public function buscar() {
        return View::make('Evoluciones::buscar');
    }

    public function postBuscar() {
        $cuenta = Input::get('cuenta');
        $ingreso = $this->getIngresoOfCuenta($cuenta);
        $cont = DB::connection('siis')->table('hc_evoluciones')->where('ingreso', '=', $ingreso)->count();
        if($cont<1) {
          return  Redirect::to('evoluciones/buscar')->with('alert', 'No se puede acceder porque no tiene ningun registro en hc_evoluciones con el ingreso='.$ingreso);
        }
        return Redirect::action('App\Modules\Evoluciones\Controllers\EvolucionesController@index', array('ingreso' => $ingreso));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        return View::make('Evoluciones::create', array('ingreso' => Input::get('ingreso')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        $proyecto['descripcion'] = Input::get('descripcion');
        $proyecto['usuario_id'] = Input::get('usuario');
        $proyecto['sw_epicrisis'] = Input::get('sw_epicrisis');
        $proyecto['fecha_registro'] = Input::get('fecha_registro') . ' ' . Input::get('fecha_registro_hora');


        $evolucion = DB::connection('siis')->table('hc_evoluciones')->where('ingreso', '=', Input::get('ingreso'))->first();

        if (empty($evolucion->evolucion_id)) {
            Redirect::to('evoluciones/create?ingreso=' . Input::get('ingreso'));
        }

        $res = DB::connection('siis')->table('hc_evolucion_descripcion')->insert(array(
            'descripcion' => $proyecto['descripcion'],
            'evolucion_id' => $evolucion->evolucion_id,
            'usuario_id' => $proyecto['usuario_id'],
            'ingreso' => Input::get('ingreso'),
            'fecha_registro' => $proyecto['fecha_registro'],
            'sw_epicrisis' => $proyecto['sw_epicrisis'],
            'fecha_registro_evolucion' => $proyecto['fecha_registro'],
                )
        );


        if ($res == 1) {
            $evolucions['id_usuario'] = Auth::user()->id;
                $evolucions['nombre'] = Auth::user()->nombre;
                $evolucions['tabla'] = "hc_evolucion_descripcion";
                $evolucions['ingreso'] = Input::get('ingreso');
                DB::connection('mysql')->table('logs')
                ->insert($evolucions);
            return \Illuminate\Support\Facades\Redirect::to('evoluciones?ingreso=' . Input::get('ingreso'))->with('alert', 'La evolucion ha sido creada  correctamente');
        } else {
            return \Illuminate\Support\Facades\Redirect::to('evoluciones?ingreso=' . Input::get('ingreso'))->with('alert', 'La evolucion no se ha podido crear');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($hc_evolucion_descripcion_id) {
        $evolucion = Evolucion::where('hc_evolucion_descripcion_id', '=', $hc_evolucion_descripcion_id)->first();
        $usuario = $this->getUsuario($evolucion->usuario_id);
        return View::make('Evoluciones::show', array('evolucion' => $evolucion, 'usuario' => $usuario));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $evolucion = Evolucion::where('hc_evolucion_descripcion_id', '=', $id)->first();
        $usuario = $this->getUsuario($evolucion->usuario_id);
        return View::make('Evoluciones::edit', array('evolucion' => $evolucion, 'usuario' => $usuario));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        $evolucion['ingreso'] = Input::get('ingreso');
        $evolucion['descripcion'] = Input::get('descripcion');
        $evolucion['usuario_id'] = Input::get('usuario');
        $evolucion['fecha_registro'] = Input::get('fecha_registro') . ' ' . Input::get('fecha_registro_hora');
        $evolucion['fecha_registro_evolucion'] = Input::get('fecha_registro') . ' ' . Input::get('fecha_registro_hora');
        $evolucion['sw_epicrisis'] = Input::get('sw_epicrisis');

        var_dump(Input::all());

        if ($evolucion['descripcion'] == '' || $evolucion['usuario_id'] == '' || $evolucion['fecha_registro'] == '') {
            return \Illuminate\Support\Facades\Redirect::to('evoluciones/' . $id . '/edit')->with('alert', 'Los campos son obligatorios');
        }


        $res = DB::connection('siis')->table('hc_evolucion_descripcion')
                ->where('hc_evolucion_descripcion_id', $id)
                ->update($evolucion);
        if ($res == 1) {

                $evolucions['id_usuario'] = Auth::user()->id;
                $evolucions['nombre'] = Auth::user()->nombre;
                $evolucions['tabla'] = "hc_evolucion_descripcion";
                $evolucions['ingreso'] = Input::get('ingreso');
                DB::connection('mysql')->table('logs')
                ->insert($evolucions);

            return \Illuminate\Support\Facades\Redirect::to('evoluciones?ingreso=' . $evolucion['ingreso'])->with('alert', 'La evolucion ha sido modificado correctamente');
        } else {
            return \Illuminate\Support\Facades\Redirect::to('evoluciones?ingreso=' . $evolucion['ingreso'])->with('alert', 'La evolucion no se ha podido modificar');
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

        $evoluciones = DB::connection('siis')->table('hc_evolucion_descripcion as ed')->select('ed.hc_evolucion_descripcion_id', DB::raw('substring(ed.descripcion from 1 for 100) as descripcion'), 'ed.evolucion_id', 'ed.ingreso', DB::raw('to_char(ed.fecha_registro, \'DD-MM-YYYY HH24:MI:SS\') as fecha_registro'), 'su.nombre')
                ->join('system_usuarios as su', 'ed.usuario_id', '=', 'su.usuario_id')
                ->where('ingreso', '=', $ingreso);



        return Datatable::query($evoluciones)
                        ->showColumns('ingreso', 'nombre', 'descripcion', 'fecha_registro')
                        ->searchColumns('ed.descripcion', 'su.nombre')
                        ->orderColumns('ingreso', 'nombre', 'descripcion', 'fecha_registro')
                        ->addColumn('acciones', function($model) {
                            $link = link_to('evoluciones/' . $model->hc_evolucion_descripcion_id . '/edit', '', $attributes = array('class' => 'fa fa-edit', 'title' => 'editar'), $secure = null);
                            $link.=link_to('evoluciones/' . $model->hc_evolucion_descripcion_id, '', $attributes = array('class' => 'fa fa-eye', 'title' => 'ver'), $secure = null);

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

    public function generaLogs($usuario_id){
        $usu = $usuario_id;
        echo $usu;
    }

}
