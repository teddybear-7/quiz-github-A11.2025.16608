@php
    $daftar = $periksa->daftarPoli;
    $jadwal = $daftar->jadwalPeriksa;
    $totalObat = $periksa->obats->sum(fn ($o) => $o->harga * $o->pivot->jumlah);
@endphp

<div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200 mb-6">
    <div class="card-body p-7">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 text-sm">
            <div>
                <div class="text-xs uppercase tracking-wider text-slate-400">Pasien</div>
                <div class="font-semibold text-slate-800">{{ $daftar->pasien->nama }}</div>
                <div class="text-slate-500">RM: {{ $daftar->pasien->no_rm ?? '-' }}</div>
            </div>
            <div>
                <div class="text-xs uppercase tracking-wider text-slate-400">Poli</div>
                <div class="font-semibold text-slate-800">{{ $jadwal->dokter->poli->nama_poli ?? '-' }}</div>
            </div>
            <div>
                <div class="text-xs uppercase tracking-wider text-slate-400">Dokter</div>
                <div class="font-semibold text-slate-800">{{ $jadwal->dokter->nama }}</div>
            </div>
            <div>
                <div class="text-xs uppercase tracking-wider text-slate-400">Jadwal</div>
                <div class="font-semibold text-slate-800">
                    {{ $jadwal->hari }}, {{ substr($jadwal->jam_mulai, 0, 5) }}-{{ substr($jadwal->jam_selesai, 0, 5) }}
                </div>
            </div>
            <div>
                <div class="text-xs uppercase tracking-wider text-slate-400">No. Antrian</div>
                <div class="font-semibold text-slate-800">{{ $daftar->no_antrian }}</div>
            </div>
            <div>
                <div class="text-xs uppercase tracking-wider text-slate-400">Tanggal Periksa</div>
                <div class="font-semibold text-slate-800">{{ $periksa->tgl_periksa?->format('d/m/Y H:i') }}</div>
            </div>
        </div>

        <div class="divider my-2"></div>

        <div class="mb-4">
            <div class="text-xs uppercase tracking-wider text-slate-400 mb-1">Keluhan</div>
            <p class="text-slate-700 whitespace-pre-line">{{ $daftar->keluhan }}</p>
        </div>

        <div>
            <div class="text-xs uppercase tracking-wider text-slate-400 mb-1">Catatan Dokter</div>
            <p class="text-slate-700 whitespace-pre-line">{{ $periksa->catatan ?: '-' }}</p>
        </div>
    </div>
</div>

<div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
    <div class="card-body p-0">
        <div class="px-7 pt-6 pb-2 font-bold text-slate-800">Obat yang Diberikan</div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama Obat</th>
                        <th class="px-6 py-3">Kemasan</th>
                        <th class="px-6 py-3 text-right">Harga</th>
                        <th class="px-6 py-3 text-right">Jumlah</th>
                        <th class="px-6 py-3 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($periksa->obats as $obat)
                    <tr>
                        <td class="px-6 py-3 text-slate-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 font-semibold text-slate-800">{{ $obat->nama_obat }}</td>
                        <td class="px-6 py-3 text-slate-500">{{ $obat->kemasan }}</td>
                        <td class="px-6 py-3 text-right text-slate-700">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-3 text-right text-slate-700">{{ $obat->pivot->jumlah }}</td>
                        <td class="px-6 py-3 text-right text-slate-700">Rp {{ number_format($obat->harga * $obat->pivot->jumlah, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-slate-400">Tidak ada obat yang diberikan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-7 py-5 border-t border-slate-100 text-sm">
            <div class="flex justify-between text-slate-500">
                <span>Jasa dokter</span>
                <span>Rp {{ number_format(\App\Models\Periksa::BIAYA_JASA, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-slate-500">
                <span>Total obat</span>
                <span>Rp {{ number_format($totalObat, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between font-bold text-slate-800 text-base mt-2">
                <span>Total Biaya</span>
                <span>Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>
