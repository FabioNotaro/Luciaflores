<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;

Route::match(['GET', 'POST'], '{pagina?}/{id?}/{extra?}/{extra2?}/{extra3?}/{extra4?}', [RoutingController::class, 'index']);