<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SoulKeep — Jurnal Rasa: Teknik Emotional Labeling DBT untuk mengenali dan menamakan emosi. Mendukung UN SDG 3.">
    <meta name="theme-color" content="#396696">
    <title>Jurnal Rasa — SoulKeep</title>
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
        .btn-ghost { background:#fff; color:#396696; border:1.5px solid #E4EDF7; font-weight:700; padding:0.75rem 1.5rem; border-radius:12px; cursor:pointer; transition: all 0.25s ease; font-size:0.875rem; }
        .btn-ghost:hover { background:#F4F7FB; border-color:#396696; }
        /* Jurnal-specific */
        .intensity-btn { transition:all .2s; border:2px solid #E4EDF7; background:#fff; border-radius:12px; padding:.4rem .75rem; font-size:.8125rem; font-weight:700; cursor:pointer; color:#64748b; }
        .intensity-btn.active { background:#396696; color:#fff; border-color:#396696; box-shadow:0 4px 12px rgba(57,102,150,0.3); }
        .emotion-btn { transition:all .2s; }
        .emotion-btn:hover { transform:translateY(-2px); }
        .emotion-btn.used { opacity:.35; pointer-events:none; }
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
            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200&q=70" alt="hero jurnal" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute -top-20 -right-20 w-64 h-64 shape-blob bg-white/5 shape-circle blob-anim hidden sm:block"></div>
            <div class="img-overlay"></div>
            <div class="relative z-10 h-full flex flex-col justify-between p-6 sm:p-8">
                <div class="flex items-center justify-between">
                    <a href="/games" class="text-white/70 text-xs hover:text-white font-semibold flex items-center gap-1 transition">← Kembali</a>
                    <span class="inline-flex items-center gap-2 text-xs font-bold bg-white/15 text-white px-4 py-1.5 rounded-full border border-white/30 backdrop-blur-sm">🃏 DBT · Emotional Labeling</span>
                </div>
                <div class="space-y-2">
                    <h1 class="text-3xl sm:text-4xl font-outfit font-black text-white leading-tight">Jurnal Rasa</h1>
                    <p class="text-white/80 text-sm sm:text-base max-w-md leading-relaxed">Memberi nama pada emosi adalah langkah pertama untuk mengendalikannya.</p>
                    <div class="flex gap-3 mt-3">
                        <div class="bg-white/15 backdrop-blur-sm border border-white/25 rounded-xl px-4 py-2 text-center">
                            <p class="text-xl font-outfit font-black text-white" id="jrn-sessions-today">0</p>
                            <p class="text-[9px] text-white/70 font-semibold">Sesi hari ini</p>
                        </div>
                        <div class="bg-white/15 backdrop-blur-sm border border-white/25 rounded-xl px-4 py-2 text-center">
                            <p class="text-xl font-outfit font-black text-white" id="jrn-sessions-total">0</p>
                            <p class="text-[9px] text-white/70 font-semibold">Total sesi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2-column layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- KIRI: Game area -->
            <div class="lg:col-span-2 space-y-4">

                <!-- Progress bar -->
                <div class="bg-white rounded-2xl border border-brand-100 p-5 shadow-sm">
                    <div class="flex justify-between items-center mb-3">
                        <p class="text-sm font-bold text-neutralDark">Progress</p>
                        <p class="text-xs text-gray-400" id="jrn-progress-text">0 dari 3 emosi dipilih</p>
                    </div>
                    <div class="flex gap-2">
                        <div id="jrn-p1" class="flex-1 h-2.5 bg-gray-100 rounded-full transition-all duration-500"></div>
                        <div id="jrn-p2" class="flex-1 h-2.5 bg-gray-100 rounded-full transition-all duration-500"></div>
                        <div id="jrn-p3" class="flex-1 h-2.5 bg-gray-100 rounded-full transition-all duration-500"></div>
                    </div>
                </div>

                <!-- STEP 1: Emotion Picker -->
                <div id="jrn-picker" class="bg-white rounded-2xl border border-brand-100 p-6 shadow-sm space-y-4">
                    <div>
                        <h2 class="font-outfit font-bold text-lg text-neutralDark">Emosi mana yang paling kamu rasakan saat ini?</h2>
                        <p class="text-xs text-gray-400 mt-1">Pilih satu, lalu ceritakan sedikit tentangnya</p>
                    </div>
                    <div id="jrn-emotion-grid" class="grid grid-cols-3 sm:grid-cols-5 gap-3">
                        <!-- Diisi oleh JavaScript -->
                    </div>
                </div>

                <!-- STEP 2: Note Form -->
                <div id="jrn-note-form" class="hidden bg-white rounded-2xl border border-brand-100 p-6 shadow-sm space-y-5">
                    <div id="jrn-selected-display" class="flex items-center gap-4 p-4 bg-brand-50 rounded-2xl border border-brand-100">
                        <span id="jrn-sel-emoji" class="text-5xl"></span>
                        <div>
                            <p class="font-bold text-brand-700 text-lg" id="jrn-sel-label"></p>
                            <p class="text-xs text-brand-500">Emosi yang dipilih</p>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-neutralDark block mb-2">Ceritakan satu kalimat tentang perasaan ini:</label>
                        <textarea id="jrn-note" rows="3" class="w-full border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 transition resize-none bg-gray-50" placeholder="Contoh: Aku merasa cemas karena besok ada presentasi penting..."></textarea>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-neutralDark block mb-3">Seberapa kuat intensitas perasaan ini?</label>
                        <div class="flex gap-2 justify-center">
                            <button onclick="jrnSetIntensity(1)" class="intensity-btn w-12 h-12 rounded-xl text-sm font-bold" data-val="1">1<br><span class="text-[9px] text-gray-400">Ringan</span></button>
                            <button onclick="jrnSetIntensity(2)" class="intensity-btn w-12 h-12 rounded-xl text-sm font-bold" data-val="2">2</button>
                            <button onclick="jrnSetIntensity(3)" class="intensity-btn active w-12 h-12 rounded-xl text-sm font-bold" data-val="3">3</button>
                            <button onclick="jrnSetIntensity(4)" class="intensity-btn w-12 h-12 rounded-xl text-sm font-bold" data-val="4">4</button>
                            <button onclick="jrnSetIntensity(5)" class="intensity-btn w-12 h-12 rounded-xl text-sm font-bold" data-val="5">5<br><span class="text-[9px] text-gray-400">Kuat</span></button>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button onclick="jrnBackToPicker()" class="px-4 py-3 border border-gray-200 text-gray-500 font-bold rounded-xl text-sm hover:bg-gray-50 transition">← Ganti</button>
                        <button onclick="jrnSaveNote()" class="flex-1 bg-brand-600 text-white font-bold py-3 rounded-xl hover:bg-brand-700 transition text-sm">Simpan &amp; Lanjut →</button>
                    </div>
                </div>

                <!-- STEP 3: Result -->
                <div id="jrn-result" class="hidden bg-white rounded-2xl border border-brand-100 p-6 shadow-sm space-y-5">
                    <div class="text-center space-y-2">
                        <span class="text-5xl">📊</span>
                        <h2 class="font-outfit font-bold text-xl text-neutralDark">Pola Emosi Hari Ini</h2>
                        <p class="text-xs text-gray-400">Kamu berhasil mengidentifikasi 3 emosi. Ini adalah langkah besar!</p>
                    </div>
                    <div id="jrn-result-bars" class="space-y-4"></div>
                    <div class="bg-purple-50 border border-purple-200 rounded-2xl p-4 space-y-2">
                        <p class="text-xs font-bold text-purple-700 uppercase tracking-wider">💡 Insight Personalmu</p>
                        <p id="jrn-insight" class="text-sm text-purple-900 leading-relaxed"></p>
                    </div>
                    <div class="flex gap-3">
                        <button onclick="jrnRestart()" class="flex-1 border border-brand-200 text-brand-700 font-bold py-3 rounded-xl text-sm hover:bg-brand-50 transition">🔄 Coba Lagi</button>
                        <a href="/games" class="flex-1 bg-brand-600 text-white font-bold py-3 rounded-xl text-sm hover:bg-brand-700 transition text-center">← Game Lain</a>
                    </div>
                </div>

            </div>

            <!-- KANAN: Sidebar -->
            <div class="space-y-4">

                <!-- Manfaat klinis -->
                <div class="bg-white rounded-2xl border border-brand-100 p-5 shadow-sm space-y-3">
                    <h3 class="font-outfit font-bold text-neutralDark">🧠 Mengapa Ini Membantu?</h3>
                    <div class="space-y-3 text-xs text-gray-600 leading-relaxed">
                        <div class="flex gap-3"><span class="text-purple-500 text-base shrink-0">✦</span><p><strong>Emotional Labeling</strong> terbukti menurunkan aktivitas amygdala — bagian otak yang memproses ketakutan dan kecemasan.</p></div>
                        <div class="flex gap-3"><span class="text-purple-500 text-base shrink-0">✦</span><p>Memberi nama pada emosi (<em>affect labeling</em>) membantu korteks prefrontal mengambil alih kendali dari reaksi emosional.</p></div>
                        <div class="flex gap-3"><span class="text-purple-500 text-base shrink-0">✦</span><p>Teknik ini adalah inti dari <strong>DBT (Dialectical Behavior Therapy)</strong>, dikembangkan oleh Dr. Marsha Linehan untuk depresi dan BPD.</p></div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="bg-gradient-to-br from-purple-600 to-brand-700 rounded-2xl p-5 text-white space-y-3">
                    <h3 class="font-outfit font-bold">💜 Tips Setelah Bermain</h3>
                    <ul class="space-y-2 text-xs text-purple-100 leading-relaxed">
                        <li class="flex gap-2"><span>1.</span><span>Ceritakan satu emosi tadi kepada seseorang yang kamu percaya</span></li>
                        <li class="flex gap-2"><span>2.</span><span>Tulis ulang di buku harian — menulis tangan memperkuat pemrosesan emosi</span></li>
                        <li class="flex gap-2"><span>3.</span><span>Jika intensitas &gt;4, pertimbangkan untuk berbicara dengan konselor</span></li>
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
        const JRN_EMOTIONS = [
            {emoji:'\uD83D\uDE22',label:'Sedih',color:'#3b82f6'},
            {emoji:'\uD83D\uDE30',label:'Cemas',color:'#f59e0b'},
            {emoji:'\uD83D\uDE24',label:'Marah',color:'#ef4444'},
            {emoji:'\uD83D\uDE34',label:'Lelah',color:'#8b5cf6'},
            {emoji:'\uD83D\uDE15',label:'Bingung',color:'#6b7280'},
            {emoji:'\uD83D\uDE14',label:'Kesepian',color:'#ec4899'},
            {emoji:'\uD83D\uDE24',label:'Frustrasi',color:'#f97316'},
            {emoji:'\uD83D\uDE36',label:'Mati Rasa',color:'#94a3b8'},
            {emoji:'\uD83C\uDF31',label:'Harapan',color:'#22c55e'},
            {emoji:'\uD83D\uDE1F',label:'Khawatir',color:'#84cc16'}
        ];

        const JRN_INSIGHTS = {
            'Sedih':'Kesedihan adalah respons alami. Ijinkan dirimu merasakan ini sepenuhnya — menekan perasaan justru membuatnya lebih kuat.',
            'Cemas':'Kecemasan menandakan sesuatu yang penting bagimu. Coba teknik pernapasan 4-7-8: tarik 4 detik, tahan 7, hembuskan 8.',
            'Marah':'Marah sering datang dari ekspektasi yang tidak terpenuhi. Tanyakan: "Apa yang sebenarnya aku butuhkan saat ini?"',
            'Lelah':'Kelelahan adalah sinyal tubuh. Prioritaskan satu hal: tidur malam ini minimal 7 jam.',
            'Bingung':'Kejelasan datang dari action kecil. Tulis 3 hal paling penting yang perlu diselesaikan hari ini.',
            'Kesepian':'Hubungi satu orang yang kamu percaya hari ini — bahkan pesan singkat sudah bermakna.',
            'Frustrasi':'Frustrasi sering muncul dari hal di luar kendali. Tanyakan: "Apa yang bisa aku kontrol dari situasi ini?"',
            'Mati Rasa':'Mati rasa emosional bisa tanda otak butuh proteksi. Coba aktivitas fisik ringan 10 menit untuk membantu.',
            'Harapan':'Harapan adalah kekuatan besar. Tuliskan 1 langkah konkret kecil yang bisa kamu lakukan hari ini.',
            'Khawatir':'Kekhawatiran sering tentang masa depan yang belum terjadi. Fokuskan: apa yang bisa dilakukan SEKARANG?'
        };

        let jrnPool = [];
        let jrnSelected = [];
        let jrnCurrentEmotion = null;
        let jrnCurrentIntensity = 3;

        function jrnInit() {
            const data = JSON.parse(localStorage.getItem('soulkeep_games') || '{}');
            const today = new Date().toDateString();
            const todayEl = document.getElementById('jrn-sessions-today');
            const totalEl = document.getElementById('jrn-sessions-total');
            if (todayEl) todayEl.textContent = data.today_date === today ? (data.today_count || 0) : 0;
            if (totalEl) totalEl.textContent = data.total || 0;
            // user name
            const name = localStorage.getItem('soulkeep_name') || 'Pengguna';
            const el = document.getElementById('user-name');
            if (el) el.textContent = name;
            const av = document.getElementById('user-avatar');
            if (av) av.textContent = name[0].toUpperCase();
            jrnRestart();
        }

        function jrnRestart() {
            jrnPool = [...JRN_EMOTIONS].sort(() => Math.random() - 0.5).slice(0, 9);
            jrnSelected = [];
            jrnCurrentEmotion = null;
            jrnCurrentIntensity = 3;
            jrnUpdateProgress();
            jrnRenderPicker();
            document.getElementById('jrn-picker').classList.remove('hidden');
            document.getElementById('jrn-note-form').classList.add('hidden');
            document.getElementById('jrn-result').classList.add('hidden');
        }

        function jrnRenderPicker() {
            const grid = document.getElementById('jrn-emotion-grid');
            grid.innerHTML = jrnPool.map((e, i) => {
                const isUsed = jrnSelected.some(s => s.label === e.label);
                return `<button onclick="jrnPick(${i})" class="emotion-btn flex flex-col items-center gap-1.5 p-3 rounded-2xl border-2 transition ${
                    isUsed ? 'border-brand-400 bg-brand-50 used' : 'border-gray-200 bg-gray-50 hover:border-brand-400 hover:bg-brand-50'
                }">
                    <span class="text-3xl">${e.emoji}</span>
                    <span class="text-xs font-bold text-neutralDark">${e.label}</span>
                </button>`;
            }).join('');
        }

        function jrnPick(idx) {
            const emotion = jrnPool[idx];
            if (!emotion || jrnSelected.some(s => s.label === emotion.label)) return;
            jrnCurrentEmotion = { ...emotion, note: '', intensity: 3 };
            jrnCurrentIntensity = 3;
            document.getElementById('jrn-sel-emoji').textContent = emotion.emoji;
            document.getElementById('jrn-sel-label').textContent = emotion.label;
            document.getElementById('jrn-note').value = '';
            jrnSetIntensity(3);
            document.getElementById('jrn-picker').classList.add('hidden');
            document.getElementById('jrn-note-form').classList.remove('hidden');
            document.getElementById('jrn-note').focus();
        }

        function jrnBackToPicker() {
            document.getElementById('jrn-note-form').classList.add('hidden');
            document.getElementById('jrn-picker').classList.remove('hidden');
        }

        function jrnSetIntensity(val) {
            jrnCurrentIntensity = val;
            document.querySelectorAll('.intensity-btn').forEach(b => {
                b.classList.toggle('active', parseInt(b.dataset.val) === val);
            });
        }

        function jrnSaveNote() {
            if (!jrnCurrentEmotion) return;
            jrnCurrentEmotion.note = document.getElementById('jrn-note').value.trim() || '(tidak ada catatan)';
            jrnCurrentEmotion.intensity = jrnCurrentIntensity;
            jrnSelected.push(jrnCurrentEmotion);
            jrnUpdateProgress();
            if (jrnSelected.length < 3) {
                jrnRenderPicker();
                document.getElementById('jrn-note-form').classList.add('hidden');
                document.getElementById('jrn-picker').classList.remove('hidden');
            } else {
                jrnShowResult();
            }
        }

        function jrnUpdateProgress() {
            [1,2,3].forEach(i => {
                const el = document.getElementById(`jrn-p${i}`);
                if (el) el.style.background = i <= jrnSelected.length ? '#396696' : '#E4EDF7';
            });
            const txt = document.getElementById('jrn-progress-text');
            if (txt) txt.textContent = `${jrnSelected.length} dari 3 emosi dipilih`;
        }

        function jrnShowResult() {
            document.getElementById('jrn-picker').classList.add('hidden');
            document.getElementById('jrn-note-form').classList.add('hidden');
            document.getElementById('jrn-result').classList.remove('hidden');
            const dominant = jrnSelected.reduce((a, b) => a.intensity > b.intensity ? a : b);
            document.getElementById('jrn-result-bars').innerHTML = jrnSelected.map(e => `
                <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100">
                    <span class="text-3xl shrink-0">${e.emoji}</span>
                    <div class="flex-1">
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="font-bold text-neutralDark">${e.label}</span>
                            <span class="text-gray-400">Intensitas ${e.intensity}/5</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="h-2 rounded-full transition-all duration-700" style="width:${e.intensity*20}%;background:${e.color}"></div>
                        </div>
                        <p class="text-xs text-gray-500 italic">"${e.note}"</p>
                    </div>
                </div>`).join('');
            document.getElementById('jrn-insight').textContent =
                JRN_INSIGHTS[dominant.label] || 'Teruslah mengenali emosimu. Setiap kali kamu memberi nama pada perasaan, kamu mengambil sedikit kendali kembali.';
            // Record session
            const key = 'soulkeep_games';
            const data = JSON.parse(localStorage.getItem(key) || '{"total":0,"today_date":"","today_count":0}');
            const today = new Date().toDateString();
            data.total = (data.total || 0) + 1;
            data.today_count = data.today_date === today ? (data.today_count || 0) + 1 : 1;
            data.today_date = today;
            localStorage.setItem(key, JSON.stringify(data));
            const todayEl = document.getElementById('jrn-sessions-today');
            const totalEl = document.getElementById('jrn-sessions-total');
            if (todayEl) todayEl.textContent = data.today_count;
            if (totalEl) totalEl.textContent = data.total;
        }

        function logout() { localStorage.clear(); window.location.href = '/login'; }
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('main-nav');
            if (nav) nav.classList.toggle('scrolled', window.scrollY > 10);
        });
        window.addEventListener('DOMContentLoaded', jrnInit);
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
