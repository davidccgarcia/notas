<?php

namespace App\Modules\Examen\Controllers;

use App\Modules\Examen\models\Cuenta;
use App\Modules\Examen\models\Hallazgo;
use App\Modules\Examen\models\Log;
use Response;
use Redirect;
use Input;
use View;
use Auth;
use DB;

class ExamenController extends \BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (! Input::get('cuenta')) {
            return View::make('Examen::index');
        }

        return View::make('Examen::index', [
            'examen' => $this->examen(Input::get('cuenta'))
        ]);
    }

    /**
    * Valida la fecha de la cuenta para el examen físico con el formato nuevo
    *
    * @param    int $numerodecuenta
    */
    private function validateAccountDate($numerodecuenta)
    {
        $fechaRegistro = Cuenta::cuenta($numerodecuenta)->first()->fecha_registro;
        $fechaRegistro = explode(' ', $fechaRegistro);

        if ($fechaRegistro[0] > $this->fechaLimite) {
            return View::make('Examen::index')
                ->with(
                    'alert',
                    'El examen físico para la cuenta '.$numerodecuenta.' tiene un nuevo formato'
                );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if ( $this->hasExam(Input::get('cuenta'))) {
            $this->hasExam(Input::get('cuenta'));
        } else {
            $evolucion = $this->hasEvolution(Input::get('cuenta'));

            return View::make('Examen::create', compact('evolucion'))
                            ->with('tiposSistemas', $this->systems());
        }

        return View::make('Examen::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        DB::connection('siis')->beginTransaction();

        try {
            $this->createFindings();

            $this->createMultipleRevisions();

            $this->hcEvolucionesSubmodulos();

            DB::connection('siis')->commit();

            $response['mensaje'] = 'SE HA REGISTRADO LOS DATOS EXITOSAMENTE';

        } catch (\Exception $e) {
            DB::connection('siis')->rollback();

            $response['error'] = 'ERROR: DATOS NO REGISTRADOS, LA EVOLUCIÓN '.Input::get('evolucion_id').' YA ESTÁ REGISTRADA';
        }

        return Response::json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $ingreso
     * @return Response
     */
    public function edit($ingreso)
    {
        $examen = Hallazgo::where('ingreso', '=', $ingreso)->first();

        return View::make('Examen::edit')->with('examen', $examen);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $ingreso
     * @return Response
     */
    public function update($ingreso)
    {
        $examen = Hallazgo::where('ingreso', '=', $ingreso)->first();

        $examen->hallazgo = Input::get('hallazgo');

        DB::connection('siis')->table('hc_revision_por_sistemas_hallazgos')
                            ->where('ingreso', $ingreso)
                            ->update(['hallazgo' => $examen->hallazgo]);

        $this->storeLog($ingreso);

        return Redirect::to('examen')->with('alert', 'Se ha editado el examen satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    * Get physical.
    *
    * @param int $numerodecuenta
    * @return array $hallazgo
    */
    private function examen($numerodecuenta)
    {
        $ingreso = $this->ingreso($numerodecuenta);

        if ($this->count($ingreso) == 0) {
            Redirect::to('examen')->with(
                'alert',
                "La cuenta $numerodecuenta no tiene examen físico o está creado con el nuevo formato, presione clic en el botón crear o editar examen físico"
            );
        }

        return Hallazgo::hallazgo($ingreso)->first();
    }

    /**
    * Count the number exam.
    *
    * @param  int  $ingreso
    * @return Response
    */
    private function count($ingreso)
    {
        return Hallazgo::hallazgo($ingreso)->count();
    }

    /**
    * Get ingreso_id
    *
    * @param  int  $numerodecuenta
    * @return  int ingreso.
    */
    private function ingreso($numerodecuenta)
    {
        if (! empty($numerodecuenta)) {
            return Cuenta::cuenta($numerodecuenta)->first()->ingreso;
        }
    }

    /**
    * Get evolution data.
    *
    * @param  int  $numerodecuenta.
    * @return array
    */
    private function evolucion($numerodecuenta)
    {
        if (! empty($numerodecuenta)) {
            return DB::connection('siis')
                    ->table('hc_evoluciones')
                    ->select('hc_evoluciones.evolucion_id',
                        'hc_evoluciones.ingreso',
                        'hc_evoluciones.fecha_registro',
                        'hc_evoluciones.fecha'
                    )
                    ->where('hc_evoluciones.numerodecuenta', '=', $numerodecuenta)
                    ->orderBy('hc_evoluciones.fecha_registro', 'desc')
                    ->first();
        }
    }

    /**
    * Check if has exam.
    *
    * @param  int  $numerodecuenta.
    */
    private function hasExam($numerodecuenta)
    {
        $ingreso = $this->ingreso($numerodecuenta);

        if ($this->count($ingreso) > 0) {
            return Redirect::to('examen')
                            ->with(
                                'alert',
                                "Esta cuenta ya tiene examen físico asociado al ingreso $ingreso"
                            );
        }
    }

    /**
    * Check if has evolution and return data to create view.
    *
    * @param  int  $numerodecuenta.
    */
    private function hasEvolution($numerodecuenta)
    {
        $evolucion = $this->evolucion(Input::get('cuenta'));

        if ( count($evolucion) > 0) {
            return $evolucion;
        }
    }

    /**
    * Get system types.
    *
    * @return  array.
    */
    private function systems()
    {
        return DB::connection('siis')
                ->table('hc_tipos_sistemas')
                ->select('tipo_sistema_id', 'nombre')
                ->get();
    }
    /**
    * Get user_id
    *
    * @return  Object usuario_id
    */
    private function user()
    {
        return DB::connection('siis')
                    ->table('system_usuarios')
                    ->select('usuario_id')
                    ->where('usuario', '=', Auth::user()->usuario)
                    ->first();
    }

    /**
    * Store a newly created resource in storage (Hallazgos)
    *
    * @return  mixed.
    */
    private function createFindings()
    {
        DB::connection('siis')
            ->table('hc_revision_por_sistemas_hallazgos')
            ->insert([
                'evolucion_id'      => Input::get('evolucion_id'),
                'ingreso'           => Input::get('ingreso'),
                'hallazgo'          => Input::get('hallazgo'),
                'usuario_id'        => $this->user()->usuario_id,
                'fecha_registro'    => Input::get('fecha')
            ]);
    }

    /**
    * Store multiples created resource in storage (hc_revision_por_sistemas).
    *
    * @return Response.
    */
    private function createMultipleRevisions()
    {
        foreach (Input::all()['data'] as $input) {
            DB::connection('siis')
                ->table('hc_revision_por_sistemas')
                ->insert([[
                    'tipo_sistema_id'   => $input['tipo_sistema'],
                    'evolucion_id'      => Input::get('evolucion_id'),
                    'ingreso'           => Input::get('ingreso'),
                    'sw_normal'         => $input['sw_normal']
                ]]);
        }
    }

    /**
    * Store a newly created resource in storage (hc_evoluciones_submodulos).
    *
    * @return Response.
    */
    private function hcEvolucionesSubmodulos()
    {
        DB::connection('siis')
            ->table('hc_evoluciones_submodulos')
            ->insert([
                'ingreso'       => Input::get('ingreso'),
                'evolucion_id'  => Input::get('evolucion_id'),
                'submodulo'     => 'ExamenFisico'
            ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  int  $ingreso
    * @return Response
    */
    private function storeLog($ingreso)
    {
        DB::connection('mysql')->table('logs')->insert([
            'id_usuario'    => Auth::user()->id,
            'nombre'        => Auth::user()->nombre,
            'tabla'         => 'hc_revision_por_sistemas_hallazgos',
            'ingreso'       => $ingreso
        ]);
    }

}
