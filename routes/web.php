<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\BarangController;
use App\Http\Controllers\Staff\LokasiController;
use App\Http\Controllers\Staff\SatuanController;
use App\Http\Controllers\Staff\KondisiController;
use App\Http\Controllers\Staff\CustomerController;
use App\Http\Controllers\Staff\KategoriController;
use App\Http\Controllers\Staff\SupplierController;
use App\Http\Controllers\Staff\PeminjamanController;
use App\Http\Controllers\Staff\BarangMasukController;
use App\Http\Controllers\Staff\PengembalianController;
use App\Http\Controllers\RequestAkunController as PublicRequestAkunController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Admin\RequestAkunController as AdminRequestAkunController;


Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth', 'isadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/permintaan-akun', [AdminRequestAkunController::class, 'index'])->name('request.index');
    Route::post('/permintaan-akun/{id}/approve', [AdminRequestAkunController::class, 'approve'])->name('request.approve');
    Route::post('/permintaan-akun/{id}/reject', [AdminRequestAkunController::class, 'reject'])->name('request.reject');
});

// hanya untuk akun dengan auth isstaff
Route::middleware(['auth', 'isstaff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::post('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::post('/barang/{id}/show', [BarangController::class, 'show'])->name('barang.show');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan.index');
    Route::get('/satuan/create', [SatuanController::class, 'create'])->name('satuan.create');
    Route::post('/satuan', [SatuanController::class, 'store'])->name('satuan.store');
    Route::post('/satuan/{id}/edit', [SatuanController::class, 'edit'])->name('satuan.edit');
    Route::delete('/satuan/{id}', [SatuanController::class, 'destroy'])->name('satuan.destroy');

    Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');
    Route::get('/lokasi/create', [LokasiController::class, 'create'])->name('lokasi.create');
    Route::post('/lokasi', [LokasiController::class, 'store'])->name('lokasi.store');
    Route::post('/lokasi/{id}/edit', [LokasiController::class, 'edit'])->name('lokasi.edit');
    Route::delete('/lokasi/{id}', [LokasiController::class, 'destroy'])->name('lokasi.destroy');

    Route::get('/peminjaman-barang', [PeminjamanController::class, 'index'])->name('pinjam_barang.index');
    Route::get('/pengembalian-barang', [PengembalianController::class, 'index'])->name('bali_barang.index');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang_masuk.index');
    Route::get('/barang-masuk/create', [BarangMasukController::class, 'create'])->name('barang_masuk.create');
    Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang_masuk.store');
    Route::get('/barang-masuk/{id}/edit', [BarangMasukController::class, 'edit'])->name('barang_masuk.edit');
    Route::delete('/barang-masuk/{id}', [BarangMasukController::class, 'destroy'])->name('barang_masuk.destroy');


});

Route::get('/request-akun', [PublicRequestAkunController::class, 'create'])->name('request-akun.form');
Route::post('/request-akun', [PublicRequestAkunController::class, 'store'])->name('request-akun.submit');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return redirect()->route(
        auth()->user()->role === 'admin' ? 'admin.dashboard' : 'staff.dashboard'
    );
})->middleware('auth')->name('dashboard');


require __DIR__.'/auth.php';
