<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Login;

Route::prefix('admin')->group(function(){

    Route::get('login', [Login::class, 'index'])->name('login');
    
    Route::post('login', [Login::class, 'autenticar'])->name('login');

    Route::match(['GET', 'POST'], '{pagina?}/{id?}/{extra?}', [Admin::class, 'index'])->middleware('auth');
    
});

Route::match(['GET', 'POST'], '{pagina?}/{id?}/{extra?}', [Site::class, 'index']);
