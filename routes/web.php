<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin dashboard
Route::get('/admin', [AuthController::class, 'dashboard'])->name('admin');

// Dinamis: /data-mesin/kania atau /alat-ukur/kaprang, dll
Route::get('/{jenis}/{divisi}', [DivisiController::class, 'show'])
    ->where('jenis', 'data-mesin|alat-ukur')
    ->where('divisi', 'kania|kapsel|kaprang|harkan|rekum');


/*Route::get('/{jenis}/{divisi}', [DivisiController::class, 'index']);*/

/*Route::get('/{jenis}/{divisi}', [DivisiController::class, 'show'])
    ->where('jenis', 'data-mesin|alat-ukur');

Route::get('/{jenis}/{divisi}', function ($jenis, $divisi) {
    return "Halaman $jenis - Divisi $divisi";
});*/

