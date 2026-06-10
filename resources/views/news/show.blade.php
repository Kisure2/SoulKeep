@extends('layouts.app')

@section('title', $news->title)
@section('meta_description', Str::limit(strip_tags($news->content), 160))

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-10">
    {{-- Back --}}
    <a href="/news" class="inline-flex items-center gap-2 text-sm font-semibold text-brand-600 hover:text-brand-700 transition mb-6">
        ← Kembali ke Berita
    </a>

    <article class="bg-white rounded-3xl border border-brand-100 shadow-sm overflow-hidden">
        {{-- Hero Image --}}
        @if($news->image)
            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}"
                class="w-full h-64 object-cover">
        @else
            <div class="w-full h-40 flex items-center justify-center bg-gradient-to-br from-brand-100 to-brand-200">
                <span class="text-6xl opacity-60">📰</span>
            </div>
        @endif

        <div class="p-8 md:p-10 space-y-6">
            {{-- Meta --}}
            <div class="flex flex-wrap items-center gap-3 text-xs text-gray-400">
                <span class="flex items-center gap-1">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($news->author->name ?? 'A') }}&background=396696&color=fff&size=32"
                         alt="Author" class="w-5 h-5 rounded-full">
                    {{ $news->author->name ?? 'Admin' }}
                </span>
                <span>·</span>
                <span>{{ $news->created_at->isoFormat('D MMMM Y') }}</span>
                <span>·</span>
                <span>{{ ceil(str_word_count(strip_tags($news->content)) / 200) }} menit baca</span>
            </div>

            {{-- Title --}}
            <h1 class="text-3xl font-outfit font-extrabold text-neutralDark leading-tight">{{ $news->title }}</h1>

            {{-- Divider --}}
            <div class="h-px bg-brand-100"></div>

            {{-- Content --}}
            <div class="prose prose-sm max-w-none text-neutralDark/80 leading-relaxed space-y-4">
                {!! nl2br(e($news->content)) !!}
            </div>
        </div>
    </article>

    {{-- Back button --}}
    <div class="mt-8 text-center">
        <a href="/news" class="inline-flex items-center gap-2 px-6 py-3 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 transition shadow-md">
            ← Lihat Berita Lainnya
        </a>
    </div>
</div>
@endsection
