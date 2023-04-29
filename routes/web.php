<?php

use App\Http\Controllers\CetakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanggilController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', HomeController::class);

Route::group(['prefix' => 'role', 'middleware' => ['role:admin']], function () {
    Route::get('/', [RoleController::class, 'index'])->name('role.index');
    Route::patch('/datatable', [RoleController::class, 'datatable'])->name('role.datatable');
    Route::patch('/update', [RoleController::class, 'update'])->name('role.update');
});

Route::resource('cetak', CetakController::class);

Route::middleware(['role:teller'])->group(function () {
    Route::resource('panggil', PanggilController::class);
});