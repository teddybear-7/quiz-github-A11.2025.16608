<x-layouts.app title="Riwayat Pasien">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Riwayat Pasien
        </h2>

        <a href="{{ route('periksa-pasien.index') }}" class="btn bg-[#2d4499] hover:bg-[#1e2d6b]
                  text-white border-none rounded-lg px-5">
            <i class="fas fa-stethoscope"></i>
            Periksa Pasien
        </a>
    </div>

    {{-- Card --}}
    <div class="card bg-base-100 shadow-md rounded-2 border">
        <div class="card-body p-0">

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">

                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Tanggal Periksa</th>
                            <th class="px-6 py-4">Pasien</th>
                            <th class="px-6 py-4">Keluhan</th>
                            <th class="px-6 py-4">Catatan</th>
                            <th class="px-6 py-4">Total Biaya</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($riwayats as $riwayat)
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-slate-500">{{ $loop->iteration }}</td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $riwayat->tgl_periksa?->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800">{{ $riwayat->daftarPoli->pasien->nama }}</div>
                                <div class="text-xs text-slate-400">RM: {{ $riwayat->daftarPoli->pasien->no_rm ?? '-' }}</div>
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ \Illuminate\Support\Str::limit($riwayat->daftarPoli->keluhan, 40) }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ \Illuminate\Support\Str::limit($riwayat->catatan, 40) }}
                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                Rp {{ number_format($riwayat->biaya_periksa, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('riwayat-pasien.show', $riwayat->id) }}" class="btn btn-sm bg-[#2d4499] hover:bg-[#1e2d6b]
                                          text-white border-none rounded-lg px-4">
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-14 text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                Belum ada riwayat pasien
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</x-layouts.app>
