<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TeachingAssistantController; // Tambahkan ini
use App\Http\Controllers\AlumniController; // Tambahkan ini
use App\Http\Controllers\ApaKataAlumniController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\Admin\KategoriGaleriController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\SejarahController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Make something great!
*/

// Authentication Routes (Guest Only)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('showRegister');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

    // Struktur Organisasi Routes (Public)
    Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'showPublic'])->name('struktur-organisasi.public');

    // Agenda Routes (Public)
    Route::get('/agendas', [AgendaController::class, 'listPublic'])->name('agendas.index');
    Route::get('/agendas/{agenda}', [AgendaController::class, 'showPublic'])->name('agendas.public');

    // Galeri Routes (Public)
    Route::get('/galeri', [GaleriController::class, 'showPublic'])->name('galeri.index');
    Route::get('/galeri/kategori/{kategoriSlug}', [GaleriController::class, 'showByCategory'])->name('galeri.byCategory');
    // Berita Routes (Public)
    Route::get('/beritas', [BeritaController::class, 'showPublic'])->name('beritas.public');
    Route::get('/beritas/{berita}', [BeritaController::class, 'show'])->name('beritas.show');

    // Visi Misi Routes (Public)
    Route::get('/visi-misi', [VisiMisiController::class, 'indexPublic'])->name('visi_misi.public');

    // Rute Dosen untuk Public
    Route::get('/dosen', [DosenController::class, 'showPublic'])->name('dosen.showPublic');

    Route::get('/dosen/{dosen}', [DosenController::class, 'showPublicDetail'])->name('dosen.showPublicDetail');

    Route::get('/about_us', [AboutUsController::class, 'showPublic'])->name('about_us.showPublic');
    Route::get('/about_us/{about_us}', [AboutUsController::class, 'showDetail'])->name('about_us.showDetail');


    Route::get('/sejarah', [SejarahController::class, 'showPublic'])->name('sejarah.showPublic');

    // Alumni Routes (Public)
    Route::get('/alumni/{alumni}', [AlumniController::class, 'showPublicDetail'])->name('alumni.showPublicDetail');
    Route::get('/alumni', [AlumniController::class, 'indexPublic'])->name('alumni.indexPublic');
    // Teaching Assistant Routes (Public)
    Route::get('/teaching-assistants/{teachingAssistant}', [TeachingAssistantController::class, 'showPublicDetail'])->name('teaching_assistants.showPublicDetail');
    Route::get('/teaching-assistants', [TeachingAssistantController::class, 'indexPublic'])->name('teaching_assistants.indexPublic');
    // Apa kata alumni
    Route::get('/apa-kata-alumni', [ApaKataAlumniController::class, 'indexPublic'])->name('apa_kata_alumni.index');
    Route::get('/apa-kata-alumni/{id}', [ApaKataAlumniController::class, 'showPublic'])->name('apa_kata_alumni.show');
    // Keuangan
    Route::get('/laporan-keuangan', [KeuanganController::class, 'indexPublic'])->name('keuangan.index')->middleware('auth');

    // Detail
    Route::get('/dosen/{id}', [DosenController::class, 'showDetail'])->name('dosen.show');
    Route::get('/teaching_assistans/{id}', [TeachingAssistantController::class, 'showPublicDetail'])->name('teaching_assistants.show');
    // Route::get('/alumni/{id}', [AlumniController::class, 'showDetail'])->name('alumni.show');


//Route utama dialihkan ke login jika belum login



Route::get('/feedback/{feedback}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit')->middleware('auth');
Route::put('/feedback/{feedback}', [FeedbackController::class, 'update'])->name('feedback.update')->middleware('auth');
Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy')->middleware('auth');

