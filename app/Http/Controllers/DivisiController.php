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


    /*
     // Halaman Harkan
    public function dauHarkan()
    {
        $data = DataMesin::where('divisi', 'Harkan')->get();
        return view('dauHarkan', compact('data'));
    }

    // Halaman Kania
    public function dauKania()
    {
        $data = DataMesin::where('divisi', 'Kania')->get();
        return view('dauKania', compact('data'));
    }

    // Halaman Kaprang
    public function dauKaprang()
    {
        $data = DataMesin::where('divisi', 'Kaprang')->get();
        return view('dauKaprang', compact('data'));
    }

    // Halaman Kapsel
    public function dauKapsel()
    {
        $data = DataMesin::where('divisi', 'Kapsel')->get();
        return view('dauKapsel', compact('data'));
    }

    // Halaman Rekum
    public function dauRekum()
    {
        $data = DataMesin::where('divisi', 'Rekum')->get();
        return view('dauRekum', compact('data'));
    }
    */


        /*
        // Sesuaikan model yang dipakai
        if ($jenis == 'alat_ukur') {
            $model = AlatUkur::class;
        } elseif ($jenis == 'data_mesin') {
            $model = DataMesin::class;
        } else {
            abort(404, "Jenis tidak ditemukan");
        }

        // Ambil data berdasarkan divisi
        $data = $model::where('divisi', $divisi)->get();

        // Tentukan nama view sesuai folder
        $view = $jenis . '.' . $divisi;

        // Kirim ke view
        return view($view, compact('data'));
    }
*/
    /*
    public function show($jenis, $divisi)
    {
         // Normalisasi: ganti minus (-) jadi underscore (_)
        $jenis = str_replace('-', '_', $jenis);
        // Bikin logika untuk arahkan ke blade sesuai jenis & divisi
        // Misal kalau jenis = alat_ukur dan divisi = kania
        if ($jenis === 'alat_ukur') {
            return view("alat_ukur.dau" . ucfirst($divisi));
        } elseif ($jenis === 'data_mesin') {
            return view("data_mesin.dml" . ucfirst($divisi));
        }

        abort(404); // kalau tidak cocok
    }*/
    

