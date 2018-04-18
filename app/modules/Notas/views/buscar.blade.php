@extends('layouts.default')

@section('content')
<br>
<div  id="contenView">

    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-heart fa-fw" ></i> Buscar Nota

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart">


                        <div class="row" >
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST" action="{{route('notas.buscar')}}">
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