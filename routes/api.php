<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiPostController;


Route::post('/add', [ApiPostController::class, 'add']);
Route::get('/getAll', [ApiController::class, 'getAll']);
Route::delete('/delete/{id}', [ApiController::class, 'delete']);