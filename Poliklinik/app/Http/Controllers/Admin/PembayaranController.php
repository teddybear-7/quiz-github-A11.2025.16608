<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use App\Notifications\PembayaranDiverifikasi;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index()
    {
        $tagihans = Periksa::with(['daftarPoli.pasien', 'daftarPoli.jadwalPeriksa.dokter.poli'])
            ->whereIn('status_pembayaran', ['Menunggu Verifikasi', 'Lunas'])
            ->orderByRaw("CASE status_pembayaran WHEN 'Menunggu Verifikasi' THEN 1 ELSE 2 END")
            ->orderByDesc('tgl_periksa')
            ->get();

        return view('admin.pembayaran.index', compact('tagihans'));
    }

    public function update(string $id)
    {
        $periksa = Periksa::with('daftarPoli.pasien')->findOrFail($id);

        $galat = DB::transaction(function () use ($periksa) {
            $terkunci = Periksa::lockForUpdate()->find($periksa->id);

            if ($terkunci->status_pembayaran !== 'Menunggu Verifikasi') {
                return 'Pembayaran ini tidak dalam status menunggu verifikasi.';
            }

            $details = DetailPeriksa::where('id_periksa', $terkunci->id)->get();
            $obats = Obat::whereIn('id', $details->pluck('id_obat'))->lockForUpdate()->get()->keyBy('id');

            foreach ($details as $detail) {
                $obat = $obats[$detail->id_obat];

                if ($obat->stok < $detail->jumlah) {
                    return 'Stok ' . $obat->nama_obat . ' tidak cukup (tersisa ' . $obat->stok . ', dibutuhkan ' . $detail->jumlah . ').';
                }
            }

            foreach ($details as $detail) {
                $obats[$detail->id_obat]->decrement('stok', $detail->jumlah);
            }

            $terkunci->update(['status_pembayaran' => 'Lunas']);

            return null;
        });

        if ($galat) {
            return redirect()->route('verifikasi-pembayaran.index')
                ->with('error', $galat);
        }

        $periksa->daftarPoli->pasien->notify(new PembayaranDiverifikasi($periksa));

        return redirect()->route('verifikasi-pembayaran.index')
            ->with('success', 'Pembayaran berhasil diverifikasi.');
    }
}
