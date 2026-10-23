<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;

class RiwayatPendaftaranController extends Controller
{
    public function index()
    {
        $riwayats = DaftarPoli::with(['jadwalPeriksa.dokter.poli', 'periksa'])
            ->where('id_pasien', Auth::id())
            ->latest()
            ->get();

        return view('pasien.riwayat.index', compact('riwayats'));
    }

    public function show(string $id)
    {
        $periksa = Periksa::with(['daftarPoli.pasien', 'daftarPoli.jadwalPeriksa.dokter.poli', 'obats'])
            ->whereHas('daftarPoli', fn ($q) => $q->where('id_pasien', Auth::id()))
            ->findOrFail($id);

        return view('pasien.riwayat.show', compact('periksa'));
    }
}
