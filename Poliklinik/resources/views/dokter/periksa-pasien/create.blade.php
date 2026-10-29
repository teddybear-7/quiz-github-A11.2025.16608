<x-layouts.app title="Periksa Pasien">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('periksa-pasien.index') }}"
            class="flex items-center justify-center w-9 h-9 rounded-lg bg-slate-100 text-slate-500 hover:bg-slate-200 transition">
            <i class="fas fa-arrow-left text-xs"></i>
        </a>
        <h2 class="text-xl font-bold text-slate-800">
            Periksa Pasien
        </h2>
    </div>

    {{-- Info pasien --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200 mb-6">
        <div class="card-body p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 text-sm">
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Pasien</div>
                    <div class="font-semibold text-slate-800">{{ $daftarPoli->pasien->nama }}</div>
                    <div class="text-slate-500">RM: {{ $daftarPoli->pasien->no_rm ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">No. Antrian</div>
                    <div class="text-2xl font-extrabold text-[#2d4499]">{{ $daftarPoli->no_antrian }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Keluhan</div>
                    <div class="text-slate-700 whitespace-pre-line">{{ $daftarPoli->keluhan }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form pemeriksaan --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-7">

            <form action="{{ route('periksa-pasien.store', $daftarPoli->id) }}" method="POST">
                @csrf

                {{-- Tanggal periksa --}}
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Tanggal Periksa <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <input type="text" name="tgl_periksa"
                        value="{{ old('tgl_periksa', now()->format('Y-m-d H:i')) }}"
                        class="tgl-picker input input-bordered w-full rounded-lg text-sm @error('tgl_periksa') input-error @enderror"
                        required>

                    @error('tgl_periksa')
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                </div>

                {{-- Catatan --}}
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Catatan Pemeriksaan <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <textarea name="catatan" rows="4" maxlength="1000" placeholder="Diagnosa, tindakan, dan anjuran..."
                        class="textarea textarea-bordered w-full rounded-lg text-sm resize-none @error('catatan') textarea-error @enderror"
                        required>{{ old('catatan') }}</textarea>

                    @error('catatan')
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                </div>

                {{-- Obat --}}
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">Obat dan jumlah yang harus dibeli (opsional)</span>
                    </label>

                    <div class="border border-slate-200 rounded-lg divide-y divide-slate-100 max-h-72 overflow-y-auto">
                        @forelse($obats as $obat)
                        <div class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50">
                            <label class="flex items-center gap-3 flex-1 cursor-pointer">
                                <input type="checkbox" name="obat[]" value="{{ $obat->id }}" data-harga="{{ $obat->harga }}"
                                    class="checkbox checkbox-sm obat-check"
                                    {{ $obat->stok < 1 ? 'disabled' : '' }}
                                    {{ in_array($obat->id, old('obat', [])) ? 'checked' : '' }}>
                                <span class="flex-1">
                                    <span class="font-semibold text-slate-800 text-sm">{{ $obat->nama_obat }}</span>
                                    <span class="text-xs text-slate-400 ml-1">{{ $obat->kemasan }}</span>
                                    <span class="block text-xs {{ $obat->stok < 1 ? 'text-red-500' : 'text-slate-400' }}">
                                        {{ $obat->stok < 1 ? 'Stok habis' : 'Stok: ' . $obat->stok }}
                                    </span>
                                </span>
                            </label>

                            <div class="flex items-center gap-2">
                                <span class="text-xs text-slate-400">Jumlah</span>
                                <input type="number" name="jumlah[{{ $obat->id }}]" min="1" max="{{ $obat->stok }}" step="1"
                                    value="{{ old('jumlah.' . $obat->id, 1) }}"
                                    class="input input-bordered input-sm w-20 rounded-lg text-sm obat-jumlah" disabled>
                            </div>

                            <span class="text-sm text-slate-600 w-28 text-right">Rp {{ number_format($obat->harga, 0, ',', '.') }}</span>
                        </div>
                        @empty
                        <div class="px-4 py-6 text-center text-slate-400 text-sm">Belum ada data obat</div>
                        @endforelse
                    </div>

                    @error('obat')
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                    @error('obat.*')
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                    @error('jumlah.*')
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                </div>

                {{-- Estimasi biaya --}}
                <div class="flex items-center justify-between bg-slate-50 rounded-lg px-5 py-4 mb-6 text-sm">
                    <div class="text-slate-500">
                        Jasa dokter Rp {{ number_format(\App\Models\Periksa::BIAYA_JASA, 0, ',', '.') }} + total obat
                    </div>
                    <div class="font-bold text-slate-800 text-lg">
                        Total: Rp <span id="totalBiaya">{{ number_format(\App\Models\Periksa::BIAYA_JASA, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex items-center gap-2 px-6 py-2.5 bg-[#2d4499] hover:bg-[#1e2d6b] text-white rounded-lg text-sm font-semibold transition">
                        <i class="fas fa-save"></i>
                        Simpan Pemeriksaan
                    </button>

                    <a href="{{ route('periksa-pasien.index') }}"
                        class="flex items-center gap-2 px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-500 rounded-lg text-sm font-semibold transition">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
    <script>
        flatpickr('.tgl-picker', {
            enableTime: true,
            time_24hr: true,
            dateFormat: 'Y-m-d H:i'
        });

        (function () {
            var jasa = {{ \App\Models\Periksa::BIAYA_JASA }};
            var checks = document.querySelectorAll('.obat-check');
            var out = document.getElementById('totalBiaya');

            function hitung() {
                var total = jasa;
                checks.forEach(function (c) {
                    var jumlah = c.closest('div.flex').querySelector('.obat-jumlah');
                    jumlah.disabled = !c.checked;
                    if (c.checked) total += (parseInt(c.dataset.harga, 10) || 0) * (parseInt(jumlah.value, 10) || 0);
                });
                out.textContent = total.toLocaleString('id-ID');
            }

            checks.forEach(function (c) { c.addEventListener('change', hitung); });
            document.querySelectorAll('.obat-jumlah').forEach(function (j) { j.addEventListener('input', hitung); });
            hitung();
        })();
    </script>
    @endpush

</x-layouts.app>
