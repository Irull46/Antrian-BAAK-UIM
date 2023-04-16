<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanggilController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', HomeController::class);
Route::get('panggil', [PanggilController::class, 'index']);
