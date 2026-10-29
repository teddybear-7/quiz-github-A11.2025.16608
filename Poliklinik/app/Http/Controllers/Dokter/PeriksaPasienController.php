<?php

namespace App\Http\Controllers\Dokter;

use App\Events\AntrianDiperbarui;
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
            'jumlah'      => 'nullable|array',
            'jumlah.*'    => 'nullable|integer|min:1',
        ], [
            'tgl_periksa.required' => 'Tanggal periksa wajib diisi.',
            'tgl_periksa.date'     => 'Tanggal periksa tidak valid.',
            'catatan.required'     => 'Catatan pemeriksaan wajib diisi.',
            'catatan.max'          => 'Catatan maksimal 1000 karakter.',
            'obat.*.exists'        => 'Obat yang dipilih tidak ditemukan.',
            'obat.*.distinct'      => 'Obat yang sama dipilih lebih dari sekali.',
            'jumlah.*.integer'     => 'Jumlah obat harus berupa angka bulat.',
            'jumlah.*.min'         => 'Jumlah obat minimal 1.',
        ]);

        $obatIds = $validated['obat'] ?? [];
        $obats = Obat::whereIn('id', $obatIds)->get()->keyBy('id');
        $jumlahObat = [];

        foreach ($obatIds as $idObat) {
            $jumlah = (int) ($validated['jumlah'][$idObat] ?? 1);
            $obat = $obats[$idObat];

            if ($jumlah > $obat->stok) {
                return back()->withInput()->withErrors([
                    'obat' => 'Jumlah ' . $obat->nama_obat . ' melebihi stok yang tersedia (' . $obat->stok . ').',
                ]);
            }

            $jumlahObat[$idObat] = $jumlah;
        }

        $periksa = DB::transaction(function () use ($daftarPoli, $validated, $obats, $jumlahObat) {
            $sudah = Periksa::where('id_daftar_poli', $daftarPoli->id)->lockForUpdate()->exists();
            if ($sudah) {
                return null;
            }

            $biaya = Periksa::BIAYA_JASA;
            $lampiran = [];

            foreach ($jumlahObat as $idObat => $jumlah) {
                $biaya += $obats[$idObat]->harga * $jumlah;
                $lampiran[$idObat] = ['jumlah' => $jumlah];
            }

            $periksa = Periksa::create([
                'id_daftar_poli' => $daftarPoli->id,
                'tgl_periksa'    => Carbon::parse($validated['tgl_periksa']),
                'catatan'        => $validated['catatan'],
                'biaya_periksa'  => $biaya,
            ]);

            $periksa->obats()->attach($lampiran);

            return $periksa;
        });

        if (! $periksa) {
            return redirect()->route('periksa-pasien.index')
                ->with('error', 'Pasien ini sudah diperiksa.');
        }

        try {
            AntrianDiperbarui::dispatch($daftarPoli->id_jadwal);
        } catch (\Throwable $e) {
            report($e);
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
