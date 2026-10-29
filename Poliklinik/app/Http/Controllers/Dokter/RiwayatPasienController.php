<?php

namespace App\Http\Controllers\Dokter;

use App\Exports\RiwayatPasienExport;
use App\Http\Controllers\Controller;
use App\Models\Periksa;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RiwayatPasienController extends Controller
{
    public function index()
    {
        $riwayats = Periksa::with(['daftarPoli.pasien', 'daftarPoli.jadwalPeriksa'])
            ->whereHas('daftarPoli.jadwalPeriksa', fn ($q) => $q->where('id_dokter', Auth::id()))
            ->orderByDesc('tgl_periksa')
            ->get();

        return view('dokter.riwayat-pasien.index', compact('riwayats'));
    }

    public function export()
    {
        return Excel::download(new RiwayatPasienExport(Auth::id()), 'riwayat-pasien.xlsx');
    }

    public function show(string $id)
    {
        $periksa = Periksa::with(['daftarPoli.pasien', 'daftarPoli.jadwalPeriksa.dokter.poli', 'obats'])
            ->whereHas('daftarPoli.jadwalPeriksa', fn ($q) => $q->where('id_dokter', Auth::id()))
            ->findOrFail($id);

        return view('dokter.riwayat-pasien.show', compact('periksa'));
    }
}
