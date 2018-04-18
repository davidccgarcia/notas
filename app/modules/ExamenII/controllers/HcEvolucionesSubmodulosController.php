<?php

namespace App\Modules\ExamenII\Controllers;

use App\Modules\ExamenII\Models\HcEvolucionesSubmodulos as Submodulos;
use BaseController;

class HcEvolucionesSubmodulosController extends BaseController
{
    const SUBMODULO = 'Examen_FisicoII';
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(array $datos = [])
    {
        Submodulos::insert([
            'ingreso'           => $datos['ingreso'],
            'evolucion_id'      => $datos['evolucion_id'],
            'submodulo'         => self::SUBMODULO,
            'fecha_registro'    => $datos['fecha_registro']
        ]);
    }
}
