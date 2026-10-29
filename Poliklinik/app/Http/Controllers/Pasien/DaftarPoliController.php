<?php

namespace App\Http\Controllers\Pasien;

use App\Events\AntrianDiperbarui;
use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DaftarPoliController extends Controller
{
    public function index()
    {
        $aktif = $this->pendaftaranAktif();

        $jadwals = JadwalPeriksa::with('dokter.poli')
            ->where('status', 'Aktif')
            ->whereHas('dokter', fn ($q) => $q->whereNotNull('id_poli'))
            ->get()
            ->sortBy(fn ($j) => $j->dokter->poli->nama_poli . '|' . $j->dokter->nama)
            ->groupBy(fn ($j) => $j->dokter->poli->nama_poli);

        return view('pasien.daftar-poli.index', compact('aktif', 'jadwals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_jadwal' => [
                'required',
                Rule::exists('jadwal_periksa', 'id')->where('status', 'Aktif'),
            ],
            'keluhan' => 'required|string|max:1000',
        ], [
            'id_jadwal.required' => 'Jadwal dokter wajib dipilih.',
            'id_jadwal.exists'   => 'Jadwal yang dipilih tidak tersedia atau tidak aktif.',
            'keluhan.required'   => 'Keluhan wajib diisi.',
            'keluhan.max'        => 'Keluhan maksimal 1000 karakter.',
        ]);

        if ($this->pendaftaranAktif()) {
            return redirect()->route('daftar-poli.index')
                ->with('error', 'Anda masih memiliki pendaftaran yang belum diperiksa. Tunggu pemeriksaan selesai sebelum mendaftar lagi.');
        }

        $daftar = DB::transaction(function () use ($validated) {
            $terakhir = DaftarPoli::where('id_jadwal', $validated['id_jadwal'])
                ->whereDate('created_at', today())
                ->lockForUpdate()
                ->max('no_antrian');

            return DaftarPoli::create([
                'id_pasien'  => Auth::id(),
                'id_jadwal'  => $validated['id_jadwal'],
                'keluhan'    => $validated['keluhan'],
                'no_antrian' => ($terakhir ?? 0) + 1,
            ]);
        });

        try {
            AntrianDiperbarui::dispatch($daftar->id_jadwal);
        } catch (\Throwable $e) {
            report($e);
        }

        return redirect()->route('daftar-poli.index')
            ->with('success', 'Pendaftaran berhasil. Nomor antrian Anda: ' . $daftar->no_antrian . '.');
    }

    private function pendaftaranAktif(): ?DaftarPoli
    {
        return DaftarPoli::with('jadwalPeriksa.dokter.poli')
            ->where('id_pasien', Auth::id())
            ->whereDoesntHave('periksa')
            ->latest()
            ->first();
    }
}
