@extends('layouts.app')

@section('title', $news ? 'Edit Berita' : 'Tambah Berita')

@section('content')
<div class="flex min-h-[calc(100vh-64px)]">
    @include('admin._sidebar')

    <div class="flex-1 p-8">
        <div class="mb-8">
            <a href="/admin/news" class="inline-flex items-center gap-1 text-sm text-brand-600 hover:text-brand-700 font-semibold mb-4">
                ← Kembali ke Daftar Berita
            </a>
            <h1 class="text-2xl font-outfit font-extrabold text-neutralDark">
                {{ $news ? '✏️ Edit Berita' : '✍️ Tambah Berita Baru' }}
            </h1>
        </div>

        <div class="max-w-3xl">
            <div class="bg-white rounded-3xl border border-brand-100 p-8 shadow-sm">
                <form method="POST"
                    action="{{ $news ? '/admin/news/' . $news->id : '/admin/news' }}"
                    enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @if($news)
                        @method('PUT')
                    @endif

                    {{-- Title --}}
                    <div>
                        <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Judul Artikel *</label>
                        <input type="text" name="title" required
                            value="{{ old('title', $news->title ?? '') }}"
                            placeholder="Masukkan judul artikel yang menarik..."
                            class="w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition">
                    </div>

                    {{-- Image Upload --}}
                    <div>
                        <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Gambar Artikel</label>
                        <div class="border-2 border-dashed border-brand-200 rounded-2xl p-6 text-center hover:border-brand-400 transition cursor-pointer" onclick="document.getElementById('img-input').click()">
                            <div id="img-preview-wrap">
                                @if($news && $news->image)
                                    <img id="img-preview" src="{{ Storage::url($news->image) }}" alt=""
                                        class="max-h-48 mx-auto rounded-xl object-cover mb-3">
                                    <p class="text-xs text-gray-400">Klik untuk mengganti gambar</p>
                                @else
                                    <span class="text-4xl block mb-2">🖼️</span>
                                    <p class="text-sm text-gray-400">Klik untuk upload gambar</p>
                                    <p class="text-xs text-gray-300 mt-1">JPG, PNG, WEBP · Maks. 2MB</p>
                                    <img id="img-preview" class="hidden max-h-48 mx-auto rounded-xl object-cover mt-3">
                                @endif
                            </div>
                            <input type="file" id="img-input" name="image" accept="image/jpeg,image/png,image/webp" class="hidden" onchange="previewImg(this)">
                        </div>
                    </div>

                    {{-- Content --}}
                    <div>
                        <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Isi Artikel *</label>
                        <textarea name="content" required rows="12"
                            placeholder="Tulis isi artikel di sini..."
                            class="w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition resize-none">{{ old('content', $news->content ?? '') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Gunakan baris baru untuk paragraf baru.</p>
                    </div>

                    {{-- Submit --}}
                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-8 py-3 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 transition shadow-md shadow-brand-200/50">
                            {{ $news ? '💾 Simpan Perubahan' : '🚀 Publikasikan Berita' }}
                        </button>
                        <a href="/admin/news" class="text-sm text-gray-400 hover:text-gray-600 font-semibold">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImg(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const preview = document.getElementById('img-preview');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
