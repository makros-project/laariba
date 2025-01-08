<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\UtangController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\SopLaaRibaController;
use App\Http\Controllers\JenisTransaksiController;
use App\Http\Controllers\Auth\RegisteredUserController;




Route::get('/', function () {
    return view('auth.login');
});

    // Route::get('/register', [RegisteredUserController::class, 'create'])->name('register.create');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('auth.register');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('anggota', AnggotaController::class)->parameters([
        'anggota' => 'anggota' // Pastikan nama parameter konsisten
    ]);
    Route::get('/anggota/{anggota}', [AnggotaController::class, 'show'])->name('anggota.show');


    Route::resource('iuran', IuranController::class)->parameters([
        'iuran' => 'iuran' // Pastikan nama parameter konsisten
    ]);

    Route::get('/home', [TransaksiController::class, 'home'])->name('home');

    Route::resource('utang', UtangController::class);


    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

    Route::resource('jenis-transaksi', JenisTransaksiController::class)->except(['create', 'edit', 'show']);

    Route::get('/sop-laa-riba', [SopLaaRibaController::class, 'index'])->name('sop-laa-riba');


});

require __DIR__.'/auth.php';
