        <?php

        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\DivisiController;
        use App\Http\Controllers\AuthController;
        use App\Http\Controllers\AdminController;



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


        /// ================= ADMIN =================
    Route::prefix('admin')->group(function () {
        // index: /admin/data-mesin/kania
        Route::get('/{jenis}/{divisi}', [AdminController::class, 'index'])
            ->where('jenis', 'data-mesin|alat-ukur')
            ->where('divisi', 'kania|kapsel|kaprang|harkan|rekum')
            ->name('admin.divisi');

        // create
        Route::get('/{jenis}/{divisi}/create', [AdminController::class, 'create'])->name('admin.create');

        // store
        Route::post('/{jenis}/{divisi}/store', [AdminController::class, 'store'])->name('admin.store');

        // edit
        Route::get('/{jenis}/{divisi}/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');

        // update
        Route::put('/{jenis}/{divisi}/{id}', [AdminController::class, 'update'])->name('admin.update');

        // delete
        Route::delete('/{jenis}/{divisi}/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    });
