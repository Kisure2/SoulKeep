@extends('layouts.app')

@section('title', 'Kelola Berita')

@section('content')
<div class="flex min-h-[calc(100vh-64px)]">
    @include('admin._sidebar')

    <div class="flex-1 p-8">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-outfit font-extrabold text-neutralDark">📰 Kelola Berita</h1>
                <p class="text-sm text-gray-500 mt-1">Tambah, edit, atau hapus artikel berita.</p>
            </div>
            <a href="/admin/news/create"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 transition shadow-md shadow-brand-200/50 text-sm">
                + Tambah Berita
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-brand-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-brand-50 border-b border-brand-100">
                            <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Judul</th>
                            <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Penulis</th>
                            <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Tanggal</th>
                            <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-50">
                        @forelse($news as $item)
                        <tr class="hover:bg-brand-50/30 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($item->image)
                                        <img src="{{ Storage::url($item->image) }}" alt=""
                                            class="w-12 h-10 object-cover rounded-xl border border-brand-100 shrink-0">
                                    @else
                                        <div class="w-12 h-10 bg-brand-50 rounded-xl flex items-center justify-center text-lg shrink-0">📰</div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-neutralDark line-clamp-1">{{ $item->title }}</p>
                                        <p class="text-xs text-gray-400 line-clamp-1">{{ Str::limit(strip_tags($item->content), 60) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">{{ $item->author->name ?? '—' }}</td>
                            <td class="px-6 py-4 text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="/admin/news/{{ $item->id }}/edit"
                                        class="px-3 py-1.5 bg-brand-100 text-brand-700 text-xs font-bold rounded-lg hover:bg-brand-200 transition">
                                        ✏️ Edit
                                    </a>
                                    <form method="POST" action="/admin/news/{{ $item->id }}"
                                        onsubmit="return confirm('Hapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-rose-100 text-rose-700 text-xs font-bold rounded-lg hover:bg-rose-600 hover:text-white transition">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                <span class="text-4xl block mb-3">📭</span>
                                Belum ada berita. <a href="/admin/news/create" class="text-brand-600 font-bold hover:underline">Tambah sekarang</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($news->hasPages())
                <div class="px-6 py-4 border-t border-brand-50">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
