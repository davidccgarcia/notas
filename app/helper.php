<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('isAdmin')) {

    /**
     * si es admin =>true
     * 
     */
    function isAdmin() {
        if (\Illuminate\Support\Facades\Auth::user()->rol_id == 1) {
            return true;
        } else {
            return false;
        }
    }

}

if (!function_exists('isLider')) {

    /**
     * si es lider =>true
     * 
     */
    function isLider() {
        if (\Illuminate\Support\Facades\Auth::user()->rol_id == 2) {
            return true;
        } else {
            return false;
        }
    }

}



if (!function_exists('isUsuario')) {

    /**
     * si es usuario =>true
     * 
     */
    function isUsuario() {
        if (\Illuminate\Support\Facades\Auth::user()->rol_id == 3) {
            return true;
        } else {
            return false;
        }
    }

}