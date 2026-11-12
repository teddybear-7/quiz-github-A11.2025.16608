<x-layouts.app title="Periksa Pasien">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Periksa Pasien
        </h2>

        <a href="{{ route('riwayat-pasien.index') }}"
            class="flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-semibold transition">
            <i class="fas fa-folder-open"></i>
            Riwayat Pasien
        </a>
    </div>

    {{-- Card --}}
    <div class="card bg-base-100 shadow-md rounded-2 border">
        <div class="card-body p-0">

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">

                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Tanggal Daftar</th>
                            <th class="px-6 py-4">No. Antrian</th>
                            <th class="px-6 py-4">Pasien</th>
                            <th class="px-6 py-4">Keluhan</th>
                            <th class="px-6 py-4">Jadwal</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($antrians as $antrian)
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-slate-600">
                                {{ $antrian->created_at->format('d/m/Y') }}
                            </td>

                            <td class="px-6 py-4 font-bold text-[#2d4499]">{{ $antrian->no_antrian }}</td>

                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800">{{ $antrian->pasien->nama }}</div>
                                <div class="text-xs text-slate-400">RM: {{ $antrian->pasien->no_rm ?? '-' }}</div>
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ \Illuminate\Support\Str::limit($antrian->keluhan, 60) }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $antrian->jadwalPeriksa->hari }},
                                {{ substr($antrian->jadwalPeriksa->jam_mulai, 0, 5) }}-{{ substr($antrian->jadwalPeriksa->jam_selesai, 0, 5) }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('periksa-pasien.create', $antrian->id) }}" class="btn btn-sm bg-[#2d4499] hover:bg-[#1e2d6b]
                                          text-white border-none rounded-lg px-4">
                                    <i class="fas fa-stethoscope"></i>
                                    Periksa
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-14 text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                Belum ada pasien yang mengantri
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</x-layouts.app>
