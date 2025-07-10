<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;
use App\Http\Middleware\Login;
use App\Models\Absen;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'Login'])->name('Login');
Route::post('/login_proses', [LoginController::class, 'login_proses'])->name('login_proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

        Route::get('/siswas/create', [SiswaController::class, 'create'])->name('create');
        Route::post('/siswas/store', [SiswaController::class, 'store'])->name('store');
        Route::get('/siswas/{id}/edit', [SiswaController::class, 'edit'])->name('edit');
        Route::put('/siswas/{id}/update', [SiswaController::class, 'update'])->name('update');
        Route::delete('/siswas/{id}/delete', [SiswaController::class, 'destroy'])->name('destroy');
        Route::get('/create', [GuruController::class, 'create'])->name('createGuru');
        Route::post('/guru', [GuruController::class, 'store'])->name('storeGuru');
        Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('editGuru');
        Route::put('/guru/{id}/update', [GuruController::class, 'update'])->name('updateGuru');
        Route::delete('/guru/{id}/delete', [GuruController::class, 'destroy'])->name('destroyGuru');
        Route::get('/jurusan', [JurusanController::class, 'tampilanj'])->name('createJurusan');
        Route::post('/jurusan', [JurusanController::class, 'storej'])->name('storeJurusan');
        Route::get('/jurusan/{id}/edit', [JurusanController::class, 'editj'])->name('editJurusan');
        Route::put('/jurusan/{id}/update', [JurusanController::class, 'updatej'])->name('updateJurusan');
        Route::delete('/jurusan/{id}/delete', [JurusanController::class, 'destroyj'])->name('destroyJurusan');
        Route::get('/kelas/create', [KelasController::class, 'create'])->name('createKelas');
        Route::post('/kelas/store', [KelasController::class, 'input'])->name('input');
        Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('editKelas');
        Route::put('/kelas/{id}/update', [KelasController::class, 'update'])->name('updateKelas');
        Route::delete('/kelas/{id}/delete', [KelasController::class, 'destroy'])->name('destroyKelas');
        Route::get('/mapel/create', [MapelController::class, 'createM'])->name('createMapel');
        Route::post('/mapel/store', [MapelController::class, 'storeM'])->name('storeMapel');
        Route::get('/mapel/{id}/edit', [MapelController::class, 'editM'])->name('editMapel');
        Route::put('/mapel/{id}/update', [MapelController::class, 'updateM'])->name('updateMapel');
        Route::delete('/mapel/{id}/delete', [MapelController::class, 'destroyM'])->name('destroyMapel');



    Route::get('/read', [GuruController::class, 'read'])->name('read');

    Route::get('/kelas', [KelasController::class, 'index'])->name('tableKelas');
    Route::get('/kelas/{id}/show', [KelasController::class, 'show'])->name('showKelas');
    Route::get('/mapel', [MapelController::class, 'tampilanM'])->name('tampilanMapel');
    // ini route absen
    Route::get('/absens',[AbsenController::class, 'index'])->name('absen');
    Route::get('/absens/{id}/kelas',[AbsenController::class, 'show'])->name('show');
    Route::get('/absens/{id}/create',[AbsenController::class, 'create'])->name('createAbsen');
    Route::post('/absens/store',[AbsenController::class, 'store'])->name('storeAbsen');
    Route::get('/absens/{id}/edit',[AbsenController::class, 'edit'])->name('editAbsen');
    Route::put('/absens/{id}/update',[AbsenController::class, 'update'])->name('updateAbsen');
    Route::post('/absens/delete',[AbsenController::class, 'destroy'])->name('deleteAbsen');
    Route::get('/absensi/{id}/filter', [AbsenController::class, 'filter'])->name('filterAbsensi');
    Route::get('/absensi/laporan', [PresensiController::class, 'cetak'])->name('cetak');
    Route::get('/absensi/filter', [PresensiController::class, 'filterP'])->name('filterP');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

