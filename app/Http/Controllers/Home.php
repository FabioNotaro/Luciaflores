<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller{
    
    public static function index($id = null, $extra = null){

        $args = [];

        return view('site', ['pagina' => 'home', 'args' => $args]);

    }

    public static function inserir($id = null, $extra = null){

    }
}
