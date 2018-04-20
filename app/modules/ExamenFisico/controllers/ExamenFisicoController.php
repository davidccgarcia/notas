<?php

namespace App\Modules\ExamenFisico\Controllers;

use View,
    DB,
    Datatable,
    Form,
    Response,
    Validator,
    Redirect,
    Input, 
    Request,
    Auth,
    Illuminate\Database\QueryException;

class ExamenFisicoController extends \BaseController {

    public function index()
    {
        return View::make('ExamenFisico::index');
    }

    public function store()
    {

        DB::connection('siis')->beginTransaction();

        try {
            $usuario_id = $this->getUserFromSession()[0]->usuario_id;

            $data = Input::all();

            DB::connection('siis')
                ->table('hc_revision_por_sistemas_hallazgos')
                ->insert([
                    [
                        'evolucion_id'  => $data['evolucion_id'], 
                        'ingreso'       => $data['ingreso'],
                        'hallazgo'      => $data['hallazgo'], 
                        'usuario_id'    => $usuario_id
                    ]
                ]);

            foreach ($data['data'] as $input) {

                DB::connection('siis')
                    ->table('hc_revision_por_sistemas')
                    ->insert([
                        [
                            'tipo_sistema_id'   => $input['tipo_sistema'], 
                            'evolucion_id'      => $data['evolucion_id'], 
                            'ingreso'           => $data['ingreso'], 
                            'sw_normal'         => $input['sw_normal']
                        ]
                    ]);
            }

        DB::connection('siis')->commit();

        $response['mensaje'] = 'SE HAN REGISTRADO LOS DATOS EXITOSAMENTE';

        } catch(QueryException $e) {

            DB::connection('siis')->rollback();

            $response['error'] = "ERROR: DATOS NO REGISTRADOS, LA EVOLUCIÓN {$data['evolucion_id']} YA ESTA REGISTRADA";

        }
        
        return Response::json($response);
    }

    public function search()
    {
        /**/


        $cuenta = Input::get('cuenta');

        $ingreso = DB::connection('siis')
                            ->table('cuentas')
                            ->select('ingreso')
                            ->where('numerodecuenta', '=', $cuenta)
                            ->get();

//        select ingreso from cuentas where numerodecuenta = 360908;
        
        $tieneHallazgos = DB::connection('siis')
                            ->table('hc_revision_por_sistemas_hallazgos')
                            ->select('ingreso')
                            ->where('ingreso', '=', $ingreso[0]->ingreso)
                            ->get();

        // dd($tieneHallazgos);
        if ( ! empty($tieneHallazgos) ) {
            return  Redirect::to('examen')
                        ->with('alert', "Esta cuenta ya tiene exámen físico asociado al ingreso #{$ingreso[0]->ingreso} ");
        }
        $hcEvolucion = DB::connection('siis')
                ->table('hc_evoluciones')
                ->select('hc_evoluciones.evolucion_id', 
                    'hc_evoluciones.ingreso', 
                    'hc_evoluciones.fecha_registro', 
                    'hc_evolucion_descripcion.descripcion'
                )
                ->join('hc_evolucion_descripcion', 
                    'hc_evoluciones.evolucion_id', 
                    '=', 
                    'hc_evolucion_descripcion.evolucion_id'
                )
                ->where('hc_evoluciones.numerodecuenta', '=', $cuenta)
                ->orderBy('hc_evoluciones.fecha_registro', 'desc')
                ->first();

        if ( count($hcEvolucion) > 0) {

            $hcTiposSistemas = $this->getTiposSistemas();

            return View::make('ExamenFisico::index', 
                    compact('hcEvolucion'))
                    ->with('hcTiposSistemas', $hcTiposSistemas);
        }

        return  Redirect::to('examen')
                        ->with('alert', "La cuenta {$cuenta} no tiene evoluciones asociadas");
        
    }

    public function getUserFromSession()
    {
        $user = DB::connection('siis')
                ->table('system_usuarios')
                ->select('usuario_id')
                ->where('usuario', '=', Auth::user()->usuario)
                ->get();

        return $user;

    }

    protected function getTiposSistemas()
    {
        return DB::connection('siis')
                ->table('hc_tipos_sistemas')
                ->select('tipo_sistema_id', 'nombre')
                ->get();
    }
}
