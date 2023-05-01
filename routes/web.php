<?php

use App\Http\Controllers\CetakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanggilController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', HomeController::class);

Route::group(['prefix' => 'profil'], function () {
    Route::get('/', [ProfilController::class, 'index'])->name('profil.index');
    Route::patch('/update', [ProfilController::class, 'update'])->name('profil.update');
});

Route::group(['prefix' => 'role', 'middleware' => ['role:admin']], function () {
    Route::get('/', [RoleController::class, 'index'])->name('role.index');
    Route::get('/datatable', [RoleController::class, 'datatable'])->name('role.datatable');
    Route::patch('/update', [RoleController::class, 'update'])->name('role.update');
});

Route::group(['prefix' => 'cetak', 'middleware' => ['role:admin']], function () {
    Route::get('/', [CetakController::class, 'index'])->name('cetak.index');
    Route::post('/cetak', [CetakController::class, 'cetak'])->name('cetak.cetak');
});

Route::middleware(['role:teller'])->group(function () {
    Route::resource('panggil', PanggilController::class);
});