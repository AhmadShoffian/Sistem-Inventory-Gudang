<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\RequestAkunController as PublicRequestAkunController;
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
