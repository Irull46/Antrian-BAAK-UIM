<?php

use App\Http\Controllers\CallController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanggilController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TrafficController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::group(['prefix' => '/'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/ajax', [HomeController::class, 'ajax'])->name('home.ajax');
});

Route::group(['prefix' => 'profil'], function () {
    Route::get('/', [ProfilController::class, 'index'])->name('profil.index');
    Route::post('/ajax', [ProfilController::class, 'ajax'])->name('profil.ajax');
    Route::post('/ajax-form', [ProfilController::class, 'ajaxForm'])->name('profil.ajaxForm');
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

Route::group(['prefix' => 'panggil', 'middleware' => ['role:teller']], function () {
    Route::get('/', [PanggilController::class, 'index'])->name('panggil.index');
    Route::post('/ajax', [PanggilController::class, 'ajax'])->name('panggil.ajax');
    Route::post('/lanjut', [PanggilController::class, 'lanjut'])->name('panggil.lanjut');
    Route::post('/selesai', [PanggilController::class, 'selesai'])->name('panggil.selesai');
});

Route::group(['prefix' => 'traffic'], function () {
    Route::get('/', [TrafficController::class, 'index'])->name('traffic.index');
});

Route::post('/call', [CallController::class, 'call'])->name('call');
