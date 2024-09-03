<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller{

    public function __construct(){
        $currentRoute = request()->route()->getName();

        if ($currentRoute !== 'login') {
            $userLogged = Auth::guard('admin')->check();
            if(!$userLogged){
                redirect('admin/login')->send();
            }
        }

    }

    public function index($id = null, $extra = null){

        $args = [];

        return view('admin/admin', ['pagina' => 'dashboard', 'args' => $args]);

    }

    public function inserir($id = null, $extra = null){

    }
    
}