// Protected Routes (Authenticated Users Only)
Route::group(['middleware' => 'auth'], function () {

    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});



    // Admin Routes (Authenticated Admins Only)
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/feedback', [FeedbackController::class, 'index'])->name('admin.feedback.index');
        Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroyByAdmin'])->name('admin.feedback.destroy');
        Route::get('/berita/{berita}', [BeritaAdminController::class, 'show'])->name('berita.show');

        // Struktur Organisasi Routes (Admin)
        Route::group(['prefix' => 'struktur-organisasi'], function () {
            Route::get('/', [StrukturOrganisasiController::class, 'index'])->name('admin.struktur-organisasi.index');
            Route::get('/create', [StrukturOrganisasiController::class, 'create'])->name('admin.struktur-organisasi.create');
            Route::post('/', [StrukturOrganisasiController::class, 'store'])->name('admin.struktur-organisasi.store');
            Route::get('/{struktur_organisasi}', [StrukturOrganisasiController::class, 'show'])->name('admin.struktur-organisasi.show');
            Route::get('/{struktur_organisasi}/edit', [StrukturOrganisasiController::class, 'edit'])->name('admin.struktur-organisasi.edit');
            Route::put('/{struktur_organisasi}', [StrukturOrganisasiController::class, 'update'])->name('admin.struktur-organisasi.update');
            Route::delete('/{struktur_organisasi}', [StrukturOrganisasiController::class, 'destroy'])->name('admin.struktur-organisasi.destroy');
        });

        // Agenda Routes (Admin)
        Route::group(['prefix' => 'agendas'], function () {
            Route::get('/', [AgendaController::class, 'index'])->name('admin.agendas.index');
            Route::get('/create', [AgendaController::class, 'create'])->name('admin.agendas.create');
            Route::post('/', [AgendaController::class, 'store'])->name('admin.agendas.store');
            Route::get('/{agenda}', [AgendaController::class, 'show'])->name('admin.agendas.show');
            Route::get('/{agenda}/edit', [AgendaController::class, 'edit'])->name('admin.agendas.edit');
            Route::put('/{agenda}', [AgendaController::class, 'update'])->name('admin.agendas.update');
            Route::delete('/{agenda}', [AgendaController::class, 'destroy'])->name('admin.agendas.destroy');
        });

        // Berita Routes (Admin)
        Route::group(['prefix' => 'beritas'], function () {
            Route::get('/', [BeritaController::class, 'index'])->name('admin.beritas.index');
            Route::get('/create', [BeritaController::class, 'create'])->name('admin.beritas.create');
            Route::post('/', [BeritaController::class, 'store'])->name('admin.beritas.store');
            Route::get('/{berita}', [BeritaController::class, 'show'])->name('admin.beritas.show');
            Route::get('/{berita}/edit', [BeritaController::class, 'edit'])->name('admin.beritas.edit');
            Route::put('/{berita}', [BeritaController::class, 'update'])->name('admin.beritas.update');
            Route::delete('/{berita}', [BeritaController::class, 'destroy'])->name('admin.beritas.destroy');
        });

        Route::group(['prefix' => 'galeri'], function () {
            Route::get('/', [GaleriController::class, 'index'])->name('admin.galeri.index');
            Route::get('/create', [GaleriController::class, 'create'])->name('admin.galeri.create');
            Route::post('/', [GaleriController::class, 'store'])->name('admin.galeri.store');
            Route::get('/{galeri}', [GaleriController::class, 'show'])->name('admin.galeri.show');
            Route::get('/{galeri}/edit', [GaleriController::class, 'edit'])->name('admin.galeri.edit');
            Route::put('/{galeri}', [GaleriController::class, 'update'])->name('admin.galeri.update');
            Route::delete('/{galeri}', [GaleriController::class, 'destroy'])->name('admin.galeri.destroy');
        });

        Route::group(['prefix' => 'galeri-kategori'], function () { // Menggunakan '-' untuk URI lebih umum
        Route::get('/', [KategoriGaleriController::class, 'index'])->name('admin.galeri-kategori.index');
        Route::get('/create', [KategoriGaleriController::class, 'create'])->name('admin.galeri-kategori.create');
        Route::post('/', [KategoriGaleriController::class, 'store'])->name('admin.galeri-kategori.store');

        // Gunakan parameter yang lebih deskriptif seperti {kategoriGaleri} atau {kategori_galeri}
        // Jika Anda menggunakan SLUG untuk route model binding di model KategoriGaleri:
        Route::get('/{kategoriGaleri:slug}', [KategoriGaleriController::class, 'show'])->name('admin.galeri-kategori.show');
        Route::get('/{kategoriGaleri:slug}/edit', [KategoriGaleriController::class, 'edit'])->name('admin.galeri-kategori.edit'); // Perbaiki nama route ini
        Route::put('/{kategoriGaleri:slug}', [KategoriGaleriController::class, 'update'])->name('admin.galeri-kategori.update');
        Route::delete('/{kategoriGaleri:slug}', [KategoriGaleriController::class, 'destroy'])->name('admin.galeri-kategori.destroy');

        // Jika Anda menggunakan ID untuk route model binding (default):
        // Route::get('/{kategoriGaleri}', [KategoriGaleriController::class, 'show'])->name('galeri-kategori.show');
        // Route::get('/{kategoriGaleri}/edit', [KategoriGaleriController::class, 'edit'])->name('galeri-kategori.edit');
        // Route::put('/{kategoriGaleri}', [KategoriGaleriController::class, 'update'])->name('galeri-kategori.update');
        // Route::delete('/{kategoriGaleri}', [KategoriGaleriController::class, 'destroy'])->name('galeri-kategori.destroy');
    });


        // Visi Misi Routes (Admin)
        Route::prefix('visi_misi')->group(function () {
            Route::get('/', [VisiMisiController::class, 'index'])->name('admin.visi_misi.index');
            Route::get('/create', [VisiMisiController::class, 'create'])->name('admin.visi_misi.create');
            Route::post('/', [VisiMisiController::class, 'store'])->name('admin.visi_misi.store');
            Route::get('/{visi_misi}', [VisiMisiController::class, 'show'])->name('admin.visi_misi.show');
            Route::get('/{visi_misi}/edit', [VisiMisiController::class, 'edit'])->name('admin.visi_misi.edit');
            Route::put('/{visi_misi}', [VisiMisiController::class, 'update'])->name('admin.visi_misi.update');
            Route::delete('/{visi_misi}', [VisiMisiController::class, 'destroy'])->name('admin.visi_misi.destroy');
        });

        // Dosen Routes (Admin)
        Route::group(['prefix' => 'dosens'], function () {
            Route::get('/', [DosenController::class, 'index'])->name('admin.dosens.index');
            Route::get('/create', [DosenController::class, 'create'])->name('admin.dosens.create');
            Route::post('/', [DosenController::class, 'store'])->name('admin.dosens.store');
            Route::get('/{dosen}', [DosenController::class, 'show'])->name('admin.dosens.show');
            Route::get('/{dosen}/edit', [DosenController::class, 'edit'])->name('admin.dosens.edit');
            Route::put('/{dosen}', [DosenController::class, 'update'])->name('admin.dosens.update');
            Route::delete('/{dosen}', [DosenController::class, 'destroy'])->name('admin.dosens.destroy');
        });

        // Alumni Routes (Admin)
        Route::group(['prefix' => 'alumnis'], function () {
            Route::get('/', [AlumniController::class, 'index'])->name('admin.alumnis.index');
            Route::get('/create', [AlumniController::class, 'create'])->name('admin.alumnis.create');
            Route::post('/', [AlumniController::class, 'store'])->name('admin.alumnis.store');
            Route::get('/{alumni}', [AlumniController::class, 'show'])->name('admin.alumnis.show');
            Route::get('/{alumni}/edit', [AlumniController::class, 'edit'])->name('admin.alumnis.edit');
            Route::put('/{alumni}', [AlumniController::class, 'update'])->name('admin.alumnis.update');
            Route::delete('/{alumni}', [AlumniController::class, 'destroy'])->name('admin.alumnis.destroy');
        });

        // Teaching Assistant Routes (Admin)
        Route::group(['prefix' => 'teaching-assistants'], function () {
            Route::get('/', [TeachingAssistantController::class, 'index'])->name('admin.teaching_assistants.index');
            Route::get('/create', [TeachingAssistantController::class, 'create'])->name('admin.teaching_assistants.create');
            Route::post('/', [TeachingAssistantController::class, 'store'])->name('admin.teaching_assistants.store');
            Route::get('/{teaching_assistant}', [TeachingAssistantController::class, 'show'])->name('admin.teaching_assistants.show');
            Route::get('/{teaching_assistant}/edit', [TeachingAssistantController::class, 'edit'])->name('admin.teaching_assistants.edit');
            Route::put('/{teaching_assistant}', [TeachingAssistantController::class, 'update'])->name('admin.teaching_assistants.update');
            Route::delete('/{teaching_assistant}', [TeachingAssistantController::class, 'destroy'])->name('admin.teaching_assistants.destroy');
        });

        Route::group(['prefix' => 'apa-kata-alumni'], function () {
            Route::get('/', [ApaKataAlumniController::class, 'index'])->name('admin.apa_kata_alumni.index');
            Route::get('/create', [ApaKataAlumniController::class, 'create'])->name('admin.apa_kata_alumni.create');
            Route::post('/', [ApaKataAlumniController::class, 'store'])->name('admin.apa_kata_alumni.store');
            Route::get('/{apa_kata_alumni}', [ApaKataAlumniController::class, 'show'])->name('admin.apa_kata_alumni.show');
            Route::get('/{apa_kata_alumni}/edit', [ApaKataAlumniController::class, 'edit'])->name('admin.apa_kata_alumni.edit');
            Route::put('/{apa_kata_alumni}', [ApaKataAlumniController::class, 'update'])->name('admin.apa_kata_alumni.update');
            Route::delete('/{apa_kata_alumni}', [ApaKataAlumniController::class, 'destroy'])->name('admin.apa_kata_alumni.destroy');
        });

        Route::group(['prefix' => 'keuangan'], function () {
            Route::get('/', [KeuanganController::class, 'index'])->name('admin.keuangan.index');
            Route::get('/create', [KeuanganController::class, 'create'])->name('admin.keuangan.create');
            Route::post('/', [KeuanganController::class, 'store'])->name('admin.keuangan.store');
            Route::get('/{keuangan}', [KeuanganController::class, 'show'])->name('admin.keuangan.show');
            Route::get('/{keuangan}/edit', [KeuanganController::class, 'edit'])->name('admin.keuangan.edit');
            Route::put('/{keuangan}', [KeuanganController::class, 'update'])->name('admin.keuangan.update');
            Route::delete('/{keuangan}', [KeuanganController::class, 'destroy'])->name('admin.keuangan.destroy');
        });
    });
