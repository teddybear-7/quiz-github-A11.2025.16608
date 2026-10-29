<?php

namespace App\Http\Controllers\Dokter;

use App\Exports\JadwalPeriksaExport;
use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class JadwalPeriksaController extends Controller
{
    private const HARI = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    public function index()
    {
        $jadwals = JadwalPeriksa::where('id_dokter', Auth::id())
            ->orderByRaw("CASE hari
                WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3
                WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6
                ELSE 7 END")
            ->orderBy('jam_mulai')
            ->get();

        return view('dokter.jadwal-periksa.index', compact('jadwals'));
    }

    public function export()
    {
        return Excel::download(new JadwalPeriksaExport(Auth::id()), 'jadwal-periksa.xlsx');
    }

    public function create()
    {
        return view('dokter.jadwal-periksa.create', ['hariList' => self::HARI]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules(), $this->messages());

        if ($this->bentrok($validated)) {
            return back()->withInput()->withErrors([
                'jam_mulai' => 'Jadwal bentrok dengan jadwal lain pada hari yang sama.',
            ]);
        }

        JadwalPeriksa::create([
            'id_dokter'   => Auth::id(),
            'hari'        => $validated['hari'],
            'jam_mulai'   => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'status'      => 'Tidak Aktif',
        ]);

        return redirect()->route('jadwal-periksa.index')
            ->with('success', 'Jadwal periksa berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $jadwal = $this->jadwalMilikSaya($id);

        return view('dokter.jadwal-periksa.edit', [
            'jadwal'   => $jadwal,
            'hariList' => self::HARI,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $jadwal = $this->jadwalMilikSaya($id);

        $validated = $request->validate(
            $this->rules() + ['status' => 'nullable|in:Aktif,Tidak Aktif'],
            $this->messages()
        );

        if ($this->bentrok($validated, $jadwal->id)) {
            return back()->withInput()->withErrors([
                'jam_mulai' => 'Jadwal bentrok dengan jadwal lain pada hari yang sama.',
            ]);
        }

        $status = $validated['status'] ?? $jadwal->status;

        DB::transaction(function () use ($jadwal, $validated, $status) {
            if ($status === 'Aktif') {
                JadwalPeriksa::where('id_dokter', Auth::id())
                    ->where('id', '!=', $jadwal->id)
                    ->update(['status' => 'Tidak Aktif']);
            }

            $jadwal->update([
                'hari'        => $validated['hari'],
                'jam_mulai'   => $validated['jam_mulai'],
                'jam_selesai' => $validated['jam_selesai'],
                'status'      => $status,
            ]);
        });

        return redirect()->route('jadwal-periksa.index')
            ->with('success', 'Jadwal periksa berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $jadwal = $this->jadwalMilikSaya($id);

        if ($jadwal->daftarPolis()->exists()) {
            return redirect()->route('jadwal-periksa.index')
                ->with('error', 'Jadwal tidak dapat dihapus karena sudah dipakai pendaftaran pasien.');
        }

        $jadwal->delete();

        return redirect()->route('jadwal-periksa.index')
            ->with('success', 'Jadwal periksa berhasil dihapus.');
    }

    private function jadwalMilikSaya(string $id): JadwalPeriksa
    {
        return JadwalPeriksa::where('id_dokter', Auth::id())->findOrFail($id);
    }

    private function bentrok(array $data, ?int $exceptId = null): bool
    {
        $mulai   = $data['jam_mulai'] . ':00';
        $selesai = $data['jam_selesai'] . ':00';

        return JadwalPeriksa::where('id_dokter', Auth::id())
            ->where('hari', $data['hari'])
            ->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))
            ->where('jam_mulai', '<', $selesai)
            ->where('jam_selesai', '>', $mulai)
            ->exists();
    }

    private function rules(): array
    {
        return [
            'hari'        => 'required|in:' . implode(',', self::HARI),
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ];
    }

    private function messages(): array
    {
        return [
            'hari.required'            => 'Hari wajib dipilih.',
            'hari.in'                  => 'Hari tidak valid.',
            'jam_mulai.required'       => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format'    => 'Format jam mulai harus HH:MM.',
            'jam_selesai.required'     => 'Jam selesai wajib diisi.',
            'jam_selesai.date_format'  => 'Format jam selesai harus HH:MM.',
            'jam_selesai.after'        => 'Jam selesai harus lebih besar dari jam mulai.',
            'status.in'                => 'Status tidak valid.',
        ];
    }
}
