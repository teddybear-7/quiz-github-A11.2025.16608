<?php

namespace App\Exports;

use App\Models\JadwalPeriksa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JadwalPeriksaExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private int $idDokter)
    {
    }

    public function collection()
    {
        return JadwalPeriksa::where('id_dokter', $this->idDokter)
            ->orderByRaw("CASE hari
                WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3
                WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6
                ELSE 7 END")
            ->orderBy('jam_mulai')
            ->get();
    }

    public function headings(): array
    {
        return ['Hari', 'Jam Mulai', 'Jam Selesai', 'Status'];
    }

    public function map($jadwal): array
    {
        return [
            $jadwal->hari,
            substr($jadwal->jam_mulai, 0, 5),
            substr($jadwal->jam_selesai, 0, 5),
            $jadwal->status,
        ];
    }
}
