<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SoulKeep Games — Terapi Lewat Permainan berbasis CBT &amp; DBT untuk kesehatan mental mahasiswa.">
    <title>Terapi Game — SoulKeep</title>
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
        @keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }
        .skeleton { background: linear-gradient(90deg, #E4EDF7 25%, #D4E5F3 50%, #E4EDF7 75%); background-size: 200% 100%; animation: shimmer 1.4s infinite; }
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
        /* Game card extras */
        .game-card { transition: all 0.3s ease; }
        .game-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px -8px rgba(57,102,150,0.15); }
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
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 sm:py-8 space-y-6 pb-20 md:pb-8">

        <!-- Hero Section -->
        <div class="relative overflow-hidden rounded-2xl mb-8 h-[260px] sm:h-[300px] fade-up fade-up-d1">
            <img src="https://images.unsplash.com/photo-1614680376573-df3480f0c6ff?w=1200&q=70" alt="hero games" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute -top-20 -right-20 w-64 h-64 shape-blob bg-white/5 shape-circle blob-anim hidden sm:block"></div>
            <div class="img-overlay"></div>
            <div class="relative z-10 h-full flex flex-col justify-between p-6 sm:p-8">
                <div>
                    <span class="inline-flex items-center gap-2 text-xs font-bold bg-white/15 text-white px-4 py-1.5 rounded-full border border-white/30 backdrop-blur-sm">🎮 Terapi Berbasis Game</span>
                </div>
                <div class="space-y-2">
                    <h1 class="text-3xl sm:text-4xl font-outfit font-black text-white leading-tight">Terapi Lewat Permainan</h1>
                    <p class="text-white/80 text-sm sm:text-base max-w-md leading-relaxed">3 permainan berbasis teknik terapi klinis untuk kesehatan mental sehari-hari.</p>
                </div>
            </div>
        </div>

        <!-- 3 Game Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Kartu 1: Jurnal Rasa -->
            <div class="group cursor-pointer rounded-2xl overflow-hidden border border-[#E4EDF7] hover:shadow-xl transition-all duration-300">
                <div class="h-1.5 bg-gradient-to-r from-[#8B5CF6] via-[#A78BFA] to-[#396696]"></div>
                <div class="p-6 bg-white space-y-4">
                    <div class="flex justify-between items-start">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#EDE9FE] to-[#DDD6FE] flex items-center justify-center text-3xl">
                            🃏
                        </div>
                        <span class="text-[10px] bg-purple-50 text-purple-700 border border-purple-200 px-3 py-1 rounded-full font-bold">Depresi · Mati Rasa</span>
                    </div>
                    <div>
                        <h3 class="font-outfit font-bold text-lg text-[#1E2229]">Jurnal Rasa</h3>
                        <p class="text-xs text-[#64748b] mt-1 leading-relaxed">Identifikasi dan beri nama pada emosi yang kamu rasakan. Pilih 3 emosi, tulis ceritanya, ukur intensitasnya.</p>
                    </div>
                    <div class="pt-3 border-t border-[#E4EDF7] flex items-center justify-between">
                        <span class="text-xs text-[#94a3b8]">⏱ ~7 min · DBT</span>
                        <button onclick="window.location.href='/games/jurnal'" class="text-xs font-bold bg-[#396696] text-white px-4 py-1.5 rounded-lg hover:bg-[#2E5178] transition-all">▶ Mainkan</button>
                    </div>
                </div>
            </div>

            <!-- Kartu 2: Wordle Jiwa -->
            <div class="group cursor-pointer rounded-2xl overflow-hidden border border-[#E4EDF7] hover:shadow-xl transition-all duration-300">
                <div class="h-1.5 bg-gradient-to-r from-[#10B981] via-[#34D399] to-[#396696]"></div>
                <div class="p-6 bg-white space-y-4">
                    <div class="flex justify-between items-start">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#D1FAE5] to-[#A7F3D0] flex items-center justify-center text-3xl">
                            🟩
                        </div>
                        <span class="text-[10px] bg-green-50 text-green-700 border border-green-200 px-3 py-1 rounded-full font-bold">Fokus · Kecemasan</span>
                    </div>
                    <div>
                        <h3 class="font-outfit font-bold text-lg text-[#1E2229]">Wordle Jiwa</h3>
                        <p class="text-xs text-[#64748b] mt-1 leading-relaxed">Tebak kata kesehatan mental dalam 6 percobaan. Melatih fokus dan mengalihkan pikiran negatif melalui permainan kata.</p>
                    </div>
                    <div class="pt-3 border-t border-[#E4EDF7] flex items-center justify-between">
                        <span class="text-xs text-[#94a3b8]">⏱ ~5 min · CBT</span>
                        <button onclick="window.location.href='/games/wordle'" class="text-xs font-bold bg-[#396696] text-white px-4 py-1.5 rounded-lg hover:bg-[#2E5178] transition-all">▶ Mainkan</button>
                    </div>
                </div>
            </div>

            <!-- Kartu 3: Puzzle Pikiran -->
            <div class="group cursor-pointer rounded-2xl overflow-hidden border border-[#E4EDF7] hover:shadow-xl transition-all duration-300">
                <div class="h-1.5 bg-gradient-to-r from-[#F59E0B] via-[#FBBF24] to-[#396696]"></div>
                <div class="p-6 bg-white space-y-4">
                    <div class="flex justify-between items-start">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#FEF3C7] to-[#FDE68A] flex items-center justify-center text-3xl">
                            🧩
                        </div>
                        <span class="text-[10px] bg-amber-50 text-amber-700 border border-amber-200 px-3 py-1 rounded-full font-bold">Overthinking · Stres</span>
                    </div>
                    <div>
                        <h3 class="font-outfit font-bold text-lg text-[#1E2229]">Puzzle Pikiran</h3>
                        <p class="text-xs text-[#64748b] mt-1 leading-relaxed">Susun ulang kepingan kalimat positif yang teracak. Melatih reframing pikiran negatif melalui aktivitas menyusun kata.</p>
                    </div>
                    <div class="pt-3 border-t border-[#E4EDF7] flex items-center justify-between">
                        <span class="text-xs text-[#94a3b8]">⏱ ~5 min · CBT</span>
                        <button onclick="window.location.href='/games/puzzle'" class="text-xs font-bold bg-[#396696] text-white px-4 py-1.5 rounded-lg hover:bg-[#2E5178] transition-all">▶ Mainkan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info klinis -->
        <div class="rounded-2xl border border-[#E4EDF7] bg-gradient-to-br from-white to-[#F4F7FB] p-5 space-y-3">
            <h3 class="font-outfit font-bold text-[#1E2229] flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-[#396696] text-white flex items-center justify-center text-sm">🧠</span>
                Catatan Klinis Penting
            </h3>
            <p class="text-xs text-[#64748b] leading-relaxed">⚠️ Permainan ini adalah alat bantu mandiri berbasis teknik terapi yang sudah terbukti secara ilmiah. Bukan pengganti konsultasi dengan psikolog atau psikiater profesional. Jika gejala memburuk, segera hubungi <a href="/nearby" class="font-bold text-[#396696] underline">psikolog terdekat</a> atau layanan darurat <strong>119 ext 8</strong>.</p>
        </div>

    </main>

    <!-- Mobile Bottom Nav -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 border-t border-[#E4EDF7] bg-white/95 backdrop-blur-sm">
        <div class="flex justify-around h-16 items-center px-1">
            <a href="/dashboard"  class="mob-nav-item"><span class="text-xl">🏠</span><span class="text-[8px] font-bold mt-0.5">Home</span></a>
            <a href="/assessment" class="mob-nav-item"><span class="text-xl">📝</span><span class="text-[8px] font-bold mt-0.5">Tes</span></a>
            <a href="/games"      class="mob-nav-item active"><span class="text-xl">🎮</span><span class="text-[8px] font-bold mt-0.5">Game</span></a>
            <a href="/nearby"     class="mob-nav-item"><span class="text-xl">📍</span><span class="text-[8px] font-bold mt-0.5">Psikolog</span></a>
            <a href="/relaxation" class="mob-nav-item"><span class="text-xl">🌬️</span><span class="text-[8px] font-bold mt-0.5">Napas</span></a>
        </div>
    </nav>

    <!-- ==================== SCRIPTS ==================== -->
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const data = JSON.parse(localStorage.getItem('soulkeep_games') || '{"total":0,"today_count":0}');
            const todayEl = document.getElementById('games-today');
            const totalEl = document.getElementById('games-total');
            if (todayEl) todayEl.textContent = data.today_count || 0;
            if (totalEl) totalEl.textContent = data.total || 0;
            const name = localStorage.getItem('soulkeep_name') || 'Pengguna';
            const el = document.getElementById('user-name');
            if (el) el.textContent = name;
            const av = document.getElementById('user-avatar');
            if (av) av.textContent = name[0].toUpperCase();
        });
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('main-nav');
            if (nav) nav.classList.toggle('scrolled', window.scrollY > 10);
        });
        function logout() { localStorage.clear(); window.location.href = '/login'; }
    </script>
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
</body>
</html>
