<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class Register extends Controller
{

    public function index(Request $request){
        $args = [];
        return view('admin/register', ['pagina' => 'register', 'args' => $args]);

    }

    public function store(Request $request){
        
    }
}
