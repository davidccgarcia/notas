<?php

class HomeController extends BaseController {

    
    public function index(){
        
        return View::make('home.index');
    }
    public function getDatatable() {
        
        $roles = DB::table('roles')->select('id','nombre');
        return Datatable::query($roles)
                        ->showColumns('id', 'nombre')
                        ->searchColumns('nombre')
                        ->orderColumns('id')
                        ->make();
    }

}
