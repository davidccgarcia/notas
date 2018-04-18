<?php

namespace App\Modules\ExamenII\Controllers;

use App\Modules\ExamenII\Models\HcRevisionPorSistemas;
use BaseController;
use DB;

class HcRevisionPorSistemasController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($ingreso, $evolucion)
    {
        return HcRevisionPorSistemas::join('hc_tipos_sistemas', 'hc_tipos_sistemas.tipo_sistema_id', '=', 'hc_revision_por_sistemas.tipo_sistema_id')
            ->where('ingreso', $ingreso)
            ->where('evolucion_id', $evolucion)
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(array $datos = [])
    {
        foreach ($datos['sistemas'] as $key => $value) {

            $tipoSistemaID = explode('_', $value);

            HcRevisionPorSistemas::insert([[
                'tipo_sistema_id'  => $tipoSistemaID[0],
                'evolucion_id'     => $datos['evolucion_id'],
                'ingreso'          => $datos['ingreso'],
                'sw_normal'        => $tipoSistemaID[1],
                'hallazgo'         => $datos['hallazgo'][$key],
                'usuario_id'       => $datos['usuario_id'],
                'fecha_registro'   => $datos['fecha_registro']
            ]]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $ingreso
     * @param  int  $evolucionID
     * @return Response
     */
    public function update($ingreso, $evolucionID, array $datos = [])
    {
        foreach ($datos['sistemas'] as $key => $value) {

            $tipoSistemaID = explode('_', $value);

            DB::connection('siis')
                ->table('hc_revision_por_sistemas')
                ->where('ingreso',  $ingreso)
                ->where('evolucion_id', $evolucionID)
                ->where('tipo_sistema_id', $tipoSistemaID[0])
                ->update([
                    'sw_normal' => $tipoSistemaID[1],
                    'hallazgo'  => $datos['hallazgo'][$key]
                ]);
        }
    }

}
