<x-layouts.app title="Dashboard Pasien">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Dashboard Pasien
        </h2>
    </div>

    {{-- Banner antrian --}}
    @if($aktif)
    <div class="card bg-base-100 shadow-md rounded-2xl border border-amber-300 mb-6">
        <div class="card-body p-7">
            <div class="flex items-center gap-2 mb-4">
                <i class="fas fa-ticket text-amber-500"></i>
                <h3 class="font-bold text-slate-800">Antrian Aktif Anda</h3>
                <span class="badge badge-warning">Belum diperiksa</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 text-sm">
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Poli</div>
                    <div class="font-semibold text-slate-800">{{ $aktif->jadwalPeriksa->dokter->poli->nama_poli }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Dokter</div>
                    <div class="font-semibold text-slate-800">{{ $aktif->jadwalPeriksa->dokter->nama }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Jadwal</div>
                    <div class="font-semibold text-slate-800">
                        {{ $aktif->jadwalPeriksa->hari }},
                        {{ substr($aktif->jadwalPeriksa->jam_mulai, 0, 5) }} - {{ substr($aktif->jadwalPeriksa->jam_selesai, 0, 5) }}
                    </div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">No. Antrian Anda</div>
                    <div class="text-3xl font-extrabold text-[#2d4499]">{{ $aktif->no_antrian }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Sedang Dilayani</div>
                    <div class="text-3xl font-extrabold text-emerald-600 nomor-dilayani"
                        data-jadwal="{{ $aktif->id_jadwal }}">
                        {{ $aktif->jadwalPeriksa->nomorDilayani() ?? '-' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200 mb-6">
        <div class="card-body p-7 flex-row items-center justify-between">
            <div class="text-slate-500 text-sm">
                Anda belum memiliki antrian aktif.
            </div>

            <a href="{{ route('daftar-poli.index') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-[#2d4499] hover:bg-[#1e2d6b] text-white rounded-lg text-sm font-semibold transition">
                <i class="fas fa-notes-medical"></i>
                Daftar Poli
            </a>
        </div>
    </div>
    @endif

    {{-- Jadwal dokter --}}
    <div class="card bg-base-100 shadow-md rounded-2 border">
        <div class="card-body p-0">

            <div class="px-6 pt-6 pb-2 font-bold text-slate-800">
                Jadwal Dokter
            </div>

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">

                    {{-- Head --}}
                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Poli</th>
                            <th class="px-6 py-4">Dokter</th>
                            <th class="px-6 py-4">Hari</th>
                            <th class="px-6 py-4">Jam</th>
                            <th class="px-6 py-4">Sedang Dilayani</th>
                        </tr>
                    </thead>

                    {{-- Body --}}
                    <tbody>
                        @forelse($jadwals as $jadwal)
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-slate-500">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $jadwal->dokter->poli->nama_poli }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ $jadwal->dokter->nama }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $jadwal->hari }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}
                            </td>

                            <td class="px-6 py-4 font-bold text-emerald-600 nomor-dilayani"
                                data-jadwal="{{ $jadwal->id }}">
                                {{ $jadwal->nomorDilayani() ?? '-' }}
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-14 text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                Belum ada jadwal dokter yang aktif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        (function () {
            if (!window.Echo) return;

            var ids = [];
            document.querySelectorAll('.nomor-dilayani').forEach(function (el) {
                if (ids.indexOf(el.dataset.jadwal) === -1) ids.push(el.dataset.jadwal);
            });

            ids.forEach(function (id) {
                window.Echo.channel('antrian.' + id).listen('.antrian.diperbarui', function (e) {
                    document.querySelectorAll('.nomor-dilayani[data-jadwal="' + e.id_jadwal + '"]').forEach(function (el) {
                        el.textContent = e.nomor_dilayani === null ? '-' : e.nomor_dilayani;
                    });
                });
            });
        })();
    </script>
    @endpush

</x-layouts.app>
