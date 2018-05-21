<?php

namespace App\Modules\ExamenII\Controllers;

use View;
use Input;
use Redirect;
use BaseController;
use App\Modules\Examen\models\Hallazgo;
use App\Modules\ExamenII\Models\Cuenta;
use App\Modules\ExamenII\Models\Usuario;
use App\Modules\ExamenII\Models\Sistemas;
use App\Modules\ExamenII\Controllers\CuentaController as Cuentas;
use App\Modules\ExamenII\Controllers\HcRevisionPorSistemasController;
use App\Modules\ExamenII\Controllers\EvolucionController as Evolucion;
use App\Modules\ExamenII\Controllers\HcEvolucionesSubmodulosController as Submodulos;

class ExamenIIController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('ExamenII::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $evoluciones = Evolucion::evolucion(Cuentas::ingreso(Input::get('cuenta')));
        $examenII = new HcRevisionPorSistemasController;

        $arr = (array)$evoluciones; // cast object to an array
        $arr = array_shift($arr); // delete first element of the array

        if (empty($arr)) {
            return Redirect::to('examenII')
                ->with('alert', 'Esta cuenta no tiene ninguna evolución');
        }

        foreach ($evoluciones as $evolucion) {

            $examen = Hallazgo::where('ingreso', $evolucion->ingreso)->get();

            // Buscar por cada evolucion si la cuenta tiene examenII físico
            $evoluciones = $evolucion;

            foreach ($examen as $sistema) {
                if ($sistema->hallazgo) {
                    return Redirect::to('examenII')
                        ->with( 'alert',
                                "La cuenta ".Input::get('cuenta').
                                " tiene examen físico con formato antiguo,
                                 Por favor editelo en el módulo Examen Físico I"
                            );
                }
            }

            if ($this->has($examenII, $evolucion)) {
                return Redirect::action(
                    'App\Modules\ExamenII\Controllers\ExamenIIController@edit',
                    [
                        'ingreso' => $evolucion->ingreso,
                        'evolucion' => $evolucion->evolucion_id
                    ]
                );
            }
        }

        $sistemas = Sistemas::tipos()->get();
        
        return View::make('ExamenII::create')
            ->with('hcEvolucion', $evoluciones)
            ->with('sistemas', $sistemas);
    }

    /**
    * Check if has exam
    *
    * @param Object $examenII
    * @param Object $evolucion
    *
    * @return array
    */
    public function has($examenII, $evolucion)
    {
        return count($examenII->index(
            $evolucion->ingreso, $evolucion->evolucion_id
        )) > 0;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $hcRevisionPorSistemas = new HcRevisionPorSistemasController();
        $submodulos = new Submodulos();

        $datos = [
            'sistemas'          => Input::get('tipo_sistema_id'),
            'evolucion_id'      => Input::get('evolucion_id'),
            'ingreso'           => Input::get('ingreso'),
            'hallazgo'          => Input::get('hallazgo'),
            'usuario_id'        => Input::get('usuario_id'),
            'fecha_registro'    => Input::get('fecha')
        ];

        $hcRevisionPorSistemas->store($datos);
        $submodulos->store($datos);

        return Redirect::action(
            'App\Modules\ExamenII\Controllers\ExamenIIController@show', [
                'ingreso'   => $datos['ingreso'],
                'evolucion' => $datos['evolucion_id']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $ingreso
     * @param  int  $evolucion
     * @return Response
     */
    public function show($ingreso, $evolucion)
    {
        $hcRevisionPorSistemas = new HcRevisionPorSistemasController;

        $examenII = $hcRevisionPorSistemas->index($ingreso, $evolucion);

        return View::make('ExamenII::show')
            ->with('message', 'ExamenII Físico creado exitosamente')
            ->with('examenII', $examenII);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $ingreso
     * @param  int  $evolucion
     * @return Response
     */
    public function edit($ingreso, $evolucion)
    {
        $hcRevisionPorSistemas = new HcRevisionPorSistemasController;

        $examenII = $hcRevisionPorSistemas->index($ingreso, $evolucion);

        return View::make('ExamenII::edit')
            ->with('evolucion', $examenII)
            ->with('ingreso', $ingreso)
            ->with('evolucionID', $evolucion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $ingreso
     * @param  int  $evolucionID
     * @return Response
     */
    public function update($ingreso, $evolucionID)
    {
        $hcRevisionPorSistemas = new HcRevisionPorSistemasController;

        $datos = [
            'sistemas'          => Input::get('tipo_sistema_id'),
            'hallazgo'          => Input::get('hallazgo')
        ];

        $hcRevisionPorSistemas->update($ingreso, $evolucionID, $datos);

        return Redirect::action(
            'App\Modules\ExamenII\Controllers\ExamenIIController@show', [
                'ingreso'   => $ingreso,
                'evolucion' => $evolucionID
        ]);
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

}
