<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;



Route::get('/', function () {
    return view('public.home');
});

Route::get('/lapor-kehilangan', function () {
    return view('public.lapor-kehilangan');
});

Route::get('/lapor-temuan', function () {
    return view('public.lapor-temuan');
});

Route::get('/daftar-barang', [PublicController::class, 'daftarBarang']);


Route::get('/admin/login', function () {
    return view('admin.login');
});

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/laporan-kehilangan', [DashboardController::class, 'lost']);

    Route::get('/laporan-temuan', [DashboardController::class, 'found']);

    Route::post('/laporan-kehilangan/{id}/verifikasi', [DashboardController::class, 'verifyLost']);
    Route::post('/laporan-temuan/{id}/verifikasi', [DashboardController::class, 'verifyFound']);

    Route::get('/klaim', [DashboardController::class, 'klaim']);

    Route::post('/klaim/{id}/terima', [DashboardController::class, 'terimaKlaim']);
    Route::post('/klaim/{id}/tolak', [DashboardController::class, 'tolakKlaim']);

});



Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout']);

Route::post('/lapor-kehilangan', [PublicController::class, 'storeLost']);
Route::post('/lapor-temuan', [PublicController::class, 'storeFound']);

Route::get('/klaim/{type}/{id}', [PublicController::class, 'showClaimForm']);
Route::post('/klaim', [PublicController::class, 'storeClaim']);

Route::get('/admin/klaim/{id}/export-pdf',
    [DashboardController::class, 'exportKlaimPdf']
)->name('admin.klaim.export-pdf');
