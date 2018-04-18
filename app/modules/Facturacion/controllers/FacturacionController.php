<?php

namespace App\Modules\Facturacion\Controllers;

use View,
    DB,
    Datatable,
    Auth,
    Form,
    Response,
    App\Modules\Facturacion\models\Facturacion,
    Validator,
    Redirect,
    Input;

class FacturacionController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        return View::make('Facturacion::index', array('ingreso' => Input::get('ingreso')));

    }

    /**
     * retorna Vista para buscar Evoluciones
     * 
     */
    public function buscar() {
        return View::make('Facturacion::buscar');
    }

    public function postBuscar() {
        $cuenta = Input::get('cuenta');
        $ingreso = $this->getIngresoOfCuenta($cuenta);
        $cont = DB::connection('siis')->table('ingresos_salidas')->where('ingreso', '=', $ingreso)->count();
        if($cont<1) {
          return  Redirect::to('facturacion/buscar')->with('alert', 'No se puede acceder porque no tiene ningun registro en hc_motivo_consulta con el ingreso='.$ingreso);
        }
        echo "cuenta: ".$cuenta;
        echo "<br>";
        echo $cont;
        echo "<br>";
        echo "ingreso: ".$ingreso;
        return Redirect::action('App\Modules\Facturacion\Controllers\FacturacionController@index', array('ingreso' => $ingreso));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        return View::make('Facturacion::create', array('ingreso' => Input::get('ingreso')));
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


        $evolucion = DB::connection('siis')->table('ingresos_salidas')->where('ingreso', '=', Input::get('ingreso'))->first();

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
            return \Illuminate\Support\Facades\Redirect::to('evoluciones?ingreso=' . Input::get('ingreso'))->with('alert', 'La nota ha sido creada  correctamente');
        } else {
            return \Illuminate\Support\Facades\Redirect::to('evoluciones?ingreso=' . Input::get('ingreso'))->with('alert', 'La nota no se ha podido crear');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($ingreso) {
        $evolucion = Facturacion::where('ingreso', '=', $ingreso)->first();
        $usuario = $this->getUsuario($evolucion->usuario_id);
        return View::make('Facturacion::show', array('evolucion' => $evolucion, 'usuario' => $usuario));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $evolucion = Facturacion::where('ingreso', '=', $id)->first();
        $usuario = $this->getUsuario($evolucion->usuario_id);
        return View::make('Facturacion::edit', array('evolucion' => $evolucion, 'usuario' => $usuario));
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        $evolucion['ingreso'] = Input::get('ingreso');
       // $evolucion['descripcion'] = Input::get('descripcion');
       // $evolucion['enfermedadactual'] = Input::get('enfermedadactual');
        $evolucion['usuario_id'] = Input::get('usuario');
        $evolucion['fecha_registro'] = Input::get('fecha_registro') . ' ' . Input::get('fecha_registro_hora');
        //$evolucion['sw_epicrisis'] = Input::get('sw_epicrisis');

       
       // DB::statement('ALTER TABLE hc_notas_enfermeria_descripcion DISABLE TRIGGER tg_ctl_hc_notas_enfermeria_descripcion'); 
        var_dump(Input::all());

        if ( $evolucion['fecha_registro'] == '' ) {
            return \Illuminate\Support\Facades\Redirect::to('facturacion/' . $id . '/edit')->with('alert', 'Los campos son obligatorios');
        }


        $res = DB::connection('siis')->table('ingresos_salidas')
                ->where('ingreso', $id)
                ->update($evolucion);

                 //***********FECHAS EN LA TABLA HC_EVOLUCIONES************
                $evolucione['fecha_cierre'] = Input::get('fecha_registro'). ' ' . Input::get('fecha_registro_hora');
                $evolucionf['evolucion_id'] = DB::connection('siis')->table('hc_evoluciones')->where('ingreso','=',$id)->max('evolucion_id');
                DB::connection('siis')->table('hc_evoluciones')
                ->where('ingreso', $id)
                ->where('evolucion_id',$evolucionf)
                ->update($evolucione);
                 //********************************************************

        if ($res == 1) {
            $evolucions['id_usuario'] = Auth::user()->id;
            $evolucions['nombre'] = Auth::user()->nombre;
            $evolucions['tabla'] = "ingresos_salidas";
            $evolucions['ingreso'] = Input::get('ingreso');
            DB::connection('mysql')->table('logs')
            ->insert($evolucions);
            return \Illuminate\Support\Facades\Redirect::to('facturacion?ingreso=' . $evolucion['ingreso'])->with('alert', 'La nota ha sido modificado correctamente');                
        } else {
            return \Illuminate\Support\Facades\Redirect::to('facturacion?ingreso=' . $evolucion['ingreso'])->with('alert', 'La nota no se ha podido modificar');
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

        $evoluciones = DB::connection('siis')->table('ingresos_salidas as ed')->select('ed.ingreso', 'ed.fecha_registro','ed.usuario_id','ed.observacion_salida', DB::raw('to_char(ed.fecha_registro, \'DD-MM-YYYY HH24:MI:SS\') as fecha_registro'), 'su.nombre')
                ->join('system_usuarios as su', 'ed.usuario_id', '=', 'su.usuario_id')
                ->where('ingreso', '=', $ingreso);



        return Datatable::query($evoluciones)
                        ->showColumns('ingreso','nombre','observacion_salida','fecha_registro')
                        ->searchColumns('ed.fecha_registro','su.nombre')
                        ->orderColumns('ingreso','nombre','observacion_salida','fecha_registro')
                        ->addColumn('acciones', function($model) {
                            $link = link_to('facturacion/' . $model->ingreso . '/edit', '', $attributes = array('class' => 'fa fa-edit', 'title' => 'editar'), $secure = null);
                            $link.=link_to('facturacion/' . $model->ingreso, '', $attributes = array('class' => 'fa fa-eye', 'title' => 'ver'), $secure = null);

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
