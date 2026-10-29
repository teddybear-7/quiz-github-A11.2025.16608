<x-layouts.app title="Profile">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-slate-800">
            Profile
        </h2>
    </div>

    {{-- Info akun --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200 mb-6">
        <div class="card-body p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Nama</div>
                    <div class="font-semibold text-slate-800">{{ auth()->user()->nama }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Email</div>
                    <div class="font-semibold text-slate-800">{{ auth()->user()->email }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wider text-slate-400">Role</div>
                    <div class="font-semibold text-slate-800 capitalize">{{ auth()->user()->role }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Username --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200 mb-6">
        <div class="card-body p-7">

            <h3 class="font-bold text-slate-800 mb-5">Ganti Username</h3>

            <form action="{{ route(auth()->user()->role . '.profile.username') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Username --}}
                <div class="form-control mb-6">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Username <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <input type="text" name="nama" value="{{ old('nama', auth()->user()->nama) }}" maxlength="255"
                        class="input input-bordered w-full rounded-lg text-sm @error('nama') input-error @enderror"
                        required>

                    @error('nama')
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex items-center gap-2 px-6 py-2.5 bg-[#2d4499] hover:bg-[#1e2d6b] text-white rounded-lg text-sm font-semibold transition">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- Card Password --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-7">

            <h3 class="font-bold text-slate-800 mb-5">Ganti Password</h3>

            <form action="{{ route(auth()->user()->role . '.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Password Lama --}}
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Password Lama <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <input type="password" name="password_lama"
                        class="input input-bordered w-full rounded-lg text-sm @error('password_lama') input-error @enderror"
                        required>

                    @error('password_lama')
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                </div>

                {{-- Password Baru --}}
                <div class="form-control mb-5">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Password Baru <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <input type="password" name="password" placeholder="Minimal 8 karakter"
                        class="input input-bordered w-full rounded-lg text-sm @error('password') input-error @enderror"
                        required>

                    @error('password')
                    <label class="label pt-1">
                        <span class="label-text-alt text-red-500">{{ $message }}</span>
                    </label>
                    @enderror
                </div>

                {{-- Konfirmasi Password Baru --}}
                <div class="form-control mb-6">
                    <label class="label pb-1">
                        <span class="text-sm font-semibold text-gray-700">
                            Konfirmasi Password Baru <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <input type="password" name="password_confirmation"
                        class="input input-bordered w-full rounded-lg text-sm" required>
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex items-center gap-2 px-6 py-2.5 bg-[#2d4499] hover:bg-[#1e2d6b] text-white rounded-lg text-sm font-semibold transition">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

</x-layouts.app>
