<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Periksa;
use App\Notifications\PembayaranDiunggah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index()
    {
        $tagihans = Periksa::with(['daftarPoli.jadwalPeriksa.dokter.poli'])
            ->whereHas('daftarPoli', fn ($q) => $q->where('id_pasien', Auth::id()))
            ->orderByDesc('tgl_periksa')
            ->get();

        return view('pasien.pembayaran.index', compact('tagihans'));
    }

    public function store(Request $request, string $id)
    {
        $periksa = Periksa::with('daftarPoli.jadwalPeriksa.dokter')
            ->whereHas('daftarPoli', fn ($q) => $q->where('id_pasien', Auth::id()))
            ->findOrFail($id);

        $request->validate([
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'bukti.required' => 'Foto bukti pembayaran wajib diunggah.',
            'bukti.image'    => 'Bukti pembayaran harus berupa gambar.',
            'bukti.mimes'    => 'Bukti pembayaran harus berformat JPG atau PNG.',
            'bukti.max'      => 'Ukuran bukti pembayaran maksimal 2 MB.',
        ]);

        $path = $request->file('bukti')->store('bukti-pembayaran', 'public');

        $berhasil = DB::transaction(function () use ($periksa, $path) {
            $terkunci = Periksa::lockForUpdate()->find($periksa->id);

            if ($terkunci->status_pembayaran !== 'Belum Dibayar') {
                return false;
            }

            $terkunci->update([
                'bukti_pembayaran'  => $path,
                'status_pembayaran' => 'Menunggu Verifikasi',
            ]);

            return true;
        });

        if (! $berhasil) {
            return redirect()->route('pembayaran.index')
                ->with('error', 'Tagihan ini sudah dibayar atau sedang menunggu verifikasi.');
        }

        $periksa->daftarPoli->jadwalPeriksa->dokter->notify(new PembayaranDiunggah($periksa));

        return redirect()->route('pembayaran.index')
            ->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
    }
}
