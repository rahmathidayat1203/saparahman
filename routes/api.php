<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DetailEkskulRaportController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HafalanArabController;
use App\Http\Controllers\HafalanFiqihController;
use App\Http\Controllers\HafalanInggrisController;
use App\Http\Controllers\HafalanSurahController;
use App\Http\Controllers\HafalanTahfidzController;
use App\Http\Controllers\JenisKasusController;
use App\Http\Controllers\KalenderAkademikController;
use App\Http\Controllers\KandunganMadingController;
use App\Http\Controllers\KasusController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MadingController;
use App\Http\Controllers\MapelKelasController;
use App\Http\Controllers\MasterEkskulController;
use App\Http\Controllers\MasterMapelController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\OrtuSantriController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PeraturanController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\SantriController;
use App\Models\Raport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('santri', SantriController::class); 
// Route::apiResource('orang_tua', OrangTuaController::class);
// Route::apiResource('ortu_santri', OrtuSantriController::class);
// Route::apiResource('guru', GuruController::class);
// Route::apiResource('admin', AdminController::class);
// Route::apiResource('kasus', KasusController::class);
// Route::apiResource('jenis_kasus', JenisKasusController::class);
// Route::apiResource('kelas', KelasController::class);
// Route::apiResource('master_mapel', MasterMapelController::class);
// Route::apiResource('mapel_kelas', MapelKelasController::class);
// Route::apiResource('master_ekskul', MasterEkskulController::class);
// Route::apiResource('detail_ekskul_raport', DetailEkskulRaportController::class);
// Route::apiResource('raport', RaportController::class);

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
Route::get('pengumuman', [PengumumanController::class, 'get_pengumuman_data'])->middleware('auth:sanctum');
Route::get('santri-by-ortu', [SantriController::class, 'get_all_santri_by_ortu'])->middleware('auth:sanctum');
Route::get('kandungan_mading', [KandunganMadingController::class, 'kandungan_mading'])->middleware('auth:sanctum');
Route::get('mading', [MadingController::class, 'get_all_mading'])->middleware('auth:sanctum');
Route::get('getAllKasus', [KasusController::class, 'getAllKasus'])->middleware('auth:sanctum');
Route::get('kelas', [RaportController::class, 'get_kelas']);
Route::get('raport', [RaportController::class, 'get_all_mapel'])->middleware('auth:sanctum');
Route::get('/hafalan-surah', [HafalanSurahController::class, 'getBySantri'])->middleware('auth:sanctum');
Route::get('/hafalan-tahfidz', [HafalanTahfidzController::class, 'getBySantri'])->middleware('auth:sanctum');
Route::get('/hafalan-arab', [HafalanArabController::class, 'getBySantri'])->middleware('auth:sanctum');
Route::get('/hafalan-inggris', [HafalanInggrisController::class, 'getBySantri'])->middleware('auth:sanctum');
Route::get('/hafalan-fiqih', [HafalanFiqihController::class, 'getBySantri'])->middleware('auth:sanctum');
Route::get('kalendar-akademik', [KalenderAkademikController::class, 'getKalendar']);
Route::get('/peraturan', [PeraturanController::class, 'peraturan']);
Route::get('/guru', [GuruController::class, 'getAllGuru']);
Route::get('/kandungan-mading', [KandunganMadingController::class, 'kandungan_mading']);
Route::get('/kandungan_mading_by_asas', [KandunganMadingController::class, 'kandungan_mading_by_asas']);
Route::get('mading_by_id/{id}',[MadingController::class,'mading_by_id']);

Route::post('update-profile-base64', [AuthController::class, 'update_foto_profile_base64'])->middleware('auth:sanctum');
