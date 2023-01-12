<?php

use App\Models\Berita;
use App\Models\JenisSurat;
use App\Models\PerangkatGampong;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardBeritaController;
use App\Http\Controllers\DashboardSolusiController;
use App\Http\Controllers\DashboardJabatanController;
use App\Http\Controllers\DashboardKategoriController;
use App\Http\Controllers\DashboardDataSuratController;
use App\Http\Controllers\DashboardLaporanAdministrasiController;
use App\Http\Controllers\DashboardPerizinanController;
use App\Http\Controllers\DashboardLaporanKeuanganController;
use App\Http\Controllers\DashboardPerangkatGampongController;
use App\Models\Keuangan;
use App\Models\Solusi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        'title' => 'Beranda',
        'beritas' => Berita::with('kategori')->latest()->get(),
        'perangkats' => PerangkatGampong::with('jabatan')->get()
    ]);
});

Route::prefix('/administrasi')->group(function () {
    Route::get('/', function () {
        return view('administrasi', [
            'title' => 'Administrasi'
        ]);
    });

    Route::post('/masukan', [DashboardSolusiController::class, 'store']);

    Route::get('/form-adm', function () {
        return view('form_adm', [
            'title' => 'Form Administrasi',
            'jenis_surats' => JenisSurat::all()
        ]);
    });
    Route::post('/form-adm', [DashboardDataSuratController::class, 'buatSurat']);

    Route::get('/form-izin', function () {
        return view('form_izin', [
            'title' => 'Form Perizinan'
        ]);
    });
    Route::post('/perizinan', [DashboardPerizinanController::class, 'store']);
});

Route::get('/informasi', function () {
    return view('informasi', [
        'title' => 'Informasi Gampong',
        'keuangans' => Keuangan::latest()->get(),
        'solusis' => Solusi::whereNotNull('respon')->get()
    ]);
});

Route::get('/keuangan', function () {
    return view('keuangan', [
        'title' => 'Keuangan',
    ]);
});

Route::get('/berita', [BeritaController::class, 'index']);
Route::get('berita/{berita:slug}', [BeritaController::class, 'show']);

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

// Dashboard
Route::prefix('/dashboard')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

    Route::prefix('/berita')->group(function () {
        Route::get('/data-berita/checkSlug', [DashboardBeritaController::class, 'checkSlug'])->middleware('admin');
        Route::resource('/data-berita', DashboardBeritaController::class)->middleware('admin');

        Route::get('/kategori-berita/createSlug', [DashboardKategoriController::class, 'checkSlug'])->middleware('admin');
        Route::resource('/kategori-berita', DashboardKategoriController::class)->except(['show', 'edit'])->middleware('admin');
    });

    Route::prefix('/administrasi')->group(function () {
        Route::resource('/solusi', DashboardSolusiController::class)->except(['create', 'store', 'show', 'edit'])->middleware('sekdes');

        Route::resource('/data-surat', DashboardDataSuratController::class)->except(['show', 'destroy'])->middleware('sekdes');
        Route::put('/data-surat', [DashboardDataSuratController::class, 'updateStatus'])->middleware('sekdes');

        Route::resource('/perizinan', DashboardPerizinanController::class)->only(['index', 'store'])->middleware('sekdes');
        Route::put('/perizinan', [DashboardPerizinanController::class, 'konfirmasiPerizinan'])->middleware('sekdes');
    });

    Route::prefix('/laporan')->group(function () {
        Route::resource('/keuangan', DashboardLaporanKeuanganController::class)->except(['show', 'edit', 'update'])->middleware('bendes');

        Route::resource('/administrasi', DashboardLaporanAdministrasiController::class)->middleware('sekdes');
    });

    Route::resource('/user', AdminUserController::class)->except('show')->middleware('admin');
    Route::post('/user/reset-password', [AdminUserController::class, 'resetPasswordAdmin'])->middleware('admin');

    Route::prefix('/struktur')->group(function () {
        Route::resource('/perangkat-gampong', DashboardPerangkatGampongController::class)->except('show')->middleware('admin');
        Route::resource('/jabatan', DashboardJabatanController::class)->except(['create', 'show', 'edit'])->middleware('admin');
    });
});
