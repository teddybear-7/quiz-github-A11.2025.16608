<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Obat;
use App\Models\Periksa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeriksaPasienController extends Controller
{
    public function index()
    {
        $antrians = DaftarPoli::with(['pasien', 'jadwalPeriksa'])
            ->whereHas('jadwalPeriksa', fn ($q) => $q->where('id_dokter', Auth::id()))
            ->whereDoesntHave('periksa')
            ->orderBy(DB::raw('DATE(created_at)'))
            ->orderBy('no_antrian')
            ->get();

        return view('dokter.periksa-pasien.index', compact('antrians'));
    }

    public function create(DaftarPoli $daftarPoli)
    {
        $this->pastikanMilikSaya($daftarPoli);

        if ($daftarPoli->periksa()->exists()) {
            return redirect()->route('periksa-pasien.index')
                ->with('error', 'Pasien ini sudah diperiksa.');
        }

        $daftarPoli->load(['pasien', 'jadwalPeriksa']);
        $obats = Obat::orderBy('nama_obat')->get();

        return view('dokter.periksa-pasien.create', compact('daftarPoli', 'obats'));
    }

    public function store(Request $request, DaftarPoli $daftarPoli)
    {
        $this->pastikanMilikSaya($daftarPoli);

        $validated = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan'     => 'required|string|max:1000',
            'obat'        => 'nullable|array',
            'obat.*'      => 'integer|distinct|exists:obat,id',
        ], [
            'tgl_periksa.required' => 'Tanggal periksa wajib diisi.',
            'tgl_periksa.date'     => 'Tanggal periksa tidak valid.',
            'catatan.required'     => 'Catatan pemeriksaan wajib diisi.',
            'catatan.max'          => 'Catatan maksimal 1000 karakter.',
            'obat.*.exists'        => 'Obat yang dipilih tidak ditemukan.',
            'obat.*.distinct'      => 'Obat yang sama dipilih lebih dari sekali.',
        ]);

        $obatIds = $validated['obat'] ?? [];

        $periksa = DB::transaction(function () use ($daftarPoli, $validated, $obatIds) {
            $sudah = Periksa::where('id_daftar_poli', $daftarPoli->id)->lockForUpdate()->exists();
            if ($sudah) {
                return null;
            }

            $biaya = Periksa::BIAYA_JASA + (int) Obat::whereIn('id', $obatIds)->sum('harga');

            $periksa = Periksa::create([
                'id_daftar_poli' => $daftarPoli->id,
                'tgl_periksa'    => Carbon::parse($validated['tgl_periksa']),
                'catatan'        => $validated['catatan'],
                'biaya_periksa'  => $biaya,
            ]);

            $periksa->obats()->attach($obatIds);

            return $periksa;
        });

        if (! $periksa) {
            return redirect()->route('periksa-pasien.index')
                ->with('error', 'Pasien ini sudah diperiksa.');
        }

        return redirect()->route('riwayat-pasien.show', $periksa->id)
            ->with('success', 'Pemeriksaan berhasil disimpan.');
    }

    private function pastikanMilikSaya(DaftarPoli $daftarPoli): void
    {
        abort_unless(
            (int) $daftarPoli->jadwalPeriksa->id_dokter === (int) Auth::id(),
            404
        );
    }
}
