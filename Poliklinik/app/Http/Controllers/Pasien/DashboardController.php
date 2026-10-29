<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $aktif = DaftarPoli::with('jadwalPeriksa.dokter.poli')
            ->where('id_pasien', Auth::id())
            ->whereDoesntHave('periksa')
            ->latest()
            ->first();

        $jadwals = JadwalPeriksa::with('dokter.poli')
            ->where('status', 'Aktif')
            ->whereHas('dokter', fn ($q) => $q->whereNotNull('id_poli'))
            ->get()
            ->sortBy(fn ($j) => $j->dokter->poli->nama_poli . '|' . $j->dokter->nama);

        return view('pasien.dashboard', compact('aktif', 'jadwals'));
    }
}
