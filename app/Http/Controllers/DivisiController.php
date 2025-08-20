<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisiController extends Controller
{
    public function index($jenis, $divisi)
    {
        // Normalisasi: ganti minus (-) jadi underscore (_)
        $jenis = str_replace('-', '_', $jenis);

    }

       public function show($jenis, $divisi)
    {
        // Normalisasi input dari URL
        $jenis  = strtolower($jenis);   // data-mesin | alat-ukur
        $divisi = strtolower($divisi);  // kania | kapsel | kaprang | harkan | rekum

        // Validasi sederhana
        $allowedJenis  = ['data-mesin', 'alat-ukur'];
        $allowedDivisi = ['kania', 'kapsel', 'kaprang', 'harkan', 'rekum'];
        if (!in_array($jenis, $allowedJenis) || !in_array($divisi, $allowedDivisi)) {
            abort(404);
        }

        // Tentukan prefix tabel & nama tabel
        // data-mesin -> dml_*, alat-ukur -> dau_*
        $prefix = $jenis === 'data-mesin' ? 'dml' : 'dau';
        $table  = "{$prefix}_{$divisi}";    // contoh: dml_kania, dau_harkan, dst.

        // Ambil data dari tabel sesuai
        // (pakai paginate supaya view-mu yg pakai $data->links() tetap jalan)
        $data = DB::table($table)->paginate(20);

        // Tentukan view sesuai folder & nama file yang kamu punya
        // data_mesin/dmKania.blade.php, alat_ukur/dauKania.blade.php, dst
        $view = $jenis === 'data-mesin'
            ? "data_mesin.dml" . ucfirst($divisi)  // dmKania, dmHarkan, ...
            : "alat_ukur.dau" . ucfirst($divisi); // dauKania, dauHarkan, ...

        if (!view()->exists($view)) {
            abort(404, "View {$view}.blade.php tidak ditemukan.");
        }

        return view($view, compact('data', 'jenis', 'divisi'));
    }
}


   

