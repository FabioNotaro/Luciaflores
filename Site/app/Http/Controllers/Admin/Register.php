<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Register extends Controller
{

    public function index(Request $request){
******
        // $usuarioLogado = Auth::guard('admin')->check();
        // if($usuarioLogado){
        //     redirect('admin/dashboard')->send();
        // }

        $args = [];
        // $args['title'] = 'Lucia Flores - Floricultura';
        // $args['msg'] = false;

        return view('admin/register', ['pagina' => 'login', 'args' => $args]);

    }
}
