<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Login as Login_admin;
use App\Http\Controllers\Admin\User as User_admin;
use Illuminate\Http\Request;

Route::prefix('admin')->group(function(){

    Route::get('login', [Login_admin::class, 'index'])->name('login');
    
    Route::post('login', [Login_admin::class, 'autenticar'])->name('login');

    Route::match(['GET', 'POST'], '{pagina?}/{id?}/{extra?}', [Admin::class, 'index']);
    
});

Route::match(['GET', 'POST'], '{pagina?}/{id?}/{extra?}', [Site::class, 'index']);
