<x-layouts.app title="Detail Riwayat Pasien">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('riwayat-pasien.index') }}"
            class="flex items-center justify-center w-9 h-9 rounded-lg bg-slate-100 text-slate-500 hover:bg-slate-200 transition">
            <i class="fas fa-arrow-left text-xs"></i>
        </a>
        <h2 class="text-xl font-bold text-slate-800">
            Detail Riwayat Pasien
        </h2>
    </div>

    @include('components.partials.detail-periksa', ['periksa' => $periksa])

</x-layouts.app>
