<?php

use App\Http\Controllers\CetakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanggilController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', HomeController::class);
Route::resource('panggil', PanggilController::class);
Route::resource('role', RoleController::class);
Route::resource('cetak', CetakController::class);
