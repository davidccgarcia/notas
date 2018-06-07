@extends('layouts.default')

@section('title', 'Examen Físico')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="card border-success">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-stethoscope"></i> Buscar Evolución

                </div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div id="morris-area-chart">


                        <div class="row" >
                            <div class="col-md-12">
                                {{ Form::open(['route' => 'examenII.buscar', 'class' => 'form-horizontal', 'mehtod' => 'POST']) }}
                                    <input type="number" min="1" id="cuenta" class="form-control search" placeholder="Ingrese cuenta" name="cuenta" required>
                                    <button type="submit" class="btn btn-primary search-button"><i class="fa fa-search fa-fw"></i></button>
                                {{ Form::close() }}

                            </div>

                            <div class="col-md-12">
                                {{ Form::open(['route' => ['examenII.update', $ingreso, $evolucionID], 'class' => 'form-horizontal', 'mehtod' => 'PATCH']) }}

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Sistema</th>
                                                <th class="text-center">Normal</th>
                                                <th class="text-center">Anormal</th>
                                                <th class="text-center">Hallazgo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($evolucion as $sistema)
                                            {{ Form::hidden('parametros', $sistema->hallazgo,
                                                [
                                                    'class' => 'parametros',
                                                    'id'    => 'hallazgo_'.$sistema->tipo_sistema_id.'_N'
                                                ]
                                            ) }}
                                            <tr>
                                                <th scope="row">{{ $sistema->nombre }}</th>
                                                <td class="text-center">
                                                    {{
                                                        Form::radio(
                                                            'tipo_sistema_id['.$sistema->tipo_sistema_id.']',
                                                            $sistema->tipo_sistema_id.'_N',
                                                            (($sistema->sw_normal == 'N') ? true : false),
                                                            [
                                                                'class' => 'selectedNormal',
                                                                'id' => 'tipo_sistema_id_'.$sistema->tipo_sistema_id.'_N'
                                                            ]
                                                        )
                                                    }}
                                                </td>
                                                <td class="text-center">
                                                    {{
                                                        Form::radio(
                                                            'tipo_sistema_id['.$sistema->tipo_sistema_id.']',
                                                            $sistema->tipo_sistema_id.'_A',
                                                            (($sistema->sw_normal == 'A') ? true : false),
                                                            [
                                                                'class' => 'unselectedAnormal',
                                                                'id' => 'tipo_sistema_id_'.$sistema->tipo_sistema_id.'_A'
                                                            ]
                                                        )
                                                    }}
                                                </td>
                                                <td>
                                                    {{ Form::textarea('hallazgo['.$sistema->tipo_sistema_id.']', $sistema->hallazgo, [
                                                        'class' => 'form-control hallazgo',
                                                        'rows' => 2,
                                                        'id' => 'hallazgo_'.$sistema->tipo_sistema_id.'_A'
                                                    ]) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <div class="col-sm-12 text-right">
                                            <button type="submit" class="btn btn-warning"> Modificar</button>
                                        </div>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>


                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

        </div>
        <!-- /.col-lg-8 -->

        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->

</div>




@stop

@section('script')



@stop
