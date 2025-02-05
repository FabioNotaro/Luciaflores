<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller{

    public function index(Request $request){

        $args = [];

        return view('admin', ['pagina' => 'dashboard', 'args' => $args]);

    }

    
}
