<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site;
use App\Http\Controllers\Admin;

Route::prefix('admin')->group(function(){
    Route::match(['GET', 'POST'], '{pagina?}/{id?}/{extra?}', [Admin::class, 'index']);
});

Route::match(['GET', 'POST'], '{pagina?}/{id?}/{extra?}', [Site::class, 'index']);
