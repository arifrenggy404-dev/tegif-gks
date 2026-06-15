<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\WilayahController;
use App\Http\Controllers\Admin\PelayanController;
use App\Http\Controllers\Admin\JadwalIbadahController;
use App\Http\Controllers\Admin\JadwalPaController;
use App\Http\Controllers\Admin\JadwalKesasiController;
use App\Http\Controllers\Admin\WartamimbarController;
use App\Http\Controllers\Admin\JemaatController;
use App\Http\Controllers\Admin\KunjunganController;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Bendahara\DashboardController as BendaharaDashboard;
use App\Http\Controllers\Bendahara\KeuanganController;
use App\Http\Controllers\Bendahara\LaporanController;

use App\Http\Controllers\Pengurus\WilayahController as PengurusWilayahController;
use App\Http\Controllers\Pengurus\PelayanController as PengurusPelayanController;
use App\Http\Controllers\Pengurus\JadwalIbadahController as PengurusJadwalIbadahController;
use App\Http\Controllers\Pengurus\JadwalPaController as PengurusJadwalPaController;
use App\Http\Controllers\Pengurus\JadwalKesasiController as PengurusJadwalKesasiController;
use App\Http\Controllers\Pengurus\WartamimbarController as PengurusWartamimbarController;
use App\Http\Controllers\Pengurus\JemaatController as PengurusJemaatController;
use App\Http\Controllers\Pengurus\KunjunganController as PengurusKunjunganController;
use App\Http\Controllers\Pengurus\AssetController as PengurusAssetController;
use App\Http\Controllers\Pengurus\UserController as PengurusUserController;
use App\Http\Controllers\Pengurus\DashboardController as PengurusDashboardController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/jadwal-ibadah', [PublicController::class, 'jadwalIbadah'])->name('public.jadwal-ibadah');
Route::get('/jadwal-pa', [PublicController::class, 'jadwalPa'])->name('public.jadwal-pa');
Route::get('/jadwal-kesasi', [PublicController::class, 'jadwalKesasi'])->name('public.jadwal-kesasi');
Route::get('/warta-mimbar', [PublicController::class, 'wartamimbar'])->name('public.wartamimbar');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    Route::resource('wilayah', WilayahController::class);
    Route::resource('pelayan', PelayanController::class);

    // PENTING: route export-excel HARUS sebelum Route::resource('jemaat', ...)
    Route::get('jemaat/export-excel', [JemaatController::class, 'exportExcel'])
        ->name('jemaat.export-excel');

    Route::resource('jemaat', JemaatController::class);

    Route::resource('asset', AssetController::class);
    Route::resource('kunjungan', KunjunganController::class);
    Route::resource('wartamimbar', WartamimbarController::class);
    Route::resource('user', UserController::class);

    Route::resource('jadwal-ibadah', JadwalIbadahController::class)
        ->parameters(['jadwal-ibadah' => 'jadwalIbadah']);

    Route::get('jadwal-pa/print-pdf', [JadwalPaController::class, 'printPdf'])
        ->name('jadwal-pa.print-pdf');

    Route::resource('jadwal-pa', JadwalPaController::class)
        ->parameters(['jadwal-pa' => 'jadwalPa']);

    Route::resource('jadwal-kesasi', JadwalKesasiController::class)
        ->parameters(['jadwal-kesasi' => 'jadwalKesasi']);
});

Route::middleware(['auth', 'role:bendahara,admin'])->prefix('bendahara')->name('bendahara.')->group(function () {
    Route::get('/dashboard', [BendaharaDashboard::class, 'index'])->name('dashboard');
    Route::resource('keuangan', KeuanganController::class);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/preview', [LaporanController::class, 'preview'])->name('laporan.preview');
    Route::get('/laporan/download', [LaporanController::class, 'download'])->name('laporan.download');
    Route::get('/laporan/stream', [LaporanController::class, 'stream'])->name('laporan.stream');
});

Route::middleware(['auth', 'role:pengurus,admin'])->prefix('pengurus')->name('pengurus.')->group(function () {
    Route::get('/dashboard', [PengurusDashboardController::class, 'index'])->name('dashboard');

    Route::resource('wilayah', PengurusWilayahController::class)->only(['index', 'show']);
    Route::resource('pelayan', PengurusPelayanController::class)->only(['index', 'show']);
    Route::resource('jemaat', PengurusJemaatController::class)->only(['index', 'show']);
    Route::resource('asset', PengurusAssetController::class)->only(['index', 'show']);
    Route::resource('kunjungan', PengurusKunjunganController::class)->only(['index', 'show']);
    Route::resource('wartamimbar', PengurusWartamimbarController::class)->only(['index', 'show']);

    Route::resource('jadwal-ibadah', PengurusJadwalIbadahController::class)
        ->parameters(['jadwal-ibadah' => 'jadwalIbadah'])
        ->only(['index', 'show']);

    Route::get('jadwal-pa/print-pdf', [PengurusJadwalPaController::class, 'printPdf'])
        ->name('jadwal-pa.print-pdf');

    Route::resource('jadwal-pa', PengurusJadwalPaController::class)
        ->parameters(['jadwal-pa' => 'jadwalPa'])
        ->only(['index', 'show']);

    Route::resource('jadwal-kesasi', PengurusJadwalKesasiController::class)
        ->parameters(['jadwal-kesasi' => 'jadwalKesasi'])
        ->only(['index', 'show']);
});
