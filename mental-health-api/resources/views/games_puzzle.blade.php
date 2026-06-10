<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SoulKeep — Puzzle Pikiran: Susun kalimat afirmasi positif yang teracak. Teknik Cognitive Reframing berbasis CBT.">
    <meta name="theme-color" content="#396696">
    <title>Puzzle Pikiran — SoulKeep</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💙</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        * { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #1E2229; background: #F4F7FB; }
        @keyframes fadeUp { from{opacity:0;transform:translateY(28px)} to{opacity:1;transform:translateY(0)} }
        .fade-up { animation: fadeUp 0.65s ease-out forwards; opacity:0; }
        .fade-up-d1 { animation-delay:0.1s; }
        .fade-up-d2 { animation-delay:0.22s; }
        .fade-up-d3 { animation-delay:0.34s; }
        @keyframes correctBounce { 0%,100%{transform:translateY(0)} 40%{transform:translateY(-8px)} }
        nav.scrolled { box-shadow: 0 4px 24px -6px rgba(57,102,150,0.18); }
        .nav-item { color: #64748b; transition: all 0.25s ease; }
        .nav-item:hover { background: #E4EDF7; color: #2E5178; border-radius: 8px; }
        .nav-item.active { background: #E4EDF7; color: #2E5178; font-weight: 700; border-radius: 8px; }
        .mob-nav-item { display:flex; flex-direction:column; align-items:center; justify-content:center; flex:1; padding:6px 2px; color:#94a3b8; transition:all 0.25s ease; text-decoration:none; }
        .mob-nav-item:hover { color:#396696; }
        .mob-nav-item.active { color:#396696; }
        .card { background:#fff; border-radius:16px; border:1px solid #E4EDF7; padding:1.5rem; transition: all 0.3s ease; }
        .card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px -8px rgba(57,102,150,0.15); }
        .btn-primary { background:#396696; color:#fff; font-weight:700; padding:0.75rem 1.5rem; border-radius:12px; border:none; cursor:pointer; transition: all 0.25s ease; font-size:0.875rem; }
        .btn-primary:hover { background:#2E5178; transform: translateY(-2px); box-shadow: 0 8px 20px -6px rgba(57,102,150,0.3); }
        /* Puzzle-specific */
        .word-tile { transition:all .2s; cursor:pointer; user-select:none; background:#fff; border:2px solid #E4EDF7; border-radius:12px; padding:.5rem 1rem; font-weight:700; font-size:.875rem; color:#1E2229; }
        .word-tile:hover { border-color:#396696; background:#E4EDF7; box-shadow:0 4px 12px rgba(57,102,150,.2); transform:translateY(-2px); }
        .word-tile.used { opacity:.3; pointer-events:none; transform:none; }
        .answer-slot { min-width:70px; min-height:44px; border-bottom:2px solid #396696; transition:all .2s; cursor:pointer; display:flex; align-items:center; justify-content:center; padding:8px 12px; }
        .answer-slot:hover { background:#E4EDF7; border-radius:8px; }
        .answer-slot.filled { border-color:#396696; background:#E4EDF7; border-radius:8px; border:2px solid #396696; }
        .correct-anim { animation:correctBounce .5s ease; }
        /* === VISUAL UPGRADE === */
        @keyframes blobMove { 0%,100%{border-radius:60% 40% 30% 70%/60% 30% 70% 40%} 50%{border-radius:30% 60% 70% 40%/50% 60% 30% 60%} }
        .blob-anim { animation: blobMove 12s ease-in-out infinite; }
        .img-overlay { position: absolute; inset: 0; background: linear-gradient(180deg, transparent 0%, rgba(30,34,41,0.65) 100%); }
        .icon-box { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
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
                <a href="/dashboard"  class="nav-item px-3 py-2 text-sm font-semibold">🏠 Dashboard</a>
                <a href="/assessment" class="nav-item px-3 py-2 text-sm font-semibold">📝 Tes Stres</a>
                <a href="/relaxation" class="nav-item px-3 py-2 text-sm font-semibold">🌬️ Relaksasi</a>
                <a href="/games"      class="nav-item active px-3 py-2 text-sm font-semibold">🎮 Terapi Game</a>
                <a href="/nearby"     class="nav-item px-3 py-2 text-sm font-semibold">📍 Psikolog</a>
                <a href="/education"  class="nav-item px-3 py-2 text-sm font-semibold">📚 Library</a>
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
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 sm:py-10 pb-24 md:pb-10 space-y-6">

        <!-- Hero Section -->
        <div class="relative overflow-hidden rounded-2xl mb-8 h-[260px] sm:h-[300px] fade-up fade-up-d1">
            <img src="https://images.unsplash.com/photo-1609234656388-0ff363383899?w=1200&q=70" alt="hero puzzle" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute -top-20 -right-20 w-64 h-64 shape-blob bg-white/5 shape-circle blob-anim hidden sm:block"></div>
            <div class="img-overlay"></div>
            <div class="relative z-10 h-full flex flex-col justify-between p-6 sm:p-8">
                <div class="flex items-center justify-between">
                    <a href="/games" class="text-white/70 text-xs hover:text-white font-semibold flex items-center gap-1 transition">← Kembali</a>
                    <span class="inline-flex items-center gap-2 text-xs font-bold bg-white/15 text-white px-4 py-1.5 rounded-full border border-white/30 backdrop-blur-sm">🧩 CBT · Cognitive Reframing</span>
                </div>
                <div class="space-y-2">
                    <h1 class="text-3xl sm:text-4xl font-outfit font-black text-white leading-tight">Puzzle Pikiran</h1>
                    <p class="text-white/80 text-sm sm:text-base max-w-md leading-relaxed">Susun kalimat afirmasi positif dan internalisasikan perspektif baru yang lebih sehat.</p>
                    <div class="flex gap-3 mt-3">
                        <div class="bg-white/15 backdrop-blur-sm border border-white/25 rounded-xl px-4 py-2 text-center">
                            <p class="text-xl font-outfit font-black text-white" id="pzl-banner-score">0</p>
                            <p class="text-[9px] text-white/70 font-semibold">Skor</p>
                        </div>
                        <div class="bg-white/15 backdrop-blur-sm border border-white/25 rounded-xl px-4 py-2 text-center">
                            <p class="text-xl font-outfit font-black text-white" id="pzl-banner-round">1/5</p>
                            <p class="text-[9px] text-white/70 font-semibold">Ronde</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2-column layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- KIRI: Game area -->
            <div class="lg:col-span-2 space-y-4">

                <div id="pzl-game-area" class="space-y-4">
                    <!-- Status -->
                    <div class="bg-white rounded-2xl border border-brand-100 p-4 shadow-sm flex justify-between items-center">
                        <p class="text-sm font-bold text-neutralDark">Ronde <span id="pzl-round">1</span>/5</p>
                        <p class="text-sm font-bold text-brand-600">Skor: <span id="pzl-score">0</span></p>
                    </div>

                    <!-- Instruksi -->
                    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 text-xs text-amber-800">
                        Susun kata-kata berikut menjadi kalimat afirmasi yang benar. Klik kata untuk memilih, klik jawaban untuk menghapus.
                    </div>

                    <!-- Tile pool -->
                    <div class="bg-white rounded-2xl border border-brand-100 p-5 shadow-sm">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Kata tersedia:</p>
                        <div id="pzl-tiles" class="flex flex-wrap gap-3"></div>
                    </div>

                    <!-- Answer area -->
                    <div class="bg-white rounded-2xl border border-brand-100 p-5 shadow-sm">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Susunanmu:</p>
                        <div id="pzl-answer" class="flex flex-wrap gap-3 min-h-[52px]"></div>
                    </div>

                    <!-- Feedback -->
                    <p id="pzl-feedback" class="text-sm font-bold text-red-500 text-center min-h-[20px]"></p>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <button onclick="pzlClear()" class="px-4 py-3 border border-gray-200 text-gray-500 font-bold rounded-xl text-sm hover:bg-gray-50 transition">🔄 Ulang</button>
                        <button onclick="pzlCheck()" class="flex-1 bg-brand-600 text-white font-bold py-3 rounded-xl hover:bg-brand-700 transition text-sm">✓ Cek Jawaban</button>
                    </div>

                    <!-- Round result -->
                    <div id="pzl-round-result" class="hidden bg-green-50 border border-green-200 rounded-2xl p-5 space-y-3">
                        <p class="text-green-700 font-bold text-center">✅ Benar! +20 poin</p>
                        <p class="text-sm text-green-800 font-semibold" id="pzl-round-meaning"></p>
                        <p class="text-xs text-green-700 leading-relaxed" id="pzl-round-insight"></p>
                        <button onclick="pzlNext()" class="w-full bg-green-600 text-white font-bold py-2.5 rounded-xl text-sm hover:bg-green-700 transition">Lanjut →</button>
                    </div>
                </div>

                <!-- Final result -->
                <div id="pzl-result" class="hidden bg-white rounded-2xl border border-brand-100 p-8 shadow-sm text-center space-y-4">
                    <span class="text-6xl">🎊</span>
                    <h2 class="font-outfit font-bold text-2xl text-neutralDark">Semua Ronde Selesai!</h2>
                    <p class="text-gray-500">Skor Akhir: <span class="text-3xl font-extrabold text-brand-600" id="pzl-final-score">0</span>/100</p>
                    <p class="text-sm text-gray-400 leading-relaxed">Kamu baru saja melatih cognitive reframing — kemampuan melihat situasi dari sudut pandang positif. Latihan rutin ini terbukti menurunkan gejala depresi.</p>
                    <div class="flex gap-3 justify-center">
                        <button onclick="pzlInit()" class="px-6 py-3 border border-brand-200 text-brand-700 font-bold rounded-xl text-sm hover:bg-brand-50 transition">🔄 Main Lagi</button>
                        <a href="/games" class="px-6 py-3 bg-brand-600 text-white font-bold rounded-xl text-sm hover:bg-brand-700 transition">← Game Lain</a>
                    </div>
                </div>

            </div>

            <!-- KANAN: Sidebar -->
            <div class="space-y-4">

                <!-- Cara bermain -->
                <div class="bg-white rounded-2xl border border-brand-100 p-5 shadow-sm space-y-3">
                    <h3 class="font-outfit font-bold text-neutralDark">🎯 Cara Bermain</h3>
                    <div class="space-y-2 text-xs text-gray-600 leading-relaxed">
                        <div class="flex gap-2"><span class="font-bold text-brand-600 shrink-0">1.</span><p>Klik kata-kata di pool untuk menyusun kalimat afirmasi</p></div>
                        <div class="flex gap-2"><span class="font-bold text-brand-600 shrink-0">2.</span><p>Klik kata di area jawaban untuk menghapusnya kembali</p></div>
                        <div class="flex gap-2"><span class="font-bold text-brand-600 shrink-0">3.</span><p>Tekan <strong>Cek Jawaban</strong> — selesaikan 5 ronde untuk menang</p></div>
                    </div>
                </div>

                <!-- Manfaat klinis -->
                <div class="bg-white rounded-2xl border border-brand-100 p-5 shadow-sm space-y-3">
                    <h3 class="font-outfit font-bold text-neutralDark">🧠 Manfaat Klinis</h3>
                    <div class="space-y-3 text-xs text-gray-600 leading-relaxed">
                        <div class="flex gap-3"><span class="text-amber-500 text-base shrink-0">✦</span><p><strong>Cognitive Reframing</strong> adalah teknik inti CBT yang mengubah cara pandang terhadap situasi — mengurangi kecemasan dan depresi.</p></div>
                        <div class="flex gap-3"><span class="text-amber-500 text-base shrink-0">✦</span><p><strong>Positive Affirmation</strong> yang diulangi melatih otak membentuk jalur neural baru yang lebih optimis melalui neuroplastisitas.</p></div>
                        <div class="flex gap-3"><span class="text-amber-500 text-base shrink-0">✦</span><p>Aktivitas menyusun kata melatih <strong>working memory</strong> dan mengalihkan pikiran dari overthinking secara efektif.</p></div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="bg-gradient-to-br from-amber-600 to-brand-700 rounded-2xl p-5 text-white space-y-3">
                    <h3 class="font-outfit font-bold">💡 Tips Setelah Bermain</h3>
                    <ul class="space-y-2 text-xs text-amber-100 leading-relaxed">
                        <li class="flex gap-2"><span>1.</span><span>Ucapkan kalimat afirmasi favorit tadi keras-keras 3 kali</span></li>
                        <li class="flex gap-2"><span>2.</span><span>Tulis kalimat yang paling bermakna di ponselmu sebagai pengingat</span></li>
                        <li class="flex gap-2"><span>3.</span><span>Latih setiap pagi untuk efek jangka panjang terbaik</span></li>
                    </ul>
                </div>

                <!-- Darurat -->
                <div class="bg-red-50 border border-red-200 rounded-2xl p-4 space-y-2">
                    <p class="text-xs font-bold text-red-700">🆘 Butuh bicara dengan seseorang?</p>
                    <a href="tel:119" class="flex items-center gap-2 text-sm font-extrabold text-red-600 hover:text-red-800 transition">📞 119 ext 8 — SEJIWA Kemenkes</a>
                    <a href="/nearby" class="text-xs text-red-500 hover:text-red-700 underline transition">Temukan psikolog terdekat →</a>
                </div>

            </div>
        </div>

    </main>

    <!-- Mobile Bottom Nav -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 border-t" style="background:rgba(247,248,252,.97);backdrop-filter:blur(20px);border-color:#E2E4EE">
        <div class="flex justify-around items-center px-1 h-16 max-w-lg mx-auto">
            <a href="/dashboard"  class="mob-nav-item"><span class="mob-icon text-xl">🏠</span><span style="font-size:9px;font-weight:700">Home</span></a>
            <a href="/assessment" class="mob-nav-item"><span class="mob-icon text-xl">📝</span><span style="font-size:9px;font-weight:700">Tes</span></a>
            <a href="/games"      class="mob-nav-item active"><span class="mob-icon text-xl">🎮</span><span style="font-size:9px;font-weight:700">Game</span></a>
            <a href="/nearby"     class="mob-nav-item"><span class="mob-icon text-xl">📍</span><span style="font-size:9px;font-weight:700">Psikolog</span></a>
            <a href="/relaxation" class="mob-nav-item"><span class="mob-icon text-xl">🌬️</span><span style="font-size:9px;font-weight:700">Napas</span></a>
        </div>
    </nav>

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

    <script>
        const PZL_SENTENCES = [
            { words: ['AKU','LAYAK','UNTUK','BAHAGIA'], meaning: 'Kamu berhak atas kebahagiaan tanpa syarat apapun.', insight: 'Self-worth yang sehat adalah fondasi kesehatan mental. Afirmasi ini melawan negative self-talk.' },
            { words: ['HARI','INI','AKU','LEBIH','KUAT'], meaning: 'Setiap hari adalah kesempatan untuk tumbuh lebih kuat.', insight: 'Growth mindset terbukti mengurangi gejala depresi dan meningkatkan resiliensi.' },
            { words: ['AKU','BOLEH','MEMINTA','BANTUAN'], meaning: 'Meminta bantuan adalah tanda keberanian, bukan kelemahan.', insight: 'Mengatasi stigma help-seeking adalah langkah krusial dalam pemulihan kesehatan mental.' },
            { words: ['PERASAANKU','VALID','DAN','NYATA'], meaning: 'Emosi yang kamu rasakan adalah nyata dan berhak diakui.', insight: 'Validasi emosi diri sendiri (self-validation) adalah teknik inti DBT untuk regulasi emosi.' },
            { words: ['AKU','SEDANG','BERKEMBANG','SETIAP','HARI'], meaning: 'Pertumbuhan terjadi bahkan di hari-hari yang sulit.', insight: 'Mindset progres (bukan perfeksi) adalah prediktor kuat kesehatan mental jangka panjang.' },
            { words: ['AKU','BERHAK','ATAS','KEDAMAIAN'], meaning: 'Kedamaian batin adalah hakmu, bukan hadiah yang harus diraih.', insight: 'Acceptance-based therapy mengajarkan bahwa kedamaian dimulai dari penerimaan diri.' },
            { words: ['KEGAGALAN','BUKAN','AKHIR','SEGALANYA'], meaning: 'Setiap kegagalan adalah data untuk tumbuh, bukan vonis.', insight: 'Reframing kegagalan adalah teknik CBT untuk mengurangi kecemasan performa.' },
        ];

        let pzlRound = 0;
        let pzlSentence = null;
        let pzlShuffled = [];
        let pzlAnswer = [];
        let pzlScore = 0;
        let pzlUsedIndices = new Set();

        function pzlInit() {
            pzlRound = 0; pzlScore = 0;
            const scoreEl = document.getElementById('pzl-score');
            const roundEl = document.getElementById('pzl-round');
            if (scoreEl) scoreEl.textContent = '0';
            if (roundEl) roundEl.textContent = '1';
            document.getElementById('pzl-result').classList.add('hidden');
            document.getElementById('pzl-game-area').classList.remove('hidden');
            // user
            const name = localStorage.getItem('soulkeep_name') || 'Pengguna';
            const el = document.getElementById('user-name');
            if (el) el.textContent = name;
            const av = document.getElementById('user-avatar');
            if (av) av.textContent = name[0].toUpperCase();
            pzlUpdateBanner();
            pzlLoadRound();
        }

        function pzlUpdateBanner() {
            const bs = document.getElementById('pzl-banner-score');
            const br = document.getElementById('pzl-banner-round');
            if (bs) bs.textContent = pzlScore;
            if (br) br.textContent = `${pzlRound + 1}/5`;
        }

        function pzlLoadRound() {
            if (pzlRound >= 5) { pzlShowFinal(); return; }
            pzlSentence = PZL_SENTENCES[pzlRound % PZL_SENTENCES.length];
            pzlShuffled = [...pzlSentence.words].sort(() => Math.random() - 0.5);
            let attempts = 0;
            while (pzlShuffled.join() === pzlSentence.words.join() && attempts < 10) {
                pzlShuffled = [...pzlSentence.words].sort(() => Math.random() - 0.5);
                attempts++;
            }
            pzlAnswer = Array(pzlSentence.words.length).fill(null);
            pzlUsedIndices = new Set();
            const roundEl = document.getElementById('pzl-round');
            if (roundEl) roundEl.textContent = pzlRound + 1;
            document.getElementById('pzl-feedback').textContent = '';
            document.getElementById('pzl-round-result').classList.add('hidden');
            pzlUpdateBanner();
            pzlRender();
        }

        function pzlRender() {
            document.getElementById('pzl-tiles').innerHTML = pzlShuffled.map((w, i) =>
                `<button onclick="pzlPickTile(${i})" class="word-tile px-4 py-2.5 bg-white border-2 border-brand-200 rounded-xl text-sm font-bold text-neutralDark shadow-sm ${pzlUsedIndices.has(i) ? 'used' : ''}">${w}</button>`
            ).join('');

            document.getElementById('pzl-answer').innerHTML = pzlAnswer.map((w, i) =>
                `<div onclick="pzlRemoveFromAnswer(${i})" class="answer-slot ${w ? 'filled' : ''} text-sm font-bold text-brand-700">${w || ''}</div>`
            ).join('');
        }

        function pzlPickTile(idx) {
            if (pzlUsedIndices.has(idx)) return;
            const emptySlot = pzlAnswer.findIndex(a => a === null);
            if (emptySlot === -1) return;
            pzlAnswer[emptySlot] = pzlShuffled[idx];
            pzlUsedIndices.add(idx);
            pzlRender();
        }

        function pzlRemoveFromAnswer(slotIdx) {
            if (!pzlAnswer[slotIdx]) return;
            // Find which tile index this word came from
            const word = pzlAnswer[slotIdx];
            // Find the used tile index for this word (find in usedIndices)
            let tileIdx = -1;
            for (const idx of pzlUsedIndices) {
                if (pzlShuffled[idx] === word) {
                    // Check no other answer slot before this one has the same word from this tile
                    tileIdx = idx;
                    break;
                }
            }
            pzlAnswer[slotIdx] = null;
            if (tileIdx !== -1) pzlUsedIndices.delete(tileIdx);
            pzlRender();
        }

        function pzlCheck() {
            if (pzlAnswer.some(a => a === null)) {
                document.getElementById('pzl-feedback').textContent = 'Susun semua kata dulu ya!';
                return;
            }
            const correct = pzlAnswer.join(' ') === pzlSentence.words.join(' ');
            if (correct) {
                pzlScore += 20;
                const scoreEl = document.getElementById('pzl-score');
                if (scoreEl) scoreEl.textContent = pzlScore;
                document.getElementById('pzl-feedback').textContent = '';
                document.getElementById('pzl-round-meaning').textContent = pzlSentence.meaning;
                document.getElementById('pzl-round-insight').textContent = pzlSentence.insight;
                document.getElementById('pzl-round-result').classList.remove('hidden');
                pzlUpdateBanner();
                document.querySelectorAll('.answer-slot').forEach(el => {
                    el.classList.add('correct-anim');
                    el.style.background = '#f0fdf4';
                    el.style.borderColor = '#22c55e';
                });
            } else {
                document.getElementById('pzl-feedback').textContent = '\u274C Belum tepat. Coba lagi!';
                document.querySelectorAll('.answer-slot').forEach(el => {
                    el.style.borderColor = '#fca5a5';
                    el.style.background = '#fef2f2';
                    setTimeout(() => { el.style.borderColor = ''; el.style.background = ''; }, 600);
                });
            }
        }

        function pzlNext() {
            pzlRound++;
            document.getElementById('pzl-round-result').classList.add('hidden');
            pzlLoadRound();
        }

        function pzlClear() {
            pzlAnswer = Array(pzlSentence ? pzlSentence.words.length : 0).fill(null);
            pzlUsedIndices = new Set();
            pzlRender();
            document.getElementById('pzl-feedback').textContent = '';
        }

        function pzlShowFinal() {
            document.getElementById('pzl-game-area').classList.add('hidden');
            document.getElementById('pzl-result').classList.remove('hidden');
            const fsEl = document.getElementById('pzl-final-score');
            if (fsEl) fsEl.textContent = pzlScore;
            const gd = JSON.parse(localStorage.getItem('soulkeep_games') || '{"total":0,"today_date":"","today_count":0}');
            const today = new Date().toDateString();
            gd.total = (gd.total || 0) + 1;
            gd.today_count = gd.today_date === today ? (gd.today_count || 0) + 1 : 1;
            gd.today_date = today;
            localStorage.setItem('soulkeep_games', JSON.stringify(gd));
        }

        function logout() { localStorage.clear(); window.location.href = '/login'; }
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('main-nav');
            if (nav) nav.classList.toggle('scrolled', window.scrollY > 10);
        });
        window.addEventListener('DOMContentLoaded', pzlInit);
    </script>



    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 border-t border-[#E4EDF7] bg-white/95 backdrop-blur-sm">
        <div class="flex justify-around h-16 items-center px-1">
            <a href="/dashboard"  class="mob-nav-item"><span class="text-xl">🏠</span><span class="text-[8px] font-bold mt-0.5">Home</span></a>
            <a href="/assessment" class="mob-nav-item"><span class="text-xl">📝</span><span class="text-[8px] font-bold mt-0.5">Tes</span></a>
            <a href="/games"      class="mob-nav-item active"><span class="text-xl">🎮</span><span class="text-[8px] font-bold mt-0.5">Game</span></a>
            <a href="/nearby"     class="mob-nav-item"><span class="text-xl">📍</span><span class="text-[8px] font-bold mt-0.5">Psikolog</span></a>
            <a href="/relaxation" class="mob-nav-item"><span class="text-xl">🌬️</span><span class="text-[8px] font-bold mt-0.5">Napas</span></a>
        </div>
    </nav>
</body>
</html>
