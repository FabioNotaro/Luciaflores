<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Functions;

class RoutingController extends Controller{
    
    public function index(Request $request){

        $page       = !empty($request->pagina) ? $request->pagina : 'home';
        $controller = Functions::getController($page);
        $method     = $request->getMethod() == 'POST' ? 'inserir' : 'index';

        if(method_exists($controller, $method)):
            return App::call("{$controller}@{$method}");
        endif;

    }
}
