<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login'); // login.blade.php di folder resources/views
})->name('login');

Route::get('/admin', function () {
    return view('admin'); // login.blade.php di folder resources/views
})->name('admin');

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

