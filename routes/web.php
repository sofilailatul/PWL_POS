<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+'); //artinya ketika ada parameter {id}, maka harus berupa angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'postRegister']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [WelcomeController::class, 'index']);

    // route user
    Route::group(['prefix' => 'user', 'middleware'=>'authorize:ADM'], function() {
        Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
        Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam json untuk datables
        Route::get('/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
        Route::post('/', [UserController::class,'store']);          // menyimpan data user baru
        Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']); // Menampilkan data user baru Ajax
        Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
        Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']); 
        Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
        Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
        Route::get('/import', [UserController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [UserController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel',[usercontroller::class,'export_excel']); // ajax export excel
        Route::get('/export_pdf',[usercontroller::class,'export_pdf']); //ajax export pdf
    });

    //route level
    Route::group(['prefix' =>'level', 'middleware' => 'authorize:ADM'],function(){
        Route::get('/', [LevelController::class, 'index']);          // menampilkan halaman awal level
        Route::post('/list', [LevelController::class, 'list']);      // menampilkan data level dalam json untuk datables
        Route::get('/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
        Route::post('/', [LevelController::class,'store']);          // menyimpan data level baru
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah level Ajax
        Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menampilkan data level baru Ajax
        Route::get('/{id}', [LevelController::class, 'show']);       // menampilkan detail level
        Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']); 
        Route::get('/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit level
        Route::put('/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data level
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit level Ajax
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data level Ajax
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete level Ajax
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk hapus data level Ajax
        Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
        Route::get('/import', [LevelController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [LevelController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel',[levelcontroller::class,'export_excel']); // ajax export excel
        Route::get('/export_pdf',[levelcontroller::class,'export_pdf']); //ajax export pdf
    });

    //route kategori
    Route::group(['prefix' =>'kategori','middleware'=>'authorize:ADM,MNG,STF'],function(){
        Route::get('/', [KategoriController::class, 'index']);          // menampilkan halaman awal kategori
        Route::post('/list', [KategoriController::class, 'list']);      // menampilkan data kategori dalam json untuk datables
        Route::get('/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah kategori
        Route::post('/', [KategoriController::class,'store']);          // menyimpan data kategori baru
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // Menampilkan halaman form tambah kategori Ajax
        Route::post('/ajax', [KategoriController::class, 'store_ajax']); // Menampilkan data kategori baru Ajax
        Route::get('/{id}', [KategoriController::class, 'show']);       // menampilkan detail kategori
        Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);  // menampilkan halaman form edit kategori
        Route::put('/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data kategori
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // Menampilkan halaman form edit kategori Ajax
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // Menyimpan perubahan data kategori Ajax
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete kategori Ajax
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // Untuk hapus data kategori Ajax
        Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori
        Route::get('/import', [KategoriController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [KategoriController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel',[kategoricontroller::class,'export_excel']); // ajax export excel
        Route::get('/export_pdf',[kategoricontroller::class,'export_pdf']); // ajax export pdf
    });

    //route barang
    Route::group(['prefix' =>'barang', 'middleware'=>'authorize:ADM,MNG'],function(){
        Route::get('/', [BarangController::class, 'index']);          // menampilkan halaman awal barang
        Route::post('/list', [BarangController::class, 'list']);      // menampilkan data barang dalam json untuk datables
        Route::get('/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah barang
        Route::post('/', [BarangController::class,'store']);          // menyimpan data barang baru
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // Menampilkan halaman form tambah barang Ajax
        Route::post('/ajax', [BarangController::class, 'store_ajax']); // Menampilkan data barang baru Ajax
        Route::get('/{id}', [BarangController::class, 'show']);       // menampilkan detail barang
        Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']);
        Route::get('/{id}/edit', [BarangController::class, 'edit']);  // menampilkan halaman form edit barang
        Route::put('/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data barang
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // Menampilkan halaman form edit barang Ajax
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // Menyimpan perubahan data barang Ajax
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete barang Ajax
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Untuk hapus data barang Ajax
        Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data barang
        Route::get('/import', [BarangController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [BarangController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [BarangController::class, 'export_excel']); // export excel
        Route::get('/export_pdf', [BarangController::class, 'export_pdf']); // export pdf
    });

    //route supplier
    Route::group(['prefix' =>'supplier', 'middleware'=>'authorize:ADM,MNG,STF'],function(){
        Route::get('/', [SupplierController::class, 'index']);          // menampilkan halaman awal supplier
        Route::post('/list', [SupplierController::class, 'list']);      // menampilkan data supplier dalam json untuk datables
        Route::get('/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah supplier
        Route::post('/', [SupplierController::class,'store']);          // menyimpan data supplier baru
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // Menampilkan halaman form tambah supplier Ajax
        Route::post('/ajax', [SupplierController::class, 'store_ajax']); // Menampilkan data supplier baru Ajax
        Route::get('/{id}', [SupplierController::class, 'show']);       // menampilkan detail supplier
        Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);  // menampilkan halaman form edit supplier
        Route::put('/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data supplier
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // Menampilkan halaman form edit supplier Ajax
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // Menyimpan perubahan data supplier Ajax
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete supplier Ajax
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // Untuk hapus data supplier Ajax
        Route::delete('/{id}', [SupplierController::class, 'destroy']); // menghapus data supplier
        Route::get('/import', [SupplierController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [SupplierController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel',[suppliercontroller::class,'export_excel']); //ajax export excel
        Route::get('/export_pdf',[suppliercontroller::class,'export_pdf']); //ajax export pdf
    });

    //route stok
    Route::group(['prefix' =>'stok', 'middleware'=>'authorize:ADM,MNG'],function(){
        Route::get('/', [StokController::class, 'index']);          // menampilkan halaman awal stok
        Route::post('/list', [StokController::class, 'list']);      // menampilkan data stok dalam json untuk datatables
        Route::get('/create', [StokController::class, 'create']);   // menampilkan halaman form tambah stok
        Route::post('/', [StokController::class, 'store']);         // menyimpan data stok baru
        Route::get('/create_ajax', [StokController::class, 'create_ajax']); // Menampilkan halaman form tambah stok Ajax
        Route::post('/ajax', [StokController::class, 'store_ajax']); // Menyimpan data stok baru Ajax
        Route::get('/{id}', [StokController::class, 'show']);       // menampilkan detail stok
        Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']); // Menampilkan detail stok Ajax
        Route::get('/{id}/edit', [StokController::class, 'edit']);  // menampilkan halaman form edit stok
        Route::put('/{id}', [StokController::class, 'update']);     // menyimpan perubahan data stok
        Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']); // Menampilkan halaman form edit stok Ajax
        Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']); // Menyimpan perubahan data stok Ajax
        Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete stok Ajax
        Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // Untuk hapus data stok Ajax
        Route::delete('/{id}', [StokController::class, 'destroy']); // menghapus data stok
        Route::get('/import', [StokController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [StokController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [StokController::class, 'export_excel']); // ajax export excel
        Route::get('/export_pdf', [StokController::class, 'export_pdf']); // ajax export pdf
    });

    // route profil
    Route::group(['prefix' =>'profile'],function(){
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::patch('/{id}', [ProfileController::class, 'update'])->name('profile.update');
    });

    // route Penjualan
    Route::group(['prefix' => 'penjualan', 'middleware' => ['authorize:ADM,MNG,STF']], function () {
        Route::get('/', [PenjualanDetailController::class, 'index']);          // Menampilkan halaman awal penjualan
        Route::post('/list', [PenjualanDetailController::class, 'list']);      // Menampilkan data penjualan dalam bentuk JSON untuk DataTables
        Route::get('/create', [PenjualanDetailController::class, 'create']);   // Menampilkan halaman form tambah penjualan
        Route::post('/', [PenjualanDetailController::class, 'store']);         // Menyimpan data penjualan baru
        Route::get('/create_ajax', [PenjualanDetailController::class, 'create_ajax']); // Menampilkan halaman form tambah penjualan ajax
        Route::post('/ajax', [PenjualanDetailController::class, 'store_ajax']); // Menyimpan data penjualan baru ajax
        Route::put('/{id}/update_ajax', [PenjualanDetailController::class, 'update_ajax']); // Menyimpan perubahan data penjualan ajax
        Route::get('/{id}/delete_ajax', [PenjualanDetailController::class, 'confirm_ajax']); // Konfirmasi hapus data penjualan ajax
        Route::delete('/{id}/delete_ajax', [PenjualanDetailController::class, 'delete_ajax']); // Menghapus data penjualan via ajax
        Route::get('/{id}/show_ajax', [PenjualanDetailController::class, 'show_ajax']); // Menampilkan detail penjualan ajax
        Route::get('/{id}', [PenjualanDetailController::class, 'show']);       // Menampilkan detail penjualan
        Route::put('/{id}', [PenjualanDetailController::class, 'update']);     // Menyimpan perubahan data penjualan
        Route::delete('/{id}', [PenjualanDetailController::class, 'destroy']); // Menghapus data penjualan
        Route::get('/import', [PenjualanDetailController::class, 'import']);
        Route::post('/import_ajax', [PenjualanDetailController::class, 'import_ajax']);
        Route::get('/export_excel', [PenjualanDetailController::class, 'export_excel']); // Export data penjualan ke Excel
        Route::get('/export_pdf', [PenjualanDetailController::class, 'export_pdf']);     // Export data penjualan ke PDF
    });
});