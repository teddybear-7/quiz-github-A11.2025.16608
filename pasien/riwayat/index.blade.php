<x-layouts.app title="Riwayat Pendaftaran">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Riwayat Pendaftaran
        </h2>

        <a href="{{ route('daftar-poli.index') }}" class="btn bg-[#2d4499] hover:bg-[#1e2d6b]
                  text-white border-none rounded-lg px-5">
            <i class="fas fa-plus"></i>
            Daftar Poli
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
                            <th class="px-6 py-4">Tanggal Daftar</th>
                            <th class="px-6 py-4">Poli</th>
                            <th class="px-6 py-4">Dokter</th>
                            <th class="px-6 py-4">Jadwal</th>
                            <th class="px-6 py-4">No. Antrian</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($riwayats as $riwayat)
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-slate-500">{{ $loop->iteration }}</td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $riwayat->created_at->format('d/m/Y') }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ $riwayat->jadwalPeriksa->dokter->poli->nama_poli ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $riwayat->jadwalPeriksa->dokter->nama ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $riwayat->jadwalPeriksa->hari }},
                                {{ substr($riwayat->jadwalPeriksa->jam_mulai, 0, 5) }}-{{ substr($riwayat->jadwalPeriksa->jam_selesai, 0, 5) }}
                            </td>

                            <td class="px-6 py-4 font-bold text-[#2d4499]">{{ $riwayat->no_antrian }}</td>

                            <td class="px-6 py-4">
                                @if($riwayat->periksa)
                                <span class="badge badge-success text-white">Sudah diperiksa</span>
                                @else
                                <span class="badge badge-warning">Belum diperiksa</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                @if($riwayat->periksa)
                                <a href="{{ route('riwayat-pendaftaran.show', $riwayat->periksa->id) }}" class="btn btn-sm bg-[#2d4499] hover:bg-[#1e2d6b]
                                          text-white border-none rounded-lg px-4">
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </a>
                                @else
                                <span class="text-slate-300">-</span>
                                @endif
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-14 text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                Belum ada riwayat pendaftaran
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</x-layouts.app>
