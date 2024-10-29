<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KenaikanController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportSiswaController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Route Login dan Register
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Route untuk logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

// Route untuk dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('role:kurikulum')
        ->name('dashboard');

    // Route Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk Siswa, Kelas, dan Kenaikan
    Route::resource('siswa', SiswaController::class);
    Route::resource('kenaikan', KenaikanController::class);
    Route::resource('kelas', KelasController::class);

    // Tambahkan route untuk import
    Route::post('/siswa/import', [ImportSiswaController::class, 'import'])->middleware(['auth', 'role:kurikulum'])->name('siswa.import');
    Route::get('/siswa-export', [SiswaController::class, 'export'])->name('siswa.export');

    Route::get('/kenaikan-export', [KenaikanController::class, 'export'])->name('kenaikan.export');
    Route::post('kenaikan/import', [KenaikanController::class, 'import'])->name('kenaikan.import');

});


// No need to define the kelas resource again, it's already defined above
// Remove the duplicate definition

// Memuat route authentication
require __DIR__.'/auth.php';