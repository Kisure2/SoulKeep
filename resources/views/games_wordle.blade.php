<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SoulKeep — Wordle Jiwa: Tebak kata kesehatan mental dalam 6 percobaan. Melatih fokus dan cognitive distraction.">
    <meta name="theme-color" content="#396696">
    <title>Wordle Jiwa — SoulKeep</title>
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
        @keyframes shake { 0%,100%{transform:translateX(0)} 20%,60%{transform:translateX(-6px)} 40%,80%{transform:translateX(6px)} }
        @keyframes pop   { 0%{transform:scale(1)} 50%{transform:scale(1.15)} 100%{transform:scale(1)} }
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
        /* Wordle-specific */
        .tile { width:56px; height:56px; border:2px solid #E4EDF7; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:1.5rem; font-weight:800; font-family:'Outfit',sans-serif; transition:all .1s; text-transform:uppercase; background:#fff; }
        .tile.filled { border-color:#396696; background:#E4EDF7; transform:scale(1.05); }
        .tile.correct { background:#22c55e; border-color:#16a34a; color:#fff; }
        .tile.present { background:#f59e0b; border-color:#d97706; color:#fff; }
        .tile.absent  { background:#6b7280; border-color:#4b5563; color:#fff; }
        .shake { animation:shake .4s ease; }
        .pop   { animation:pop .15s ease; }
        .key-btn { min-width:36px; height:44px; border-radius:8px; border:none; font-weight:700; font-size:.8rem; cursor:pointer; transition:all .15s; background:#EDEEF5; color:#1E2229; }
        .key-btn:hover { background:#E4EDF7; }
        .key-btn.correct { background:#22c55e; color:#fff; }
        .key-btn.present { background:#f59e0b; color:#fff; }
        .key-btn.absent  { background:#9ca3af; color:#fff; }
        .key-btn.wide { min-width:56px; font-size:.7rem; }
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
            <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=1200&q=70" alt="hero wordle" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute -top-20 -right-20 w-64 h-64 shape-blob bg-white/5 shape-circle blob-anim hidden sm:block"></div>
            <div class="img-overlay"></div>
            <div class="relative z-10 h-full flex flex-col justify-between p-6 sm:p-8">
                <div class="flex items-center justify-between">
                    <a href="/games" class="text-white/70 text-xs hover:text-white font-semibold flex items-center gap-1 transition">← Kembali</a>
                    <span class="inline-flex items-center gap-2 text-xs font-bold bg-white/15 text-white px-4 py-1.5 rounded-full border border-white/30 backdrop-blur-sm">🟩 CBT · Cognitive Distraction</span>
                </div>
                <div class="space-y-2">
                    <h1 class="text-3xl sm:text-4xl font-outfit font-black text-white leading-tight">Wordle Jiwa</h1>
                    <p class="text-white/80 text-sm sm:text-base max-w-md leading-relaxed">Tebak kata kesehatan mental dalam 6 percobaan. Latih fokus, kalahkan kecemasan.</p>
                    <div class="flex gap-3 mt-3">
                        <div class="bg-white/15 backdrop-blur-sm border border-white/25 rounded-xl px-4 py-2 text-center">
                            <p class="text-xl font-outfit font-black text-white" id="wrd-stat-wins">0</p>
                            <p class="text-[9px] text-white/70 font-semibold">Menang</p>
                        </div>
                        <div class="bg-white/15 backdrop-blur-sm border border-white/25 rounded-xl px-4 py-2 text-center">
                            <p class="text-xl font-outfit font-black text-white" id="wrd-stat-total">0</p>
                            <p class="text-[9px] text-white/70 font-semibold">Total</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2-column layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- KIRI: Game area -->
            <div class="lg:col-span-2 space-y-4">

                <!-- Status bar -->
                <div class="bg-white rounded-2xl border border-brand-100 p-4 shadow-sm flex justify-between items-center">
                    <p class="text-sm font-bold text-neutralDark">Tebakan: <span id="wrd-row-display">1</span>/6</p>
                    <p id="wrd-message" class="text-sm font-bold text-brand-600 text-center flex-1 px-4"></p>
                    <button onclick="wrdNewGame()" class="px-3 py-1.5 bg-brand-50 hover:bg-brand-100 border border-brand-200 text-brand-700 text-xs font-bold rounded-lg transition-all">🔄 Baru</button>
                </div>

                <!-- Tile Grid -->
                <div class="bg-white rounded-2xl border border-brand-100 p-6 shadow-sm">
                    <div id="wrd-grid" class="space-y-2 flex flex-col items-center"></div>
                </div>

                <!-- Virtual Keyboard -->
                <div class="bg-white rounded-2xl border border-brand-100 p-4 shadow-sm">
                    <div class="space-y-2">
                        <div id="wrd-keyrow-0" class="flex justify-center gap-1.5"></div>
                        <div id="wrd-keyrow-1" class="flex justify-center gap-1.5"></div>
                        <div id="wrd-keyrow-2" class="flex justify-center gap-1.5"></div>
                    </div>
                </div>

            </div>

            <!-- KANAN: Sidebar -->
            <div class="space-y-4">

                <!-- Cara bermain -->
                <div class="bg-white rounded-2xl border border-brand-100 p-5 shadow-sm space-y-3">
                    <h3 class="font-outfit font-bold text-neutralDark">🎯 Cara Bermain</h3>
                    <div class="space-y-2 text-xs text-gray-600 leading-relaxed">
                        <div class="flex gap-2"><span class="font-bold text-brand-600 shrink-0">1.</span><p>Tebak kata <strong>5 huruf</strong> terkait kesehatan mental</p></div>
                        <div class="flex gap-2"><span class="font-bold text-brand-600 shrink-0">2.</span><p>Huruf <span class="bg-green-100 text-green-700 px-1 rounded font-bold">hijau</span> = tepat posisi. <span class="bg-yellow-100 text-yellow-700 px-1 rounded font-bold">Kuning</span> = ada tapi salah posisi</p></div>
                        <div class="flex gap-2"><span class="font-bold text-brand-600 shrink-0">3.</span><p>Kamu punya <strong>6 kesempatan</strong>. Gunakan keyboard atau klik huruf</p></div>
                    </div>
                    <div class="flex gap-2 text-xs">
                        <div class="w-8 h-8 rounded bg-green-500 text-white flex items-center justify-center font-bold">S</div>
                        <div class="w-8 h-8 rounded bg-yellow-500 text-white flex items-center justify-center font-bold">A</div>
                        <div class="w-8 h-8 rounded bg-gray-500 text-white flex items-center justify-center font-bold">B</div>
                        <p class="text-gray-400 self-center ml-1">Contoh tile</p>
                    </div>
                </div>

                <!-- Manfaat klinis -->
                <div class="bg-white rounded-2xl border border-brand-100 p-5 shadow-sm space-y-3">
                    <h3 class="font-outfit font-bold text-neutralDark">🧠 Manfaat Klinis</h3>
                    <div class="space-y-3 text-xs text-gray-600 leading-relaxed">
                        <div class="flex gap-3"><span class="text-green-500 text-base shrink-0">✦</span><p><strong>Cognitive Distraction</strong> adalah teknik CBT yang terbukti memutus siklus rumination (pikiran berputar) pada gangguan kecemasan.</p></div>
                        <div class="flex gap-3"><span class="text-green-500 text-base shrink-0">✦</span><p>Permainan kata melatih <strong>working memory</strong> dan meningkatkan konsentrasi — faktor penting dalam regulasi emosi.</p></div>
                        <div class="flex gap-3"><span class="text-green-500 text-base shrink-0">✦</span><p>Kata-kata positif memperkuat <strong>positive priming</strong> — efek paparan kata-kata baik pada mood secara bawah sadar.</p></div>
                    </div>
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
        const WRD_WORDS = ['DAMAI','SABAR','FOKUS','YAKIN','CERAH','PULIH','SEGAR','AKTIF','SEHAT','TEGAR','TABAH','CERIA','BEBAS'];
        const wrdDayIdx = Math.floor(Date.now() / 86400000) % WRD_WORDS.length;
        let wrdAnswer = WRD_WORDS[wrdDayIdx];
        let wrdCurrentRow = 0;
        let wrdCurrentCol = 0;
        let wrdBoard = Array(6).fill(null).map(() => Array(5).fill(''));
        let wrdGameOver = false;
        let wrdKeyStates = {};

        const WRD_MEANINGS = {
            'DAMAI':'Keadaan bebas dari gangguan dan kecemasan',
            'SABAR':'Mampu menunggu tanpa mengeluh',
            'FOKUS':'Memusatkan perhatian penuh',
            'YAKIN':'Percaya diri tanpa ragu',
            'CERAH':'Penuh harapan dan kegembiraan',
            'PULIH':'Kembali ke kondisi semula',
            'SEGAR':'Bebas dari kelelahan',
            'AKTIF':'Bergerak dengan penuh energi',
            'SEHAT':'Kondisi baik jasmani dan rohani',
            'TEGAR':'Kuat menghadapi kesulitan',
            'TABAH':'Sabar dalam penderitaan',
            'CERIA':'Gembira dan bersemangat',
            'BEBAS':'Tidak terikat atau tertekan'
        };

        function wrdInit() {
            const grid = document.getElementById('wrd-grid');
            grid.innerHTML = '';
            for (let r = 0; r < 6; r++) {
                const row = document.createElement('div');
                row.className = 'flex gap-2 justify-center';
                row.id = `wrd-row-${r}`;
                for (let c = 0; c < 5; c++) {
                    const tile = document.createElement('div');
                    tile.className = 'tile';
                    tile.id = `wrd-tile-${r}-${c}`;
                    row.appendChild(tile);
                }
                grid.appendChild(row);
            }
            wrdCurrentRow = 0; wrdCurrentCol = 0; wrdGameOver = false;
            wrdBoard = Array(6).fill(null).map(() => Array(5).fill(''));
            wrdKeyStates = {};
            wrdRenderKeys();
            document.getElementById('wrd-message').textContent = '';
            document.getElementById('wrd-row-display').textContent = '1';
            // Load stats
            const s = JSON.parse(localStorage.getItem('soulkeep_wordle') || '{"wins":0,"total":0}');
            const wEl = document.getElementById('wrd-stat-wins');
            const tEl = document.getElementById('wrd-stat-total');
            if (wEl) wEl.textContent = s.wins || 0;
            if (tEl) tEl.textContent = s.total || 0;
            // user
            const name = localStorage.getItem('soulkeep_name') || 'Pengguna';
            const el = document.getElementById('user-name');
            if (el) el.textContent = name;
            const av = document.getElementById('user-avatar');
            if (av) av.textContent = name[0].toUpperCase();
        }

        function wrdType(letter) {
            if (wrdGameOver || wrdCurrentCol >= 5) return;
            wrdBoard[wrdCurrentRow][wrdCurrentCol] = letter;
            const tile = document.getElementById(`wrd-tile-${wrdCurrentRow}-${wrdCurrentCol}`);
            tile.textContent = letter;
            tile.classList.add('filled');
            setTimeout(() => tile.classList.add('pop'), 0);
            wrdCurrentCol++;
        }

        function wrdDelete() {
            if (wrdCurrentCol <= 0) return;
            wrdCurrentCol--;
            wrdBoard[wrdCurrentRow][wrdCurrentCol] = '';
            const tile = document.getElementById(`wrd-tile-${wrdCurrentRow}-${wrdCurrentCol}`);
            tile.textContent = '';
            tile.classList.remove('filled','pop');
        }

        function wrdEnter() {
            if (wrdCurrentCol < 5) {
                wrdShakeRow(wrdCurrentRow);
                wrdShowMsg('Kata harus 5 huruf!');
                return;
            }
            const guess = wrdBoard[wrdCurrentRow].join('');
            wrdEvaluate(guess);
        }

        function wrdEvaluate(guess) {
            const answerArr = wrdAnswer.split('');
            const result = Array(5).fill('absent');
            const answerUsed = Array(5).fill(false);
            const guessUsed = Array(5).fill(false);
            for (let i = 0; i < 5; i++) {
                if (guess[i] === answerArr[i]) {
                    result[i] = 'correct'; answerUsed[i] = true; guessUsed[i] = true;
                }
            }
            for (let i = 0; i < 5; i++) {
                if (guessUsed[i]) continue;
                for (let j = 0; j < 5; j++) {
                    if (!answerUsed[j] && guess[i] === answerArr[j]) {
                        result[i] = 'present'; answerUsed[j] = true; break;
                    }
                }
            }
            result.forEach((r, i) => {
                setTimeout(() => {
                    const tile = document.getElementById(`wrd-tile-${wrdCurrentRow}-${i}`);
                    tile.classList.remove('filled','pop');
                    tile.classList.add(r);
                    const letter = guess[i];
                    const priority = {absent:0,present:1,correct:2};
                    if ((priority[r] || 0) > (priority[wrdKeyStates[letter]] || -1)) wrdKeyStates[letter] = r;
                }, i * 120);
            });
            setTimeout(() => {
                wrdRenderKeys();
                if (guess === wrdAnswer) {
                    wrdShowMsg('\uD83C\uDF89 Luar biasa! Kamu berhasil!');
                    wrdGameOver = true;
                    wrdRecordResult(true);
                    setTimeout(() => wrdShowMsg(`\u2728 "${wrdAnswer}" \u2014 ${WRD_MEANINGS[wrdAnswer] || ''}`), 1200);
                } else if (wrdCurrentRow >= 5) {
                    wrdShowMsg(`Jawabannya: ${wrdAnswer} \u2014 Jangan menyerah!`);
                    wrdGameOver = true;
                    wrdRecordResult(false);
                } else {
                    document.getElementById('wrd-row-display').textContent = wrdCurrentRow + 2;
                }
            }, 5 * 120 + 200);
            wrdCurrentRow++;
            wrdCurrentCol = 0;
        }

        function wrdShakeRow(r) {
            const row = document.getElementById(`wrd-row-${r}`);
            row.classList.add('shake');
            setTimeout(() => row.classList.remove('shake'), 400);
        }

        function wrdShowMsg(msg) {
            document.getElementById('wrd-message').textContent = msg;
        }

        function wrdRenderKeys() {
            const rows = [['Q','W','E','R','T','Y','U','I','O','P'],['A','S','D','F','G','H','J','K','L'],['ENT','Z','X','C','V','B','N','M','DEL']];
            rows.forEach((row, ri) => {
                const rowEl = document.getElementById(`wrd-keyrow-${ri}`);
                if (!rowEl) return;
                rowEl.innerHTML = row.map(k => {
                    const state = wrdKeyStates[k] || '';
                    const isWide = k === 'ENT' || k === 'DEL';
                    return `<button onclick="wrdKeyPress('${k}')" class="key-btn ${isWide?'wide':''} ${state}">${k}</button>`;
                }).join('');
            });
        }

        function wrdKeyPress(k) {
            if (k === 'ENT') wrdEnter();
            else if (k === 'DEL') wrdDelete();
            else wrdType(k);
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Enter') wrdEnter();
            else if (e.key === 'Backspace') wrdDelete();
            else if (/^[a-zA-Z]$/.test(e.key)) wrdType(e.key.toUpperCase());
        });

        function wrdRecordResult(won) {
            const key = 'soulkeep_wordle';
            const s = JSON.parse(localStorage.getItem(key) || '{"wins":0,"total":0}');
            s.total = (s.total || 0) + 1;
            if (won) s.wins = (s.wins || 0) + 1;
            localStorage.setItem(key, JSON.stringify(s));
            const wEl = document.getElementById('wrd-stat-wins');
            const tEl = document.getElementById('wrd-stat-total');
            if (wEl) wEl.textContent = s.wins;
            if (tEl) tEl.textContent = s.total;
            const gd = JSON.parse(localStorage.getItem('soulkeep_games') || '{"total":0,"today_date":"","today_count":0}');
            const today = new Date().toDateString();
            gd.total = (gd.total || 0) + 1;
            gd.today_count = gd.today_date === today ? (gd.today_count || 0) + 1 : 1;
            gd.today_date = today;
            localStorage.setItem('soulkeep_games', JSON.stringify(gd));
        }

        function wrdNewGame() {
            wrdAnswer = WRD_WORDS[Math.floor(Math.random() * WRD_WORDS.length)];
            wrdInit();
        }

        function logout() { localStorage.clear(); window.location.href = '/login'; }
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('main-nav');
            if (nav) nav.classList.toggle('scrolled', window.scrollY > 10);
        });
        window.addEventListener('DOMContentLoaded', wrdInit);
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
