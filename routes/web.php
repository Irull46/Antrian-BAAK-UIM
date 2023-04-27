<?php

use App\Http\Controllers\CetakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanggilController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', HomeController::class);

Route::middleware(['role:admin'])->group(function () {
    Route::resource('role', RoleController::class);
    Route::resource('cetak', CetakController::class);
});

Route::middleware(['role:teller'])->group(function () {
    Route::resource('panggil', PanggilController::class);
});