<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArabController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DetailEkskulRaportController;
use App\Http\Controllers\DetailNilaiRaportController;
use App\Http\Controllers\DetailRaportP5Controller;
use App\Http\Controllers\FiqihController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HafalanArabController;
use App\Http\Controllers\HafalanFiqihController;
use App\Http\Controllers\HafalanInggrisController;
use App\Http\Controllers\HafalanSurahController;
use App\Http\Controllers\HafalanTahfidzController;
use App\Http\Controllers\InggrisController;
use App\Http\Controllers\JenisKasusController;
use App\Http\Controllers\KalenderAkademikController;
use App\Http\Controllers\KandunganMadingController;
use App\Http\Controllers\KasusController;
use App\Http\Controllers\KategoriMadingController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MadingController;
use App\Http\Controllers\MapelKelasController;
use App\Http\Controllers\MasterAsasController;
use App\Http\Controllers\MasterEkskulController;
use App\Http\Controllers\MasterMapelController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PeraturanController;
use App\Http\Controllers\RaportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\SurahController;
use App\Http\Controllers\TahfidzController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\web\AuthControllerWeb;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes - Perbaikan di sini
Route::get('/login', [AuthControllerWeb::class, 'showLoginForm'])->name('login');
Route::post('/post-login', [AuthControllerWeb::class, 'login'])->name('login.post'); // Ubah dari 'post.login' ke 'login.post'
Route::get('/register', [AuthControllerWeb::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthControllerWeb::class, 'register'])->name('register.post');
Route::get('/logout', [AuthControllerWeb::class, 'logout'])->name('logout');

// Dashboard Route
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

// Resource Routes
Route::resource('admin', AdminController::class);
Route::resource('detail_ekskul_raport', DetailEkskulRaportController::class);
Route::resource('guru', GuruController::class);
Route::resource('jenis_kasus', JenisKasusController::class);
Route::resource('kasus', KasusController::class);
Route::resource('kelas', KelasController::class);
Route::resource('mapel_kelas', MapelKelasController::class);
Route::resource('master_mapel', MasterMapelController::class);
Route::resource('master_ekskul', MasterEkskulController::class);
Route::resource('orangtua', OrangTuaController::class);
Route::resource('raport', RaportController::class);
Route::resource('detail-nilai-raport', DetailNilaiRaportController::class);
Route::resource('detail-raport-p5', DetailRaportP5Controller::class);
Route::resource('kalender_akademik', KalenderAkademikController::class);
Route::resource('santri', SantriController::class);
Route::resource('peraturan', PeraturanController::class);
Route::resource('pengumuman', PengumumanController::class);
Route::resource('master-asas', MasterAsasController::class);
Route::resource('kategori-mading', KategoriMadingController::class);
Route::resource('mading', MadingController::class);
Route::resource('kandungan-mading', KandunganMadingController::class);
Route::resource('surah', SurahController::class);
Route::resource('hafalan-surah', HafalanSurahController::class);
Route::resource('inggris', InggrisController::class);
Route::resource('hafalan-inggris', HafalanInggrisController::class);
Route::resource('arab', ArabController::class);
Route::resource('hafalan-arab', HafalanArabController::class);
Route::resource('fiqih', FiqihController::class);
Route::resource('hafalan-fiqih', HafalanFiqihController::class);
Route::resource('tahfidz', TahfidzController::class);
Route::resource('hafalan-tahfidz', HafalanTahfidzController::class);

// Custom Routes
Route::get('detail-raport-create', [DetailNilaiRaportController::class, 'getCreate']);
Route::get('hafalan-tahfidz/santri/{id}', [HafalanTahfidzController::class, 'getBySantri']);

// Firebase Routes
Route::get('/firebase', [FirebaseController::class, 'index']);
Route::post('/firebase/store', [FirebaseController::class, 'store']);
Route::delete('/firebase/delete/{id}', [FirebaseController::class, 'deleteUser']);

// Protected Routes (Middleware Auth)
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('/home', function () {
        return view('home');
    })->name('home');
});

// Chat Route
Route::get('chat', function () {
    return view('chat');
})->name('chat');

// Laravel's default auth routes (jika diperlukan)
// Auth::routes(); // Komen ini jika tidak diperlukan karena sudah ada custom auth routes

// Home route duplicate - hapus salah satu
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::get('/chat/{chatId}', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/{chatId}/send', [ChatController::class, 'send'])->name('chat.send');

use App\Http\Controllers\FirebaseAuthController;

Route::middleware('auth')->get('/generate-firebase-token', [FirebaseAuthController::class, 'generateCustomToken']);