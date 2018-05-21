@extends('layouts.default')

@section('title', 'Motivo de consulta')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="card border-success">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-file fa-fw" ></i> Motivo de Consulta

                </div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div id="morris-area-chart">


                        <div class="row" >
                           <div class="col-md-12">
                           <!--     <a     href="{{url('evoluciones/create?ingreso='.$ingreso)}}" class="btn btn-success">Agregar nueva Nota</a>-->
                                </br>
                                <hr>
                                {{ Datatable::table()
                                ->addColumn('Ingreso','Médico','Descripción','Fecha registro','Acciones')  
                                
                                ->setUrl(route('motivo.list',array($ingreso)))
                       
                                ->render() }}

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