<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/', fn () => view('public.home'));

// Rute untuk Form Lapor
Route::get('/lapor-kehilangan', fn () => view('public.lapor-kehilangan'));
Route::get('/lapor-temuan', fn () => view('public.lapor-temuan'));
Route::post('/lapor-kehilangan', [PublicController::class, 'storeLost']);
Route::post('/lapor-temuan', [PublicController::class, 'storeFound']);

// Rute untuk Daftar Barang (Dipisah)
Route::get('/barang-hilang', [PublicController::class, 'daftarLost'])->name('public.lost');
Route::get('/barang-temuan', [PublicController::class, 'daftarFound'])->name('public.found');
Route::get('/barang-selesai', [PublicController::class, 'daftarSelesai']);

Route::get('/chat/get-messages', [ChatController::class, 'getMessages']);
Route::post('/chat/send', [ChatController::class, 'sendMessage']);

// Rute Klaim
Route::get('/klaim/{type}/{id}', [PublicController::class, 'showClaimForm']);
Route::post('/klaim', [PublicController::class, 'storeClaim']);

// Rute Admin
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan-kehilangan', [DashboardController::class, 'lost'])->name('laporan-kehilangan');
    Route::get('/laporan-temuan', [DashboardController::class, 'found'])->name('laporan-temuan');
    Route::post('/laporan-kehilangan/{id}/verifikasi', [DashboardController::class, 'verifyLost'])->name('laporan-kehilangan.verifikasi');
    Route::post('/laporan-temuan/{id}/verifikasi', [DashboardController::class, 'verifyFound'])->name('laporan-temuan.verifikasi');
    Route::get('/rekap-kehilangan', [DashboardController::class, 'rekapKehilangan'])->name('rekap.kehilangan');
    Route::get('/rekap-temuan', [DashboardController::class, 'rekapTemuan'])->name('rekap.temuan');
    Route::get('/klaim', [DashboardController::class, 'klaim'])->name('klaim.index');
    Route::get('/klaim/{id}/detail', [DashboardController::class, 'detailKlaim'])->name('klaim.detail');
    Route::post('/klaim/{id}/terima', [DashboardController::class, 'terimaKlaim'])->name('klaim.terima');
    Route::post('/klaim/{id}/tolak', [DashboardController::class, 'tolakKlaim'])->name('klaim.tolak');
    Route::get('/klaim/{id}/export-pdf', [DashboardController::class, 'exportKlaimPdf'])->name('klaim.export-pdf');

    Route::get('/messages', [ChatController::class, 'adminIndex'])->name('messages.index');
    Route::post('/messages/reply', [ChatController::class, 'adminReply'])->name('messages.reply');
});
