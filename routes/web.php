<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MulaiTesController;
use Illuminate\Support\Facades\Auth;

Route::get('/audio-soal/{filename}', function ($filename) {
    $path = storage_path('app/public/audio_soal/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'File not found.');
    }

    return response()->file($path);
});

Route::get('/', function () {
    return view('pages.web.dashboard.main');
});

Route::get('mulai-tes', [MulaiTesController::class, 'index'])->name('mulaites.index');
Route::post('mulai-tes', [MulaiTesController::class, 'quiz'])->name('mulaites.quiz');
Route::post('submit-quiz', [MulaiTesController::class, 'submitquiz'])->name('mulaites.submit-quiz');
Route::get('selesai/{id}', [MulaiTesController::class, 'selesaiTest'])->name('mulaites.selesai-tes');
Route::get('download-sertifikat/{id}', [MulaiTesController::class, 'generateSertifikat'])->name('mulaites.generateSertifikat');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    //pengguna
    Route::get('pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/get-data', [PenggunaController::class, 'data'])->name('pengguna.data');
    Route::post('/pengguna/store', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('pengguna/get/{id}', [PenggunaController::class, 'get']);
    Route::put('pengguna/update/{id}', [PenggunaController::class, 'update']);
    Route::delete('pengguna/delete/{id}', [PenggunaController::class, 'destroy']);

    //instansi
    Route::get('instansi', [InstansiController::class, 'index'])->name('instansi.index');
    Route::get('/instansi/get-data', [InstansiController::class, 'data'])->name('instansi.data');
    Route::post('/instansi/store', [InstansiController::class, 'store'])->name('instansi.store');
    Route::get('instansi/get/{id}', [InstansiController::class, 'get']);
    Route::put('instansi/update/{id}', [InstansiController::class, 'update']);
    Route::delete('instansi/delete/{id}', [InstansiController::class, 'destroy']);

    //level
    Route::get('level', [LevelController::class, 'index'])->name('level.index');
    Route::get('/level/get-data', [LevelController::class, 'data'])->name('level.data');
    Route::post('/level/store', [LevelController::class, 'store'])->name('level.store');
    Route::get('level/get/{id}', [LevelController::class, 'get']);
    Route::put('level/update/{id}', [LevelController::class, 'update']);
    Route::delete('level/delete/{id}', [LevelController::class, 'destroy']);


    //peserta
    Route::get('peserta', [PesertaController::class, 'index'])->name('peserta.index');
    Route::get('/peserta/get-data', [PesertaController::class, 'data'])->name('peserta.data');
    Route::post('/peserta/store', [PesertaController::class, 'store'])->name('peserta.store');
    Route::get('peserta/get/{id}', [PesertaController::class, 'get']);
    Route::put('peserta/update/{id}', [PesertaController::class, 'update']);
    Route::delete('peserta/delete/{id}', [PesertaController::class, 'destroy']);


    //transaksi
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/get-data', [TransaksiController::class, 'data'])->name('transaksi.data');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('transaksi/get/{id}', [TransaksiController::class, 'get']);
    Route::put('transaksi/update/{id}', [TransaksiController::class, 'update']);
    Route::delete('transaksi/delete/{id}', [TransaksiController::class, 'destroy']);

    //soal
    Route::get('soal', [SoalController::class, 'index'])->name('soal.index');
    Route::get('/soal/proses', [SoalController::class, 'soal']);
    Route::get('/soal/get-data', [SoalController::class, 'datasoal']);
    Route::post('/soal/store', [SoalController::class, 'store'])->name('soal.store');
    Route::get('soal/get/{id}', [SoalController::class, 'get']);
    Route::put('soal/update/{id}', [SoalController::class, 'update']);
    Route::delete('soal/delete/{id}', [SoalController::class, 'destroy']);
});
