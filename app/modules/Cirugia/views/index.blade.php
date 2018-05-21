@extends('layouts.default')

@section('title', 'Cirugías')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="card border-sucess">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-hotel fa-fw" ></i> Cirugias

                </div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div id="morris-area-chart">


                        <div class="row" >
                           <div class="col-md-12">
                              
                                <hr>
                                {{ Datatable::table()
                                ->addColumn('Ingreso','Médico','Descripción','Fecha registro','Acciones')  
                                ->setUrl(route('cirugias.list',array($ingreso)))
                       
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