@extends('layouts.default')

@section('title')
    Crear Examén Físico
@stop

@section('content')

<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-book" ></i> Registro Examén Físico

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart">

                        <div class="row" >
                            <div class="col-md-12">
                                @if ( ! empty($alert) )
                                    <strong>{{ $alert }}</strong>
                                @endif

                                <div id="alertMessage"></div>

                                <form class="form-horizontal" method="POST" action="{{route('examen.buscar')}}">
                                    <div class="form-group">
                                        <label for="cuenta" class="col-sm-2 control-label">Cuenta</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="cuenta" name="cuenta" placeholder="Ingrese Cuenta" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-search fa-fw"></i> BUSCAR</button>
                                        </div>
                                    </div>
                                </form>
                                
                                @if (! empty($hcEvolucion))
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Ingreso</th>
                                                    <th>Descripción</th>
                                                    <th>Fecha Registro</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>#{{ $hcEvolucion->ingreso }} </th>
                                                    <td class="text-justify">{{ $hcEvolucion->descripcion }}</td>
                                                    <td>{{ $hcEvolucion->fecha_registro }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    {{ Form::open(array('route' => array('examen.store'), 'method' => 'POST', 'id' => 'form-examen', 'class' => 'form-examen form-horizontal', 'role' => 'form') ) }}

                                    {{ Form::hidden('ingreso', $hcEvolucion->ingreso, ['id' => 'ingreso']) }}
                                    {{ Form::hidden('evolucion_id', $hcEvolucion->evolucion_id, ['id' => 'evolucion_id']) }}

                                    <div class="table-responsive col-md-6 scrollable">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sistema</th>
                                                    <th class='text-center'>Normal</th>
                                                    <th class='text-center'>Anormal</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $i = 0; ?>
                                                @foreach ($hcTiposSistemas as $tipo)
                                                    <?php $i++; ?>
                                                    <tr>
                                                        <td>{{ $tipo->nombre }}</td>
                                                        {{-- <td><input type="radio" class="sw_normal" name="sw_normal_{{ $i }}" value="N"></td>
                                                        <td><input type="radio" class="sw_normal" name="sw_normal_{{ $i }}" value="A"></td> --}}
                                                        <td class='text-center'>{{ Form::radio("sw_nomal_$i", 'N', false, ['tipo_sistema' => $tipo->tipo_sistema_id, 'class' => 'sw_normal']) }}</td>
                                                        <td class='text-center'>{{ Form::radio("sw_nomal_$i", 'A', false, ['tipo_sistema' => $tipo->tipo_sistema_id, 'class' => 'sw_normal']) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::textarea('hallazgo', null, array(
                                                'class'         => 'form-control', 
                                                'placeholder'   => 'Descripción del hallazgo', 
                                                'type'          => 'textarea',
                                                'id'            => 'hallazgo'
                                                )) 
                                            }}
                                        </div>
                                        
                                        <div class="form-group">
                                            
                                        </div>

                                        <div class="form-group">
                                            {{ Form::submit('Registrar', array('id' => 'save', 'class' => 'btn btn-primary')) }}
                                        </div>

                                    </div>
                                {{ Form::close() }}
                                @endif
                            </div>
                            {{-- <div class="col-md-12">
                                {{ Form::open(array('route' => array('examen.store'), 'method' => 'POST'), array('role' => 'form', 'class' => 'form-horizontal')) }}
                                    <div class="table-responsive col-md-6 scrollable">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sistema</th>
                                                    <th class='text-center'>Normal</th>
                                                    <th class='text-center'>Anormal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($hcTiposSistemas as $tipo)
                                                    <tr>
                                                        <td>{{ $tipo->nombre }}</td>
                                                        <td class='text-center'>{{ Form::radio('sw_' . $tipo->tipo_sistema_id, 'N', false) }}</td>
                                                        <td class='text-center'>{{ Form::radio('sw_' . $tipo->tipo_sistema_id, 'A', false) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::textarea('hallazgo', null, array(
                                                'class'         => 'form-control', 
                                                'placeholder'   => 'Descripción del hallazgo', 
                                                'type'          => 'textarea'
                                                )) 
                                            }}
                                        </div>
                                        
                                        <div class="form-group">
                                            
                                        </div>

                                        <div class="form-group">
                                            {{ Form::submit('Registrar', array('class' => 'btn btn-primary')) }}
                                        </div>

                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>
 --}}

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