@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="flex min-h-[calc(100vh-64px)]">
    {{-- Sidebar --}}
    @include('admin._sidebar')

    {{-- Main Content --}}
    <div class="flex-1 p-8">
        <div class="mb-8">
            <h1 class="text-2xl font-outfit font-extrabold text-neutralDark">⚙️ Admin Dashboard</h1>
            <p class="text-sm text-gray-500 mt-1">Selamat datang, {{ session('user.name') }}. Kelola platform SoulKeep dari sini.</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
            <div class="bg-white rounded-3xl border border-brand-100 p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-brand-100 rounded-2xl flex items-center justify-center text-2xl shrink-0">🧑‍💻</div>
                    <div>
                        <p class="text-3xl font-outfit font-black text-brand-700">{{ $userCount }}</p>
                        <p class="text-xs text-gray-400 font-semibold mt-0.5">Total Pengguna</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-brand-100 p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-teal-100 rounded-2xl flex items-center justify-center text-2xl shrink-0">👨‍⚕️</div>
                    <div>
                        <p class="text-3xl font-outfit font-black text-teal-700">{{ $therapistCount }}</p>
                        <p class="text-xs text-gray-400 font-semibold mt-0.5">Total Terapis</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-amber-100 p-6 shadow-sm relative">
                @if($pendingCount > 0)
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-amber-500 text-white text-xs font-black rounded-full flex items-center justify-center">{{ $pendingCount }}</div>
                @endif
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center text-2xl shrink-0">⏳</div>
                    <div>
                        <p class="text-3xl font-outfit font-black text-amber-700">{{ $pendingCount }}</p>
                        <p class="text-xs text-gray-400 font-semibold mt-0.5">Terapis Pending</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-brand-100 p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-rose-100 rounded-2xl flex items-center justify-center text-2xl shrink-0">📰</div>
                    <div>
                        <p class="text-3xl font-outfit font-black text-rose-700">{{ $newsCount }}</p>
                        <p class="text-xs text-gray-400 font-semibold mt-0.5">Total Berita</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-3xl border border-brand-100 p-7 shadow-sm">
            <h2 class="font-outfit font-bold text-lg text-neutralDark mb-5">Aksi Cepat</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="/admin/therapists" class="flex items-center gap-3 p-4 bg-teal-50 border border-teal-100 rounded-2xl hover:bg-teal-100 transition group">
                    <span class="text-2xl">👨‍⚕️</span>
                    <div>
                        <p class="text-sm font-bold text-neutralDark">Kelola Terapis</p>
                        <p class="text-xs text-gray-400">{{ $pendingCount }} menunggu verifikasi</p>
                    </div>
                    <span class="ml-auto text-teal-400 group-hover:translate-x-1 transition">→</span>
                </a>
                <a href="/admin/users" class="flex items-center gap-3 p-4 bg-brand-50 border border-brand-100 rounded-2xl hover:bg-brand-100 transition group">
                    <span class="text-2xl">🧑‍💻</span>
                    <div>
                        <p class="text-sm font-bold text-neutralDark">Kelola Pengguna</p>
                        <p class="text-xs text-gray-400">{{ $userCount }} pengguna aktif</p>
                    </div>
                    <span class="ml-auto text-brand-400 group-hover:translate-x-1 transition">→</span>
                </a>
                <a href="/admin/news/create" class="flex items-center gap-3 p-4 bg-rose-50 border border-rose-100 rounded-2xl hover:bg-rose-100 transition group">
                    <span class="text-2xl">✍️</span>
                    <div>
                        <p class="text-sm font-bold text-neutralDark">Tulis Berita</p>
                        <p class="text-xs text-gray-400">Tambah artikel baru</p>
                    </div>
                    <span class="ml-auto text-rose-400 group-hover:translate-x-1 transition">→</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
