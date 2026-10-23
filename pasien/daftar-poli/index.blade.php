<x-layouts.app title="Daftar Poli">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Daftar Poli
        </h2>

        <a href="{{ route('riwayat-pendaftaran.index') }}"
            class="flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-semibold transition">
            <i class="fas fa-clock-rotate-left"></i>
            Riwayat Pendaftaran
        </a>
    </div>

    {{-- Info pasien --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200 mb-6">
        <div class="card-body p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Nama Pasien</div>
                    <div class="font-semibold text-slate-800">{{ auth()->user()->nama }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">No. Rekam Medis</div>
                    <div class="font-semibold text-slate-800">{{ auth()->user()->no_rm ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    @if($aktif)
    <div class="card bg-base-100 shadow-md rounded-2xl border border-amber-300">
        <div class="card-body p-7">
            <div class="flex items-center gap-2 mb-4">
                <i class="fas fa-ticket text-amber-500"></i>
                <h3 class="font-bold text-slate-800">Anda sudah terdaftar</h3>
                <span class="badge badge-warning">Belum diperiksa</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 text-sm">
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
                    <div class="text-xs uppercase tracking-wider text-slate-400">No. Antrian</div>
                    <div class="text-3xl font-extrabold text-[#2d4499]">{{ $aktif->no_antrian }}</div>
                </div>
            </div>

            <p class="text-sm text-slate-500 mt-5">
                Anda baru bisa mendaftar lagi setelah pemeriksaan ini selesai.
            </p>
        </div>
    </div>

    @elseif($jadwals->isEmpty())
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-7 text-center text-slate-400 py-14">
            <i class="fas fa-calendar-xmark text-3xl mb-3 block"></i>
            Belum ada jadwal dokter yang aktif. Silakan coba lagi nanti.
        </div>
    </div>

    @else
    {{-- Form pendaftaran --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-7">

            <form action="{{ route('daftar-poli.store') }}" method="POST">
                @csrf

                {{-- Jadwal --}}
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Poli dan Jadwal Dokter <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <select name="id_jadwal"
                        class="select select-bordered w-full rounded-lg text-sm @error('id_jadwal') select-error @enderror"
                        required>
                        <option value="" disabled {{ old('id_jadwal') ? '' : 'selected' }}>Pilih poli dan jadwal dokter</option>
                        @foreach($jadwals as $namaPoli => $items)
                        <optgroup label="{{ $namaPoli }}">
                            @foreach($items as $jadwal)
                            <option value="{{ $jadwal->id }}" {{ (string) old('id_jadwal') === (string) $jadwal->id ? 'selected' : '' }}>
                                {{ $jadwal->dokter->nama }} - {{ $jadwal->hari }},
                                {{ substr($jadwal->jam_mulai, 0, 5) }}-{{ substr($jadwal->jam_selesai, 0, 5) }}
                            </option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>

                    @error('id_jadwal')
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                </div>

                {{-- Keluhan --}}
                <div class="form-control mb-6">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Keluhan <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <textarea name="keluhan" rows="4" maxlength="1000" placeholder="Tuliskan keluhan Anda..."
                        class="textarea textarea-bordered w-full rounded-lg text-sm resize-none @error('keluhan') textarea-error @enderror"
                        required>{{ old('keluhan') }}</textarea>

                    @error('keluhan')
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                </div>

                <button type="submit"
                    class="flex items-center gap-2 px-6 py-2.5 bg-[#2d4499] hover:bg-[#1e2d6b] text-white rounded-lg text-sm font-semibold transition">
                    <i class="fas fa-paper-plane"></i>
                    Daftar
                </button>

            </form>
        </div>
    </div>
    @endif

</x-layouts.app>
