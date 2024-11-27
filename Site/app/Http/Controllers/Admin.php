<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Spatie\SchemaOrg\Schema;

class Admin extends Controller{

    public function index(Request $request, $id = null, $extra = null){

        $pagina = $request->route('pagina', 'dashboard');
        $metodo = $request->isMethod('post') ? 'store' : 'index';

        $controllerClass = "App\\Http\\Controllers\\Admin\\" . ucfirst($pagina);

        if (class_exists($controllerClass) && method_exists($controllerClass, $metodo)) {
            $controllerClass = new $controllerClass();
            return $controllerClass->$metodo($request, $id, $extra);
        }

        abort(404);

    }
}
