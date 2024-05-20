<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller{
    
    public static function index(Request $request){
        
        $args       = [];
        
        // return view('site', ['pagina' => 'home', 'args' => $args]);
        return view('index');
    }
}
