<x-layouts.app title="Verifikasi Pembayaran">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Verifikasi Pembayaran
        </h2>
    </div>

    {{-- Card --}}
    <div class="card bg-base-100 shadow-md rounded-2 border">
        <div class="card-body p-0">

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">

                    {{-- Head --}}
                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Pasien</th>
                            <th class="px-6 py-4">Poli</th>
                            <th class="px-6 py-4">Tanggal Periksa</th>
                            <th class="px-6 py-4">Total Biaya</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    {{-- Body --}}
                    <tbody>
                        @forelse($tagihans as $tagihan)
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-slate-500">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ $tagihan->daftarPoli->pasien->nama }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $tagihan->daftarPoli->jadwalPeriksa->dokter->poli->nama_poli }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $tagihan->tgl_periksa->format('d-m-Y H:i') }}
                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                Rp {{ number_format($tagihan->biaya_periksa, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                @if($tagihan->status_pembayaran === 'Lunas')
                                <span class="badge badge-success text-white">Lunas</span>
                                @else
                                <span class="badge badge-warning">Menunggu Verifikasi</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">

                                    {{-- Bukti --}}
                                    <a href="{{ asset('storage/' . $tagihan->bukti_pembayaran) }}" target="_blank"
                                        class="btn btn-sm bg-slate-100 hover:bg-slate-200 text-slate-600 border-none rounded-lg px-4">
                                        <i class="fas fa-image"></i>
                                        Lihat Bukti
                                    </a>

                                    {{-- Verifikasi --}}
                                    @if($tagihan->status_pembayaran === 'Menunggu Verifikasi')
                                    <form action="{{ route('verifikasi-pembayaran.update', $tagihan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            onclick="return confirm('Yakin pembayaran ini sudah sesuai?')"
                                            class="btn btn-sm bg-emerald-600 hover:bg-emerald-700 text-white border-none rounded-lg px-4">
                                            <i class="fas fa-check"></i>
                                            Verifikasi
                                        </button>
                                    </form>
                                    @endif

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-14 text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                Belum ada pembayaran yang perlu diverifikasi
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</x-layouts.app>
