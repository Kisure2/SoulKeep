<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SoulKeep — Temukan psikolog, klinik jiwa, dan layanan kesehatan mental terdekat dari lokasimu.">
    <title>Psikolog Terdekat — SoulKeep</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💙</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { outfit: ['Outfit', 'sans-serif'], jakarta: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        brand: { 50:'#F4F7FB',100:'#E4EDF7',200:'#C7DCEF',300:'#9CBEDF',400:'#6E9DCC',500:'#4B81B7',600:'#396696',700:'#2E5178',850:'#203853',900:'#17293D' },
                        neutralDark: '#1E2229'
                    }
                }
            }
        }
    </script>
    <style>
        /* === SOULKEEP BASE === */
        *,*::before,*::after { box-sizing:border-box; }
        body { font-family:'Plus Jakarta Sans',sans-serif; background:#F4F7FB; color:#1E2229; -webkit-font-smoothing:antialiased; }
        img,video,iframe { max-width:100%; }
        h1,h2,h3 { font-family:'Outfit',sans-serif; color:#1E2229; }
        @keyframes fadeUp { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }
        main { animation:fadeUp 0.45s cubic-bezier(.22,1,.36,1) both; }
        .nav-item { color:#64748b; border-radius:8px; transition:all .18s; }
        .nav-item:hover { background:#E4EDF7; color:#2E5178; }
        .nav-item.active { background:#E4EDF7; color:#2E5178; font-weight:700; }
        nav.scrolled { box-shadow:0 4px 24px -6px rgba(57,102,150,0.18); }
        .mob-nav-item { display:flex; flex-direction:column; align-items:center; justify-content:center; flex:1; padding:6px 2px; color:#94a3b8; transition:all .2s; text-decoration:none; }
        .mob-nav-item:hover { color:#396696; }
        .mob-nav-item.active { color:#396696; }
        .card  { background:#fff; border-radius:16px; border:1px solid #E4EDF7; padding:1.25rem; }
        .card-md { background:#fff; border-radius:20px; border:1px solid #E4EDF7; padding:1.5rem; }
        /* Leaflet specific */
        .leaflet-popup-content-wrapper { font-family:'Plus Jakarta Sans',sans-serif; border-radius:12px; box-shadow:0 8px 24px -4px rgba(57,102,150,.2); }
        .leaflet-popup-content { font-size:13px; }
        .leaflet-pane,
        .leaflet-control,
        .leaflet-top,
        .leaflet-bottom { z-index:10 !important; }
        .place-card { transition:all .2s ease; }
        .place-card:hover { border-color:#396696; box-shadow:0 4px 12px rgba(57,102,150,.12); }
        .place-card.selected { border-color:#396696; background:#F4F7FB; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.4} }
        .loading-dot { animation:pulse 1.4s ease-in-out infinite; }
        .loading-dot:nth-child(2) { animation-delay:.2s; }
        .loading-dot:nth-child(3) { animation-delay:.4s; }
        #map { width:100%; height:50vh; min-height:300px; }
        @media(min-width:1024px) { #map { height:70vh; } }
        /* === VISUAL UPGRADE === */
        .img-overlay { position: absolute; inset: 0; background: linear-gradient(180deg, transparent 0%, rgba(30,34,41,0.65) 100%); }
        .shape-circle { border-radius: 50%; position: absolute; opacity: 0.5; filter: blur(40px); pointer-events: none; }
        .shape-blob { position: absolute; filter: blur(60px); pointer-events: none; }
    </style>
</head>
<body class="min-h-screen flex flex-col" style="background:#F4F7FB;color:#1E2229">

    <script>if (!localStorage.getItem('soulkeep_token')) window.location.href = '/login';</script>

    <!-- Navbar -->
    <nav id="main-nav" class="sticky top-0 z-40 backdrop-blur-md bg-white/95 border-b border-[#E4EDF7] transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center h-16">
            <a href="/dashboard" class="flex items-center gap-2 text-lg font-outfit font-extrabold text-[#396696] tracking-tight mr-8 shrink-0">
                💙 SoulKeep
                <span class="text-[9px] bg-[#E4EDF7] text-[#396696] px-2 py-0.5 rounded-md font-bold">SDG 3</span>
            </a>
            <div class="hidden md:flex items-center gap-1 flex-1 justify-center">
                <a href="/dashboard"  class="nav-item px-3 py-2 rounded-lg text-sm font-semibold transition-all">🏠 Dashboard</a>
                <a href="/assessment" class="nav-item px-3 py-2 rounded-lg text-sm font-semibold transition-all">📝 Tes Stres</a>
                <a href="/relaxation" class="nav-item px-3 py-2 rounded-lg text-sm font-semibold transition-all">🌬️ Relaksasi</a>
                <a href="/games"      class="nav-item px-3 py-2 rounded-lg text-sm font-semibold transition-all">🎮 Terapi Game</a>
                <a href="/nearby"     class="nav-item active px-3 py-2 rounded-lg text-sm font-semibold transition-all">📍 Psikolog</a>
                <a href="/education"  class="nav-item px-3 py-2 rounded-lg text-sm font-semibold transition-all">📚 Library</a>
            </div>
            <div class="flex items-center gap-3 ml-auto">
                <div class="hidden sm:flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-[#E4EDF7] flex items-center justify-center font-bold text-xs text-[#396696]" id="user-avatar">U</div>
                    <span class="text-sm font-semibold text-[#1E2229]" id="user-name">Pengguna</span>
                </div>
                <button onclick="logout()" class="text-xs font-bold px-3 py-1.5 rounded-lg bg-[#E4EDF7] text-[#396696] hover:bg-[#396696] hover:text-white transition-all">Keluar</button>
            </div>
        </div>
    </nav>

    <!-- Main -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 sm:py-8 space-y-6 pb-20 md:pb-8">

        <!-- Hero Section -->
        <div class="relative overflow-hidden rounded-2xl mb-8 h-[240px] sm:h-[280px]">
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=1200&q=70" alt="hero nearby" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute -top-20 -right-20 w-64 h-64 shape-blob bg-white/5 shape-circle hidden sm:block"></div>
            <div class="img-overlay"></div>
            <div class="relative z-10 h-full flex flex-col justify-between p-6 sm:p-8">
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center gap-2 text-xs font-bold bg-white/15 text-white px-4 py-1.5 rounded-full border border-white/30 backdrop-blur-sm">📍 Layanan Terdekat · Lokasi Tidak Disimpan</span>
                    <span id="location-status" class="hidden text-xs font-bold text-white bg-green-500/30 border border-green-400/40 px-3 py-1.5 rounded-xl flex items-center gap-1.5">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse inline-block"></span> Lokasi aktif
                    </span>
                </div>
                <div class="space-y-2">
                    <h1 class="text-3xl sm:text-4xl font-outfit font-black text-white leading-tight">Temukan Psikolog</h1>
                    <p class="text-white/80 text-sm sm:text-base max-w-md leading-relaxed">Cari psikolog dan klinik kesehatan mental terdekat dari lokasimu.</p>
                </div>
            </div>
        </div>

        <!-- Location Prompt -->
        <div id="location-prompt" class="bg-gradient-to-br from-brand-50 to-white border border-brand-200 rounded-3xl p-10 text-center space-y-5">
            <div class="text-6xl">📡</div>
            <div>
                <h2 class="font-outfit font-bold text-2xl text-neutralDark">Izinkan Akses Lokasi</h2>
                <p class="text-sm text-neutralDark/60 mt-2 max-w-md mx-auto">SoulKeep menggunakan lokasimu <strong>hanya di browser</strong> untuk mencari layanan kesehatan mental terdekat. Data tidak dikirim ke server.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <button onclick="getLocation()" class="px-8 py-3.5 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 transition shadow-md shadow-brand-200 text-sm">
                    📍 Gunakan Lokasiku Sekarang
                </button>
                <button onclick="useManualSearch()" class="px-8 py-3.5 bg-white border border-brand-200 text-brand-700 font-bold rounded-xl hover:bg-brand-50 transition text-sm">
                    🔍 Cari Manual
                </button>
            </div>
            <p class="text-xs text-gray-400">🔒 Privasi terjamin · Tidak ada akun Google diperlukan · Powered by OpenStreetMap</p>
        </div>

        <!-- Manual search panel -->
        <div id="manual-panel" class="hidden bg-white border border-brand-100 rounded-2xl p-5 space-y-3">
            <p class="text-sm font-bold text-neutralDark">🔍 Cari berdasarkan kota / area:</p>
            <div class="flex gap-3">
                <input id="manual-city" type="text" placeholder="Contoh: Bandung, Surabaya, Jakarta Selatan..."
                    class="flex-1 border border-brand-100 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-brand-400 transition">
                <button onclick="searchManual()" class="px-5 py-2.5 bg-brand-600 text-white font-bold rounded-xl text-sm hover:bg-brand-700 transition">Cari</button>
            </div>
        </div>

        <!-- Loading state -->
        <div id="loading-state" class="hidden text-center py-12">
            <div class="flex justify-center gap-2 mb-3">
                <div class="w-3 h-3 bg-brand-400 rounded-full loading-dot"></div>
                <div class="w-3 h-3 bg-brand-400 rounded-full loading-dot"></div>
                <div class="w-3 h-3 bg-brand-400 rounded-full loading-dot"></div>
            </div>
            <p class="text-sm text-gray-500 font-semibold" id="loading-text">Mencari layanan kesehatan mental terdekat...</p>
        </div>

        <!-- Main Content -->
        <div id="nearby-content" class="hidden space-y-5">

            <!-- Filter tabs -->
            <div class="flex gap-2 flex-wrap">
                <button onclick="filterPlaces('all')" id="filter-all" class="filter-btn px-4 py-2 text-xs font-bold rounded-xl border transition bg-brand-600 text-white border-brand-600">
                    🔍 Semua
                </button>
                <button onclick="filterPlaces('psychologist')" id="filter-psy" class="filter-btn px-4 py-2 text-xs font-bold rounded-xl border transition bg-white text-neutralDark border-brand-100 hover:bg-brand-50">
                    🧠 Psikolog
                </button>
                <button onclick="filterPlaces('hospital')" id="filter-hosp" class="filter-btn px-4 py-2 text-xs font-bold rounded-xl border transition bg-white text-neutralDark border-brand-100 hover:bg-brand-50">
                    🏥 Klinik / RSJ
                </button>
                <button onclick="filterPlaces('counselor')" id="filter-counsel" class="filter-btn px-4 py-2 text-xs font-bold rounded-xl border transition bg-white text-neutralDark border-brand-100 hover:bg-brand-50">
                    🏫 Konselor
                </button>
            </div>

            <!-- Stats bar -->
            <div class="flex gap-4 text-xs text-gray-500 bg-white border border-brand-100 rounded-xl px-4 py-2.5 flex-wrap">
                <span>Ditemukan: <strong class="text-brand-600" id="result-count">0</strong> tempat</span>
                <span>·</span>
                <span>Terdekat: <strong class="text-green-600" id="nearest-dist">—</strong></span>
                <span>·</span>
                <span class="text-gray-400">Data: OpenStreetMap © contributors</span>
            </div>

            <!-- Split layout -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">
                <!-- List sidebar -->
                <div class="lg:col-span-2 space-y-2.5 max-h-[550px] overflow-y-auto pr-1" id="places-list"></div>
                <!-- Map with floating badge -->
                <div class="lg:col-span-3 relative">
                    <div id="map" class="w-full h-[550px] rounded-2xl shadow-lg border-2 border-[#E4EDF7] overflow-hidden"></div>
                    <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-2 rounded-xl border border-[#E4EDF7] shadow-lg text-xs font-bold text-[#396696] flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-[#396696] animate-pulse"></span>
                        📍 Lokasi Kamu
                    </div>
                </div>
            </div>

            <!-- No results fallback -->
            <div id="no-results" class="hidden text-center py-8 text-gray-400">
                <p class="text-3xl mb-2">🔍</p>
                <p class="text-sm font-semibold">Tidak ada hasil dalam area ini.</p>
                <p class="text-xs mt-1">Coba perlebar radius pencarian atau gunakan kata kunci berbeda.</p>
            </div>
        </div>

        <!-- Hotline Darurat -->
        <div class="rounded-2xl border border-[#FCA5A5] bg-gradient-to-br from-[#FEF2F2] to-[#FEE2E2] p-5 space-y-4">
            <h3 class="font-outfit font-bold text-[#DC2626] flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-[#DC2626] text-white flex items-center justify-center text-sm">🆘</span>
                Butuh Bantuan Segera? (24 Jam)
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <a href="tel:119" class="flex items-center gap-3 p-3.5 bg-white border border-red-100 rounded-xl hover:bg-red-50 transition shadow-sm">
                    <span class="text-2xl">📞</span>
                    <div><p class="text-[10px] font-bold text-red-700 uppercase tracking-wide">SEJIWA (Kemenkes)</p><p class="text-base font-extrabold text-red-600">119 ext 8</p></div>
                </a>
                <a href="tel:08113855472" class="flex items-center gap-3 p-3.5 bg-white border border-red-100 rounded-xl hover:bg-red-50 transition shadow-sm">
                    <span class="text-2xl">📱</span>
                    <div><p class="text-[10px] font-bold text-red-700 uppercase tracking-wide">LISA (24 jam)</p><p class="text-base font-extrabold text-red-600">0811-385-5472</p></div>
                </a>
                <a href="https://www.intothelightid.org" target="_blank" class="flex items-center gap-3 p-3.5 bg-white border border-red-100 rounded-xl hover:bg-red-50 transition shadow-sm">
                    <span class="text-2xl">🌐</span>
                    <div><p class="text-[10px] font-bold text-red-700 uppercase tracking-wide">Into The Light</p><p class="text-base font-extrabold text-red-600">intothelightid.org</p></div>
                </a>
            </div>
        </div>

    </main>

    <!-- FOOTER - Landing Page Style -->
    <footer class="bg-[#1E2229] text-white mt-auto">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10">
                <div class="space-y-4">
                    <div class="flex items-center gap-2 text-lg font-outfit font-extrabold">💙 SoulKeep</div>
                    <p class="text-xs sm:text-sm text-white/60 leading-relaxed">Platform kesehatan mental gratis untuk mahasiswa Indonesia. Mendukung UN SDG Goal 3.</p>
                    <p class="text-[10px] text-white/40">© 2026 SoulKeep · Dibuat dengan 💙 untuk Indonesia</p>
                </div>
                <div class="space-y-3">
                    <h4 class="text-[10px] font-bold uppercase tracking-widest text-white/40 mb-4">Navigasi</h4>
                    <a href="/dashboard" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">🏠 Dashboard</a>
                    <a href="/assessment" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">📝 Tes Stres</a>
                    <a href="/relaxation" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">🌬️ Relaksasi</a>
                    <a href="/games" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">🎮 Terapi Game</a>
                    <a href="/nearby" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">📍 Psikolog Terdekat</a>
                    <a href="/education" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">📚 Library &amp; Sumber</a>
                </div>
                <div class="space-y-3">
                    <h4 class="text-[10px] font-bold uppercase tracking-widest text-white/40 mb-4">Sumber Daya</h4>
                    <a href="https://sdgs.un.org/goals/goal3" target="_blank" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">🌍 Tentang SDG 3</a>
                    <a href="/education" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">📖 Panduan Lengkap</a>
                    <a href="/nearby" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">🏥 Psikolog Terdekat</a>
                    <p class="text-xs sm:text-sm text-white/70">🔐 Data 100% Privat</p>
                </div>
                <div class="space-y-3">
                    <h4 class="text-[10px] font-bold uppercase tracking-widest text-red-400/80 mb-4">🆘 Bantuan Darurat</h4>
                    <a href="tel:119" class="flex items-center gap-2 text-xs sm:text-sm text-white/70 hover:text-white transition">
                        <span>📞</span>
                        <div class="leading-tight"><p class="text-[9px] text-white/40">SEJIWA</p><p class="font-bold">119 ext 8</p></div>
                    </a>
                    <a href="tel:08113855472" class="flex items-center gap-2 text-xs sm:text-sm text-white/70 hover:text-white transition">
                        <span>📱</span>
                        <div class="leading-tight"><p class="text-[9px] text-white/40">LISA</p><p class="font-bold">0811-385-5472</p></div>
                    </a>
                    <a href="https://www.intothelightid.org" target="_blank" class="flex items-center gap-2 text-xs sm:text-sm text-white/70 hover:text-white transition">
                        <span>🌐</span>
                        <div class="leading-tight"><p class="text-[9px] text-white/40">Into The Light</p><p class="font-bold">intothelightid.org</p></div>
                    </a>
                </div>
            </div>
            <div class="border-t border-white/10 mt-8 pt-6 text-center text-xs text-white/40">
                <p>Layanan kesehatan mental digital. Bukan pengganti konsultasi profesional. Jika dalam krisis, hubungi 119 ext 8 atau layanan darurat lokal.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Nav -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 border-t border-[#E4EDF7] bg-white/95 backdrop-blur-sm">
        <div class="flex justify-around h-16 items-center px-1">
            <a href="/dashboard"  class="mob-nav-item"><span class="text-xl">🏠</span><span class="text-[8px] font-bold mt-0.5">Home</span></a>
            <a href="/assessment" class="mob-nav-item"><span class="text-xl">📝</span><span class="text-[8px] font-bold mt-0.5">Tes</span></a>
            <a href="/games"      class="mob-nav-item"><span class="text-xl">🎮</span><span class="text-[8px] font-bold mt-0.5">Game</span></a>
            <a href="/nearby"     class="mob-nav-item active"><span class="text-xl">📍</span><span class="text-[8px] font-bold mt-0.5">Psikolog</span></a>
            <a href="/relaxation" class="mob-nav-item"><span class="text-xl">🌬️</span><span class="text-[8px] font-bold mt-0.5">Napas</span></a>
        </div>
    </nav>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
// ─── AUTH & NAVBAR ────────────────────────────────────────────────
if (!localStorage.getItem('soulkeep_token')) window.location.href = '/login';
const _n = localStorage.getItem('soulkeep_name') || 'Pengguna';
const _el = document.getElementById('user-name');
const _av = document.getElementById('user-avatar');
if (_el) _el.textContent = _n;
if (_av) _av.textContent = _n[0].toUpperCase();
window.addEventListener('scroll', () => {
    document.getElementById('main-nav')?.classList.toggle('scrolled', window.scrollY > 10);
});
function logout() { localStorage.clear(); window.location.href = '/login'; }

// ─── STATE ────────────────────────────────────────────────────────
let map = null, allPlaces = [], markers = [];
let userLat = null, userLng = null;

// ─── GEOLOCATION ──────────────────────────────────────────────────
function getLocation() {
    if (!navigator.geolocation) { showLocError('Browser tidak mendukung geolocation.'); return; }
    document.getElementById('location-prompt').innerHTML = `
        <div class="text-5xl mb-3 animate-pulse">📡</div>
        <p class="font-bold text-brand-700 text-lg">Mendapatkan lokasi...</p>
        <p class="text-xs text-gray-400 mt-1">Mohon izinkan akses lokasi di browser.</p>`;
    navigator.geolocation.getCurrentPosition(
        pos => { userLat = pos.coords.latitude; userLng = pos.coords.longitude; startSearch(); },
        err => showLocError('Akses lokasi ditolak. ' + (err.message || '')),
        { timeout: 12000, enableHighAccuracy: true }
    );
}

function showLocError(msg) {
    document.getElementById('location-prompt').innerHTML = `
        <div class="text-4xl mb-3">❌</div>
        <p class="font-bold text-red-600 text-lg">Gagal mendapatkan lokasi</p>
        <p class="text-sm text-gray-500 mt-1 max-w-xs mx-auto">${msg}</p>
        <div class="flex gap-3 justify-center mt-4">
            <button onclick="getLocation()" class="px-5 py-2.5 bg-brand-600 text-white font-bold rounded-xl text-sm hover:bg-brand-700 transition">🔄 Coba Lagi</button>
            <button onclick="useManualSearch()" class="px-5 py-2.5 bg-white border border-brand-200 text-brand-700 font-bold rounded-xl text-sm hover:bg-brand-50 transition">🔍 Cari Manual</button>
        </div>`;
}

function useManualSearch() {
    document.getElementById('manual-panel').classList.remove('hidden');
    document.getElementById('location-prompt').classList.add('hidden');
}

function searchManual() {
    const city = document.getElementById('manual-city').value.trim();
    if (!city) return;
    setLoading(true, `Mencari koordinat "${city}"...`);
    document.getElementById('nearby-content').classList.remove('hidden');
    fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(city)}&format=json&limit=1&accept-language=id`, {
        headers: { 'User-Agent': 'SoulKeep/1.0' }
    })
    .then(r => r.json())
    .then(data => {
        if (!data.length) { alert('Kota tidak ditemukan.'); setLoading(false); return; }
        userLat = parseFloat(data[0].lat);
        userLng = parseFloat(data[0].lon);
        startSearch();
    })
    .catch(() => { alert('Gagal mencari kota.'); setLoading(false); });
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('manual-city')?.addEventListener('keydown', e => {
        if (e.key === 'Enter') searchManual();
    });
});

// ─── INIT PETA ────────────────────────────────────────────────────
function startSearch() {
    document.getElementById('location-prompt').classList.add('hidden');
    document.getElementById('location-status')?.classList.remove('hidden');
    document.getElementById('nearby-content').classList.remove('hidden');
    setLoading(true, 'Memuat peta...');
    initMap(userLat, userLng);
    fetchAllPlaces(userLat, userLng);
}

function initMap(lat, lng) {
    if (map) { map.remove(); map = null; }
    map = L.map('map', { zoomControl: true }).setView([lat, lng], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);
    L.marker([lat, lng], {
        icon: L.divIcon({
            html: `<div style="width:22px;height:22px;background:#396696;border:3px solid white;border-radius:50%;box-shadow:0 2px 8px rgba(57,102,150,0.6)"></div>`,
            className: '', iconAnchor: [11, 11]
        })
    }).addTo(map).bindPopup('<b>📍 Lokasiku</b>').openPopup();
}

// ─── FETCH PLACES — MULTI-API WATERFALL ───────────────────────────
function fetchAllPlaces(lat, lng) {
    allPlaces = [];
    markers.forEach(m => { try { m.marker.remove(); } catch(e){} });
    markers = [];
    setLoading(true, 'Mencari layanan kesehatan mental...');

    const R = 25000;
    const q = `[out:json][timeout:30];(node["amenity"~"^(hospital|clinic)$"](around:${R},${lat},${lng});way["amenity"~"^(hospital|clinic)$"](around:${R},${lat},${lng});node["healthcare"~"^(hospital|clinic|doctor|psychologist|psychiatrist|counselling)$"](around:${R},${lat},${lng});node["amenity"="doctors"](around:${R},${lat},${lng}););out center tags qt;`;

    const overpassEndpoints = [
        'https://overpass-api.de/api/interpreter',
        'https://overpass.kumi.systems/api/interpreter',
        'https://maps.mail.ru/osm/tools/overpass/api/interpreter'
    ];

    tryOverpass(overpassEndpoints, 0, q, lat, lng);
}

function tryOverpass(endpoints, idx, query, lat, lng) {
    if (idx >= endpoints.length) {
        console.warn('All Overpass endpoints failed, falling back to Nominatim');
        fetchViaNominatim(lat, lng);
        return;
    }
    setLoading(true, `Mencari data (metode ${idx + 1})...`);
    fetch(endpoints[idx], {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'data=' + encodeURIComponent(query),
        signal: AbortSignal.timeout(20000)
    })
    .then(r => { if (!r.ok) throw new Error('HTTP ' + r.status); return r.json(); })
    .then(data => {
        const elements = data.elements || [];
        elements.forEach(el => processOverpassElement(el, lat, lng));
        if (allPlaces.length === 0) {
            tryOverpass(endpoints, idx + 1, query, lat, lng);
        } else {
            finalize(lat, lng);
        }
    })
    .catch(() => tryOverpass(endpoints, idx + 1, query, lat, lng));
}

// ─── PROSES ELEMEN OVERPASS ───────────────────────────────────────
const MENTAL_KEYWORDS = /psikolog|psikiatri|jiwa|mental|konseling|konselor|rehabilitasi|narkoba|napza|kejiwaan|rsj|rsjd|emotional|wellbeing/i;

function processOverpassElement(el, userLat, userLng) {
    const tags = el.tags || {};
    const name = tags.name || '';
    if (!name) return;

    const isRelevant =
        MENTAL_KEYWORDS.test(name) ||
        MENTAL_KEYWORDS.test(tags['healthcare:speciality'] || '') ||
        tags.healthcare === 'psychologist' ||
        tags.healthcare === 'psychiatrist' ||
        tags.healthcare === 'counselling' ||
        (tags['amenity'] === 'hospital' && MENTAL_KEYWORDS.test(Object.values(tags).join(' ')));

    if (!isRelevant) return;

    const elLat = el.lat || (el.center && el.center.lat);
    const elLng = el.lon || (el.center && el.center.lon);
    if (!elLat || !elLng) return;

    const uid = `${name.toLowerCase().replace(/\s/g,'')}-${parseFloat(elLat).toFixed(3)}-${parseFloat(elLng).toFixed(3)}`;
    if (allPlaces.find(p => p.uid === uid)) return;

    const dist = calcDist(userLat, userLng, elLat, elLng);
    const cat = classifyTags(tags, name);
    const { emoji, color } = catMeta(cat);
    const address = [tags['addr:street'], tags['addr:housenumber'], tags['addr:suburb'], tags['addr:city']]
        .filter(Boolean).join(', ') || tags['addr:full'] || '';

    allPlaces.push({ uid, name, address, lat: elLat, lon: elLng, category: cat, emoji, markerColor: color, distance: dist,
        phone: tags.phone || tags['contact:phone'] || '',
        website: tags.website || tags['contact:website'] || '',
        opening_hours: tags.opening_hours || '' });
}

// ─── FALLBACK: NOMINATIM MULTI-QUERY ──────────────────────────────
function fetchViaNominatim(lat, lng) {
    setLoading(true, 'Mencari dengan metode alternatif...');
    const delta = 0.45;
    const viewbox = `${lng-delta},${lat+delta},${lng+delta},${lat-delta}`;
    const terms = [
        'rumah sakit jiwa', 'klinik psikologi', 'psikolog',
        'klinik jiwa', 'psikiatri', 'konselor psikologi',
        'RSJD', 'RSJ', 'rehabilitasi mental'
    ];
    let pending = terms.length;

    terms.forEach(term => {
        fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(term)}&format=json&limit=6&viewbox=${viewbox}&bounded=0&addressdetails=1&accept-language=id,en`, {
            headers: { 'User-Agent': 'SoulKeep/1.0 (mental health app)' }
        })
        .then(r => r.json())
        .then(data => {
            (data || []).forEach(place => {
                const pLat = parseFloat(place.lat);
                const pLng = parseFloat(place.lon);
                const name = place.display_name.split(',')[0];
                const uid = `nom-${name.toLowerCase().replace(/\s/g,'')}-${pLat.toFixed(3)}-${pLng.toFixed(3)}`;
                if (allPlaces.find(p => p.uid === uid)) return;
                const dist = calcDist(lat, lng, pLat, pLng);
                const cat = term.includes('psikolog') || term.includes('konselor') ? 'psychologist'
                           : term.includes('jiwa') || term.includes('psikiatri') || term.includes('RSJ') ? 'hospital'
                           : 'counselor';
                const { emoji, color } = catMeta(cat);
                allPlaces.push({ uid, name, address: place.display_name.split(',').slice(1,4).join(', '),
                    lat: pLat, lon: pLng, category: cat, emoji, markerColor: color, distance: dist,
                    phone: '', website: '', opening_hours: '' });
            });
        })
        .catch(() => {})
        .finally(() => { if (--pending === 0) finalize(lat, lng); });
    });
}

// ─── FINALIZE ─────────────────────────────────────────────────────
function finalize(lat, lng) {
    setLoading(false);
    allPlaces.sort((a, b) => a.distance - b.distance);

    if (allPlaces.length === 0) {
        fetchFallbackAllHealth(lat, lng);
        return;
    }

    allPlaces.forEach(p => addMarker(p));
    renderList('all');

    const nearest = allPlaces[0];
    const nearestEl = document.getElementById('nearest-dist');
    if (nearestEl) nearestEl.textContent = nearest.distance < 1
        ? `${Math.round(nearest.distance * 1000)} m — ${nearest.name}`
        : `${nearest.distance.toFixed(1)} km — ${nearest.name}`;

    if (allPlaces.length > 1 && map) {
        try {
            const bounds = L.latLngBounds([[lat, lng], ...allPlaces.slice(0,15).map(p => [p.lat, p.lon])]);
            map.fitBounds(bounds, { padding: [50, 50], maxZoom: 14 });
        } catch(e) {}
    }
}

// ─── LAST-RESORT: SEMUA RS/KLINIK 40KM ───────────────────────────
function fetchFallbackAllHealth(lat, lng) {
    setLoading(true, 'Memperluas pencarian...');
    const q = `[out:json][timeout:25];(node["amenity"~"^(hospital|clinic)$"](around:40000,${lat},${lng});way["amenity"~"^(hospital|clinic)$"](around:40000,${lat},${lng}););out center tags qt;`;
    fetch('https://overpass-api.de/api/interpreter', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'data=' + encodeURIComponent(q),
        signal: AbortSignal.timeout(25000)
    })
    .then(r => r.json())
    .then(data => {
        (data.elements || []).forEach(el => {
            const name = (el.tags || {}).name || '';
            if (!name) return;
            const elLat = el.lat || (el.center && el.center.lat);
            const elLng = el.lon || (el.center && el.center.lon);
            if (!elLat || !elLng) return;
            const uid = `fb-${name.toLowerCase().replace(/\s/g,'')}-${parseFloat(elLat).toFixed(3)}`;
            if (allPlaces.find(p => p.uid === uid)) return;
            const dist = calcDist(lat, lng, elLat, elLng);
            allPlaces.push({ uid, name, address: '', lat: elLat, lon: elLng,
                category: 'hospital', emoji: '🏥', markerColor: '#ef4444', distance: dist,
                phone: (el.tags||{}).phone || '', website: '', opening_hours: '' });
        });
        setLoading(false);
        if (allPlaces.length === 0) {
            document.getElementById('no-results').classList.remove('hidden');
            document.getElementById('result-count').textContent = '0';
        } else {
            allPlaces.sort((a,b) => a.distance - b.distance);
            allPlaces.forEach(p => addMarker(p));
            renderList('all');
        }
    })
    .catch(() => { setLoading(false); document.getElementById('no-results').classList.remove('hidden'); });
}

// ─── MARKER ───────────────────────────────────────────────────────
function addMarker(place) {
    if (!map || isNaN(place.lat) || isNaN(place.lon)) return;
    const icon = L.divIcon({
        html: `<div style="width:36px;height:36px;background:${place.markerColor};border:3px solid white;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;box-shadow:0 4px 12px rgba(0,0,0,0.25);cursor:pointer">${place.emoji}</div>`,
        className: '', iconAnchor: [18, 18]
    });
    const distLabel = place.distance < 1 ? `${Math.round(place.distance*1000)} m` : `${place.distance.toFixed(1)} km`;
    const phoneHtml = place.phone ? `<p style="font-size:11px;color:#16a34a;font-weight:700;margin:3px 0">📞 ${place.phone}</p>` : '';
    const hoursHtml = place.opening_hours ? `<p style="font-size:10px;color:#6b7280;margin:2px 0">🕐 ${place.opening_hours}</p>` : '';
    const mapsUrl  = `https://www.openstreetmap.org/?mlat=${place.lat}&mlon=${place.lon}&zoom=17`;
    const webHtml  = place.website ? `<a href="${place.website}" target="_blank" style="font-size:10px;color:#396696;margin-right:6px">🌐 Website</a>` : '';
    const m = L.marker([place.lat, place.lon], { icon }).addTo(map);
    m.bindPopup(`
        <div style="font-family:'Plus Jakarta Sans',sans-serif;min-width:200px;max-width:260px">
            <p style="font-weight:800;font-size:13px;margin:0 0 4px;color:#1E2229;line-height:1.3">${place.emoji} ${place.name}</p>
            ${place.address ? `<p style="font-size:11px;color:#6b7280;margin:0 0 4px;line-height:1.4">${place.address}</p>` : ''}
            <p style="font-size:12px;color:#396696;font-weight:700;margin:0 0 4px">📏 ${distLabel} dari lokasimu</p>
            ${phoneHtml}${hoursHtml}
            <div style="margin-top:8px;display:flex;align-items:center;flex-wrap:wrap;gap:4px">
                ${webHtml}<a href="${mapsUrl}" target="_blank"
                   style="display:inline-block;padding:5px 12px;background:#396696;color:white;border-radius:8px;font-size:11px;font-weight:700;text-decoration:none">🗺️ Buka Maps</a>
            </div>
        </div>`);
    markers.push({ marker: m, uid: place.uid });
}

// ─── RENDER LIST ──────────────────────────────────────────────────
function renderList(filter) {
    const list = filter === 'all' ? allPlaces : allPlaces.filter(p => p.category === filter);

    document.querySelectorAll('.filter-btn').forEach(b => {
        b.classList.remove('bg-brand-600','text-white','border-brand-600');
        b.classList.add('bg-white','text-neutralDark','border-brand-100');
    });
    const mapFilter = { all:'filter-all', psychologist:'filter-psy', hospital:'filter-hosp', counselor:'filter-counsel' };
    const ab = document.getElementById(mapFilter[filter]);
    if (ab) { ab.classList.add('bg-brand-600','text-white','border-brand-600'); ab.classList.remove('bg-white','text-neutralDark','border-brand-100'); }

    document.getElementById('result-count').textContent = list.length;
    const container = document.getElementById('places-list');

    if (!list.length) {
        document.getElementById('no-results').classList.remove('hidden');
        container.innerHTML = '';
        return;
    }
    document.getElementById('no-results').classList.add('hidden');

    container.innerHTML = list.map(p => {
        const distLabel = p.distance < 1 ? `${Math.round(p.distance*1000)} m` : `${p.distance.toFixed(1)} km`;
        const distCls   = p.distance < 2 ? 'text-green-700 bg-green-50 border-green-200'
                        : p.distance < 8 ? 'text-brand-700 bg-brand-50 border-brand-200'
                        : 'text-gray-600 bg-gray-50 border-gray-200';
        const safeId    = p.uid.replace(/[^a-zA-Z0-9]/g,'-');
        const safeUid   = p.uid.replace(/\\/g,'\\\\').replace(/'/g,"\\'");
        const mapsUrl   = `https://www.openstreetmap.org/?mlat=${p.lat}&mlon=${p.lon}&zoom=17`;
        const phoneHtml = p.phone ? `<p class="text-xs text-green-600 font-semibold">📞 ${p.phone}</p>` : '';
        const hoursHtml = p.opening_hours ? `<p class="text-[10px] text-gray-400">🕐 ${p.opening_hours}</p>` : '';
        return `
        <div onclick="focusPlace('${safeUid}')"
             class="place-card cursor-pointer p-4 bg-white border border-brand-100 rounded-2xl space-y-1.5 group"
             id="card-${safeId}">
            <div class="flex justify-between items-start gap-2">
                <p class="font-bold text-sm text-neutralDark leading-snug group-hover:text-brand-700 transition">${p.emoji} ${p.name}</p>
                <span class="text-[10px] font-bold border px-2 py-0.5 rounded-full shrink-0 ${distCls}">📏 ${distLabel}</span>
            </div>
            ${p.address ? `<p class="text-xs text-neutralDark/50 leading-relaxed">${p.address}</p>` : ''}
            ${phoneHtml}${hoursHtml}
            <a href="${mapsUrl}" target="_blank" onclick="event.stopPropagation()"
               class="inline-block text-[11px] font-bold text-brand-600 hover:underline mt-1">Buka di Maps →</a>
        </div>`;
    }).join('');
}

function focusPlace(uid) {
    const place = allPlaces.find(p => p.uid === uid);
    if (!place || !map) return;
    map.flyTo([place.lat, place.lon], 17, { duration: 1.2 });
    const mo = markers.find(m => m.uid === uid);
    if (mo) mo.marker.openPopup();
    document.querySelectorAll('.place-card').forEach(c => c.classList.remove('selected'));
    const card = document.getElementById('card-' + uid.replace(/[^a-zA-Z0-9]/g,'-'));
    if (card) { card.classList.add('selected'); card.scrollIntoView({ behavior:'smooth', block:'nearest' }); }
}

function filterPlaces(type) { renderList(type); }

// ─── HELPERS ──────────────────────────────────────────────────────
function calcDist(lat1, lng1, lat2, lng2) {
    const R = 6371, dLat = (lat2-lat1)*Math.PI/180, dLng = (lng2-lng1)*Math.PI/180;
    const a = Math.sin(dLat/2)**2 + Math.cos(lat1*Math.PI/180)*Math.cos(lat2*Math.PI/180)*Math.sin(dLng/2)**2;
    return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
}

function classifyTags(tags, name) {
    const lc = (name + ' ' + (tags.healthcare||'') + ' ' + (tags['healthcare:speciality']||'')).toLowerCase();
    if (/psikolog|psikologi|counsell|konseling|konselor/.test(lc)) return 'psychologist';
    if (/psikiatri|psychiatr/.test(lc)) return 'hospital';
    if (/konselor|bk |bimbingan/.test(lc)) return 'counselor';
    return 'hospital';
}

function catMeta(cat) {
    return { psychologist:{emoji:'🧠',color:'#396696'}, hospital:{emoji:'🏥',color:'#ef4444'}, counselor:{emoji:'🏫',color:'#22c55e'} }[cat]
        || { emoji:'🏥', color:'#ef4444' };
}

function setLoading(show, msg) {
    const el  = document.getElementById('loading-state');
    const txt = document.getElementById('loading-text');
    if (el)  el.classList.toggle('hidden', !show);
    if (txt && msg) txt.textContent = msg;
}
    </script>


</body>
</html>
