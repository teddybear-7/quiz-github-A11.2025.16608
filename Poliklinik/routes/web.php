<?php
use App\Http\Controllers\Admin\AdminPoliController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotifikasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\PeriksaPasienController;
use App\Http\Controllers\Dokter\RiwayatPasienController;
use App\Http\Controllers\Pasien\DaftarPoliController;
use App\Http\Controllers\Pasien\DashboardController;
use App\Http\Controllers\Pasien\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pasien\RiwayatPendaftaranController;



Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::resource('polis', AdminPoliController::class);
    Route::get('dokter/export', [DokterController::class, 'export'])->name('dokter.export');
    Route::resource('dokter', DokterController::class);
    Route::get('pasien/export', [PasienController::class, 'export'])->name('pasien.export');
    Route::resource('pasien', PasienController::class);
    Route::get('obat/export', [ObatController::class, 'export'])->name('obat.export');
    Route::resource('obat', ObatController::class)->except('show');

    Route::get('/verifikasi-pembayaran', [AdminPembayaranController::class, 'index'])->name('verifikasi-pembayaran.index');
    Route::put('/verifikasi-pembayaran/{id}', [AdminPembayaranController::class, 'update'])->name('verifikasi-pembayaran.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('/profile/username', [ProfileController::class, 'updateUsername'])->name('admin.profile.username');
});


Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');
    Route::get('/jadwal-periksa/export', [JadwalPeriksaController::class, 'export'])->name('jadwal-periksa.export');
    Route::resource('jadwal-periksa', JadwalPeriksaController::class)->except('show');

    Route::get('/periksa-pasien', [PeriksaPasienController::class, 'index'])->name('periksa-pasien.index');
    Route::get('/periksa-pasien/{daftarPoli}', [PeriksaPasienController::class, 'create'])->name('periksa-pasien.create');
    Route::post('/periksa-pasien/{daftarPoli}', [PeriksaPasienController::class, 'store'])->name('periksa-pasien.store');

    Route::get('/riwayat-pasien', [RiwayatPasienController::class, 'index'])->name('riwayat-pasien.index');
    Route::get('/riwayat-pasien/export', [RiwayatPasienController::class, 'export'])->name('riwayat-pasien.export');
    Route::get('/riwayat-pasien/{id}', [RiwayatPasienController::class, 'show'])->name('riwayat-pasien.show');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('dokter.notifikasi.index');
    Route::post('/notifikasi/baca-semua', [NotifikasiController::class, 'bacaSemua'])->name('dokter.notifikasi.baca-semua');
    Route::post('/notifikasi/{id}/baca', [NotifikasiController::class, 'baca'])->name('dokter.notifikasi.baca');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('dokter.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('dokter.profile.update');
    Route::put('/profile/username', [ProfileController::class, 'updateUsername'])->name('dokter.profile.username');
});


Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('pasien.dashboard');

    Route::get('/daftar-poli', [DaftarPoliController::class, 'index'])->name('daftar-poli.index');
    Route::post('/daftar-poli', [DaftarPoliController::class, 'store'])->name('daftar-poli.store');

    Route::get('/riwayat-pendaftaran', [RiwayatPendaftaranController::class, 'index'])->name('riwayat-pendaftaran.index');
    Route::get('/riwayat-pendaftaran/{id}', [RiwayatPendaftaranController::class, 'show'])->name('riwayat-pendaftaran.show');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('pasien.notifikasi.index');
    Route::post('/notifikasi/baca-semua', [NotifikasiController::class, 'bacaSemua'])->name('pasien.notifikasi.baca-semua');
    Route::post('/notifikasi/{id}/baca', [NotifikasiController::class, 'baca'])->name('pasien.notifikasi.baca');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran/{id}', [PembayaranController::class, 'store'])->name('pembayaran.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('pasien.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('pasien.profile.update');
    Route::put('/profile/username', [ProfileController::class, 'updateUsername'])->name('pasien.profile.username');
});