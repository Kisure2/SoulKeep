@extends('layouts.app')

@section('title', 'Profil Saya')
@section('meta_description', 'Kelola profil dan informasi akun SoulKeep kamu.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-10">
    <div class="mb-8">
        <h1 class="text-2xl font-outfit font-extrabold text-neutralDark">👤 Profil Saya</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola informasi dan keamanan akun kamu.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Sidebar: Avatar --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl border border-brand-100 p-6 shadow-sm text-center space-y-4">
                {{-- Avatar --}}
                <div class="relative inline-block">
                    <img id="avatar-preview"
                         src="{{ $user->avatar_url }}"
                         alt="{{ $user->name }}"
                         class="w-28 h-28 rounded-full object-cover border-4 border-brand-200 shadow-lg mx-auto">
                    <label for="avatar-input" class="absolute bottom-0 right-0 w-9 h-9 bg-brand-600 text-white rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:bg-brand-700 transition text-sm">
                        📷
                    </label>
                </div>
                <div>
                    <p class="font-outfit font-bold text-lg text-neutralDark">{{ $user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                    <span class="mt-2 inline-block text-[11px] font-bold px-3 py-1 rounded-full
                        @if($user->role === 'admin') bg-purple-100 text-purple-700
                        @elseif($user->role === 'therapist') bg-teal-100 text-teal-700
                        @else bg-brand-100 text-brand-700 @endif">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
                <div class="text-xs text-gray-400 pt-2 border-t border-brand-50">
                    <p>Bergabung {{ $user->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>

        {{-- Main: Forms --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Profile Info Form --}}
            <div class="bg-white rounded-3xl border border-brand-100 p-7 shadow-sm">
                <h2 class="font-outfit font-bold text-lg text-neutralDark mb-6">Informasi Profil</h2>

                <form method="POST" action="/profile" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <input type="file" id="avatar-input" name="avatar" accept="image/jpeg,image/png,image/webp" class="hidden" onchange="previewAvatar(this)">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Nama Lengkap *</label>
                            <input type="text" name="name" required value="{{ old('name', $user->name) }}"
                                class="w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Email *</label>
                            <input type="email" name="email" required value="{{ old('email', $user->email) }}"
                                class="w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Alamat</label>
                        <input type="text" name="address" value="{{ old('address', $user->address) }}"
                            placeholder="Kota, Provinsi"
                            class="w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition">
                    </div>

                    @if($user->role === 'therapist')
                    <div>
                        <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Bio / Tentang Saya</label>
                        <textarea name="bio" rows="3" placeholder="Ceritakan pengalaman dan keahlianmu..."
                            class="w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition resize-none">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                    @endif

                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 transition shadow-md shadow-brand-200/50">
                        💾 Simpan Perubahan
                    </button>
                </form>
            </div>

            {{-- Change Password Form --}}
            <div class="bg-white rounded-3xl border border-brand-100 p-7 shadow-sm">
                <h2 class="font-outfit font-bold text-lg text-neutralDark mb-6">🔐 Ubah Kata Sandi</h2>

                <form method="POST" action="/profile/password" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Password Saat Ini</label>
                        <input type="password" name="current_password" required
                            class="w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition"
                            placeholder="••••••••">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Password Baru</label>
                            <input type="password" name="password" required
                                class="w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition"
                                placeholder="Min. 6 karakter">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition"
                                placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-neutralDark text-white font-bold rounded-xl hover:bg-gray-800 transition shadow-md">
                        🔑 Ubah Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('avatar-preview').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
