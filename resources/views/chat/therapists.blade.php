@extends('layouts.app')

@section('title', 'Temukan Terapis')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-10">
    <div class="mb-10 text-center">
        <span class="inline-block text-xs font-bold bg-teal-50 text-teal-700 border border-teal-200 px-4 py-1.5 rounded-full mb-4">👨‍⚕️ Terapis Tersedia</span>
        <h1 class="text-3xl font-outfit font-extrabold text-neutralDark mb-3">Pilih Terapis untuk Memulai Chat</h1>
        <p class="text-sm text-gray-500 max-w-md mx-auto">Semua terapis kami telah terverifikasi. Pilih yang paling sesuai dengan kebutuhanmu.</p>
    </div>

    @if($therapists->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($therapists as $therapist)
            <div class="bg-white rounded-3xl border border-brand-100 shadow-sm overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                {{-- Header gradient --}}
                <div class="h-20 bg-gradient-to-br from-brand-600 to-teal-500 relative">
                    <div class="absolute -bottom-7 left-1/2 -translate-x-1/2">
                        <img src="{{ $therapist->avatar_url }}" alt="{{ $therapist->name }}"
                            class="w-14 h-14 rounded-full object-cover border-4 border-white shadow-lg">
                    </div>
                </div>

                <div class="pt-10 pb-6 px-6 text-center space-y-3">
                    <div>
                        <h2 class="font-outfit font-bold text-base text-neutralDark">{{ $therapist->name }}</h2>
                        <span class="text-[11px] font-bold bg-teal-100 text-teal-700 px-2 py-0.5 rounded-full">✅ Terverifikasi</span>
                    </div>

                    @if($therapist->bio)
                        <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">{{ $therapist->bio }}</p>
                    @else
                        <p class="text-xs text-gray-300 italic">Terapis profesional SoulKeep</p>
                    @endif

                    @if($therapist->address)
                        <p class="text-[11px] text-gray-400 flex items-center justify-center gap-1">
                            📍 {{ $therapist->address }}
                        </p>
                    @endif

                    <form method="POST" action="/chat/start/{{ $therapist->id }}">
                        @csrf
                        <button type="submit"
                            class="w-full py-2.5 bg-brand-600 text-white text-sm font-bold rounded-xl hover:bg-brand-700 transition shadow-md shadow-brand-200/50 group-hover:shadow-lg mt-2">
                            💬 Mulai Chat
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20 bg-white rounded-3xl border border-brand-100 shadow-sm">
            <span class="text-6xl block mb-4">👨‍⚕️</span>
            <h2 class="text-xl font-outfit font-bold text-neutralDark mb-2">Belum Ada Terapis Aktif</h2>
            <p class="text-sm text-gray-400">Terapis sedang dalam proses verifikasi. Coba lagi beberapa saat.</p>
        </div>
    @endif
</div>
@endsection
