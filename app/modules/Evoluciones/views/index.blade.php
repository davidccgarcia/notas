@extends('layouts.default')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <i class="fa fa-heart fa-fw" ></i> Evoluciones

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart">


                        <div class="row" >
                           <div class="col-md-12">
                                <?php                                    
                                    $cont = DB::connection('siis')->table('hc_evolucion_descripcion')->where('ingreso', '=', $ingreso)->count();
                                    if($cont>0){
                                ?>
                                <a href="{{url('evoluciones/create?ingreso='.$ingreso)}}" class="btn btn-success">Agregar nueva Evolucion</a>

                                </br>
                                <hr>
                                {{ Datatable::table()
                                ->addColumn('Ingreso','Medico','Descripcion','Fecha Registro','Acciones')  
                                ->setUrl(route('evoluciones.list',array($ingreso)))
                       
                                ->render() }}
                                <?php 
                                }else{ 
                                    echo "<script>alert('Esta Cuenta NO tiene ninguna Evolucion...')</script>";
                                    echo ("<p style='color:red;font-size:50px;'>No se puede realizar modificaciones y/o crear nuevas evoluciones...</p>");
                                 }
                                 ?>
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