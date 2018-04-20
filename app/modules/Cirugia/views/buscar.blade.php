@extends('layouts.default')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <i class="fa fa-hotel fa-fw" ></i> Buscar Cirugia

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart">


                        <div class="row" >
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST" action="{{route('cirugias.buscar')}}">
                                    <div class="form-group">
                                        <label for="cuenta" class="col-sm-2 control-label">Cuenta</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="cuenta" name="cuenta" placeholder="Ingrese Cuenta" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> BUSCAR</button>
                                      
                                        </div>
                                    </div>
                                </form>

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