<x-layouts.app title="Notifikasi">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Notifikasi
        </h2>

        @if($notifikasis->whereNull('read_at')->isNotEmpty())
        <form action="{{ route(auth()->user()->role . '.notifikasi.baca-semua') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-semibold transition">
                <i class="fas fa-check-double"></i>
                Tandai Semua Dibaca
            </button>
        </form>
        @endif
    </div>

    {{-- Daftar --}}
    @forelse($notifikasis as $notifikasi)
    <div class="card shadow-md rounded-2xl border mb-3
        {{ $notifikasi->read_at ? 'bg-base-100 border-slate-200' : 'bg-indigo-50 border-indigo-300' }}">
        <div class="card-body p-5 flex-row items-center justify-between gap-4">

            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="{{ $notifikasi->read_at ? 'font-semibold text-slate-600' : 'font-bold text-slate-800' }}">
                        {{ $notifikasi->data['judul'] }}
                    </span>
                    @unless($notifikasi->read_at)
                    <span class="badge badge-primary badge-sm">Baru</span>
                    @endunless
                </div>
                <div class="text-sm text-slate-600">{{ $notifikasi->data['pesan'] }}</div>
                <div class="text-xs text-slate-400 mt-1">{{ $notifikasi->created_at->diffForHumans() }}</div>
            </div>

            <div class="flex gap-2 shrink-0">
                <a href="{{ $notifikasi->data['url'] }}"
                    class="btn btn-sm bg-[#2d4499] hover:bg-[#1e2d6b] text-white border-none rounded-lg px-4">
                    <i class="fas fa-eye"></i>
                    Lihat
                </a>

                @unless($notifikasi->read_at)
                <form action="{{ route(auth()->user()->role . '.notifikasi.baca', $notifikasi->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm bg-slate-100 hover:bg-slate-200 text-slate-600 border-none rounded-lg px-4">
                        <i class="fas fa-check"></i>
                        Tandai Dibaca
                    </button>
                </form>
                @endunless
            </div>

        </div>
    </div>
    @empty
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-7 text-center text-slate-400 py-14">
            <i class="fas fa-bell-slash text-3xl mb-3 block"></i>
            Belum ada notifikasi
        </div>
    </div>
    @endforelse

</x-layouts.app>
