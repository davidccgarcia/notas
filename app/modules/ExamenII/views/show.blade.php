@extends('layouts.default')

@section('title', 'Examen Físico/Mental')

@section('content')
<br>

<div  id="contenView">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-success">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-stethoscope"></i> Examen Físico/Mental
                </div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div id="morris-area-chart">


                        <div class="row" >
                            @if (isset($message) && isset($examenII))
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {{ $message }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <a href="{{ route('examenII.index') }}" class="btn btn-sm btn-primary">Volver</a>
                                <br><br>
                                <table class="table table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Sistema</th>
                                            <th>Estado</th>
                                            <th>Hallazgo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($examenII as $datos)
                                        <tr>
                                            <th scope="row">{{ $datos->nombre}}</th>
                                            <td>
                                                @if ($datos->sw_normal == 'N')
                                                    NORMAL
                                                @else
                                                    <span class="label label-danger">ANORMAL</span>
                                                @endif
                                            </td>
                                            <td>{{ $datos->hallazgo }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <a href="{{ route('examenII.index') }}" class="btn btn-sm btn-primary">Volver</a>
                            </div>
                            @endif
                        </div>


                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

        </div>
        <!-- /.col-lg-8 -->
    </div> <!-- /.row -->
</div>

@stop

@stop
