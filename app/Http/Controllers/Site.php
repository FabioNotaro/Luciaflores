<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Spatie\SchemaOrg\Schema;

class Site extends Controller{
    
    public function index(Request $request, $id = null, $extra = null){

        $pagina = $request->route('pagina', 'home');
        $metodo = $request->isMethod('post') ? 'inserir' : 'index';

        $controllerClass = "App\\Http\\Controllers\\" . ucfirst($pagina);

        if (class_exists($controllerClass) && method_exists($controllerClass, $metodo)) {
            return App::call([$controllerClass, $metodo], ['id' => $id, 'extra' => $extra]);
        }

        abort(404);
    }

}
