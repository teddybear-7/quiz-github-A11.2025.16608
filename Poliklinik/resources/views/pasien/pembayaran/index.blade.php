<x-layouts.app title="Pembayaran">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Pembayaran
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
                            <th class="px-6 py-4">Tanggal Periksa</th>
                            <th class="px-6 py-4">Poli</th>
                            <th class="px-6 py-4">Dokter</th>
                            <th class="px-6 py-4">Total Biaya</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Bukti Pembayaran</th>
                        </tr>
                    </thead>

                    {{-- Body --}}
                    <tbody>
                        @forelse($tagihans as $tagihan)
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-slate-500">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $tagihan->tgl_periksa->format('d-m-Y H:i') }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $tagihan->daftarPoli->jadwalPeriksa->dokter->poli->nama_poli }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ $tagihan->daftarPoli->jadwalPeriksa->dokter->nama }}
                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                Rp {{ number_format($tagihan->biaya_periksa, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                @if($tagihan->status_pembayaran === 'Lunas')
                                <span class="badge badge-success text-white">Lunas</span>
                                @elseif($tagihan->status_pembayaran === 'Menunggu Verifikasi')
                                <span class="badge badge-warning">Menunggu Verifikasi</span>
                                @else
                                <span class="badge badge-ghost">Belum Dibayar</span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                @if($tagihan->status_pembayaran === 'Belum Dibayar')
                                <form action="{{ route('pembayaran.store', $tagihan->id) }}" method="POST"
                                    enctype="multipart/form-data" class="flex items-center gap-2">
                                    @csrf
                                    <input type="file" name="bukti" accept="image/png,image/jpeg"
                                        class="file-input file-input-bordered file-input-sm w-56 @error('bukti') file-input-error @enderror"
                                        required>
                                    <button type="submit"
                                        class="btn btn-sm bg-[#2d4499] hover:bg-[#1e2d6b] text-white border-none rounded-lg px-4">
                                        <i class="fas fa-upload"></i>
                                        Upload
                                    </button>
                                </form>
                                @error('bukti')
                                <span class="label-text-alt text-red-500">{{ $message }}</span>
                                @enderror
                                @else
                                <a href="{{ asset('storage/' . $tagihan->bukti_pembayaran) }}" target="_blank"
                                    class="btn btn-sm bg-slate-100 hover:bg-slate-200 text-slate-600 border-none rounded-lg px-4">
                                    <i class="fas fa-image"></i>
                                    Lihat Bukti
                                </a>
                                @endif
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-14 text-slate-400">
                                <i class="fas fa-inbox text-3xl mb-3 block"></i>
                                Belum ada tagihan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</x-layouts.app>
