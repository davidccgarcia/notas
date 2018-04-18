@extends('layouts.default')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file fa-fw" ></i> Facturacion

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart">


                        <div class="row" >
                           <div class="col-md-12">
                           <!--     <a     href="{{url('evoluciones/create?ingreso='.$ingreso)}}" class="btn btn-success">Agregar nueva Nota</a>-->
                                </br>
                                <hr>
                                {{ Datatable::table()
                                ->addColumn('Ingreso','Medico','Descripcion','Fecha Registro','Acciones')  
                                
                                ->setUrl(route('facturacion.list',array($ingreso)))
                       
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