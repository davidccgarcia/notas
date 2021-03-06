@extends('layouts.default')

@section('title') Cirugía @stop

@section('content')

<div  id="contenView">
    <!-- /.row -->
    <div class="row" >
        <div class="col-lg-12">
            <div class="card border-success">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-hotel fa-fw" ></i> Buscar Cirugia
                </div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div id="morris-area-chart">
                        <div class="row" >
                            <div class="col-md-12">
                                <form class="form-horizontal" method="POST" action="{{route('cirugias.buscar')}}">
                                    <input type="number" min="1" id="cuenta" class="form-control search" placeholder="Ingrese cuenta" name="cuenta" required>
                                    <button type="submit" class="btn btn-primary search-button"><i class="fa fa-search fa-fw"></i></button>
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
