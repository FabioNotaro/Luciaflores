<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller{

    public static function index($id = null, $extra = null){

        $args = [];

        return view('admin/admin', ['pagina' => 'dashboard', 'args' => $args]);

    }

    public static function inserir($id = null, $extra = null){

    }
    
}
