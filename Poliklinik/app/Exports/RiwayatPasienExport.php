<?php

namespace App\Exports;

use App\Models\Periksa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RiwayatPasienExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private int $idDokter)
    {
    }

    public function collection()
    {
        return Periksa::with(['daftarPoli.pasien', 'obats'])
            ->whereHas('daftarPoli.jadwalPeriksa', fn ($q) => $q->where('id_dokter', $this->idDokter))
            ->orderByDesc('tgl_periksa')
            ->get();
    }

    public function headings(): array
    {
        return ['Tanggal Periksa', 'Nama Pasien', 'No. RM', 'Keluhan', 'Catatan', 'Obat', 'Biaya Periksa'];
    }

    public function map($periksa): array
    {
        return [
            $periksa->tgl_periksa->format('d-m-Y H:i'),
            $periksa->daftarPoli->pasien->nama,
            $periksa->daftarPoli->pasien->no_rm ?? '-',
            $periksa->daftarPoli->keluhan,
            $periksa->catatan,
            $periksa->obats->map(fn ($o) => $o->nama_obat . ' x' . $o->pivot->jumlah)->implode(', '),
            $periksa->biaya_periksa,
        ];
    }
}
