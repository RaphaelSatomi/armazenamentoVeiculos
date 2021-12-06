<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

Route::prefix('/')->group(function(){

    Route::get('/register', [AdminController::class, 'register']);

    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'loginAction']);

    Route::get('/logout', [AdminController::class, 'logout']);

    Route::get('/', [AdminController::class, 'index']);

    Route::get('/lista', [AdminController::class, 'lista']);

});
