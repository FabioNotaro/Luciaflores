<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Register extends Controller
{

    public function index(Request $request){
        $args = [];
        return view('admin/register', ['pagina' => 'register', 'args' => $args]);

    }

    public function store(Request $request){
        dd($request->all());
    }

}
