@extends('layouts.app')

@section('title', 'Berita & Artikel')
@section('meta_description', 'Berita dan artikel terbaru seputar kesehatan mental dari SoulKeep.')

@section('extra_styles')
.news-card { transition: all 0.3s cubic-bezier(.22,1,.36,1); }
.news-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -8px rgba(57,102,150,0.18); }
.admin-form-panel { background: #F4F7FB; border: 1.5px solid #E4EDF7; border-radius: 1.25rem; padding: 1.5rem; margin-bottom: 1.75rem; }
.input-field { width:100%; border:1.5px solid #E4EDF7; border-radius:0.75rem; padding:0.7rem 1rem; font-size:0.875rem; background:#fff; outline:none; transition:border-color 0.2s,box-shadow 0.2s; font-family:inherit; }
.input-field:focus { border-color:#396696; box-shadow:0 0 0 3px rgba(57,102,150,0.1); }
.btn-save   { background:#396696; color:#fff; font-weight:700; border-radius:0.75rem; padding:0.6rem 1.25rem; font-size:0.875rem; border:none; cursor:pointer; transition:all .2s; }
.btn-save:hover   { background:#2E5178; transform:translateY(-1px); box-shadow:0 4px 16px rgba(57,102,150,0.3); }
.btn-cancel { background:transparent; color:#396696; font-weight:700; border-radius:0.75rem; padding:0.6rem 1.25rem; font-size:0.875rem; border:1.5px solid #E4EDF7; cursor:pointer; transition:all .2s; }
.btn-cancel:hover { background:#E4EDF7; }
.img-placeholder { background: linear-gradient(135deg, #E4EDF7 0%, #C7DCEF 100%); }
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10">

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between flex-wrap gap-4">
        <div>
            <span class="inline-flex items-center gap-1.5 text-xs font-bold bg-[#E4EDF7] text-[#396696] px-3 py-1.5 rounded-full mb-2">
                📰 Berita &amp; Artikel
            </span>
            <h1 class="text-3xl font-outfit font-extrabold text-neutralDark">Berita Kesehatan Mental</h1>
            <p class="text-sm text-gray-500 mt-1">Informasi terbaru seputar kesehatan mental untuk mahasiswa Indonesia.</p>
        </div>

        @if(session('role') === 'admin')
        <button id="toggle-form-btn" onclick="toggleForm()"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#396696] text-white font-bold rounded-xl hover:bg-[#2E5178] transition shadow-md shadow-brand-200/40 text-sm">
            <span id="toggle-icon">✏️</span>
            <span id="toggle-text">Tambah Berita</span>
        </button>
        @endif
    </div>

    {{-- Admin Form Panel --}}
    @if(session('role') === 'admin')
    <div id="admin-form-panel" class="admin-form-panel hidden">
        <h3 class="font-outfit font-bold text-lg text-neutralDark mb-5" id="form-heading">✏️ Tambah Berita Baru</h3>

        <form method="POST" action="/admin/news" id="news-form" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">

            <div>
                <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-1.5">Judul Berita *</label>
                <input type="text" name="title" id="f-title" required placeholder="Masukkan judul berita..." class="input-field">
            </div>

            <div>
                <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-1.5">Isi Artikel *</label>
                <textarea name="content" id="f-content" rows="7" required placeholder="Tulis isi artikel di sini..." class="input-field" style="resize:vertical;"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-1.5">Gambar Cover (opsional)</label>
                <input type="file" name="image" id="f-image" accept="image/jpg,image/jpeg,image/png,image/webp"
                    class="block w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#E4EDF7] file:text-[#396696] hover:file:bg-[#c7dcef] cursor-pointer">
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="btn-save">💾 Simpan Berita</button>
                <button type="button" onclick="cancelForm()" class="btn-cancel">Batal</button>
            </div>
        </form>
    </div>
    @endif

    {{-- Flash Message --}}
    @if(session('success'))
    <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-3 rounded-2xl text-sm font-semibold shadow-sm">
        ✅ {{ session('success') }}
        <button onclick="this.parentElement.remove()" class="ml-auto text-emerald-500 hover:text-emerald-700 font-bold">✕</button>
    </div>
    @endif

    {{-- News Grid --}}
    @if($news->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @foreach($news as $item)
        <article class="news-card bg-white rounded-3xl border border-brand-100 shadow-sm overflow-hidden">
            {{-- Thumbnail --}}
            <div class="h-48 overflow-hidden relative">
                @if($item->image)
                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}"
                        class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full img-placeholder flex items-center justify-center">
                        <span class="text-5xl opacity-30">📰</span>
                    </div>
                @endif

                @if(session('role') === 'admin')
                <div class="absolute top-3 right-3 flex gap-1.5">
                    <button onclick="editNews({{ $item->id }}, {{ json_encode($item->title) }}, {{ json_encode($item->content) }})"
                        class="text-xs font-bold bg-white/90 text-[#396696] px-3 py-1.5 rounded-lg shadow hover:bg-white transition">
                        ✏️
                    </button>
                    <form method="POST" action="/admin/news/{{ $item->id }}" style="display:inline"
                          onsubmit="return confirm('Hapus berita « {{ addslashes($item->title) }} »?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="text-xs font-bold bg-rose-500/90 text-white px-3 py-1.5 rounded-lg shadow hover:bg-rose-600 transition">
                            🗑️
                        </button>
                    </form>
                </div>
                @endif
            </div>

            {{-- Content --}}
            <div class="p-6 space-y-3">
                <div class="flex items-center gap-2 text-xs text-gray-400">
                    <span>👤 {{ $item->author->name ?? 'Admin' }}</span>
                    <span>·</span>
                    <span>{{ $item->created_at->format('d M Y') }}</span>
                </div>
                <h2 class="font-outfit font-bold text-base text-neutralDark leading-snug line-clamp-2 group-hover:text-brand-700">
                    {{ $item->title }}
                </h2>
                <p class="text-xs text-gray-500 leading-relaxed line-clamp-3">
                    {{ Str::limit(strip_tags($item->content), 130) }}
                </p>
                <a href="/news/{{ $item->id }}"
                    class="inline-flex items-center gap-1 text-xs font-bold text-brand-600 hover:text-brand-700 transition mt-1">
                    Baca Selengkapnya →
                </a>
            </div>
        </article>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center">{{ $news->links() }}</div>

    @else
    <div class="text-center py-20 bg-white rounded-3xl border border-brand-100 shadow-sm">
        <span class="text-6xl block mb-4">📭</span>
        <h2 class="text-xl font-outfit font-bold text-neutralDark mb-2">Belum Ada Berita</h2>
        <p class="text-sm text-gray-400">Artikel akan segera tersedia.</p>
        @if(session('role') === 'admin')
        <button onclick="toggleForm()" class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 bg-[#396696] text-white font-bold rounded-xl hover:bg-[#2E5178] transition text-sm">
            ✏️ Tambah Berita Pertama
        </button>
        @endif
    </div>
    @endif

</div>
@endsection

@section('scripts')
<script>
    function toggleForm() {
        const panel = document.getElementById('admin-form-panel');
        const icon  = document.getElementById('toggle-icon');
        const text  = document.getElementById('toggle-text');
        if (panel.classList.toggle('hidden')) {
            icon.textContent = '✏️';
            text.textContent = 'Tambah Berita';
        } else {
            icon.textContent = '✕';
            text.textContent = 'Tutup Form';
            panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
            // Reset to "create" mode
            document.getElementById('form-heading').textContent = '✏️ Tambah Berita Baru';
            document.getElementById('news-form').action = '/admin/news';
            document.getElementById('form-method').value = 'POST';
            document.getElementById('f-title').value = '';
            document.getElementById('f-content').value = '';
        }
    }

    function editNews(id, title, content) {
        const panel = document.getElementById('admin-form-panel');
        panel.classList.remove('hidden');
        document.getElementById('toggle-icon').textContent = '✕';
        document.getElementById('toggle-text').textContent = 'Tutup Form';
        document.getElementById('form-heading').textContent = '✏️ Edit Berita';
        document.getElementById('news-form').action = `/admin/news/${id}`;
        document.getElementById('form-method').value = 'PUT';
        document.getElementById('f-title').value = title;
        document.getElementById('f-content').value = content;
        panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function cancelForm() {
        document.getElementById('admin-form-panel').classList.add('hidden');
        document.getElementById('toggle-icon').textContent = '✏️';
        document.getElementById('toggle-text').textContent = 'Tambah Berita';
        document.getElementById('news-form').reset();
    }
</script>
@endsection
