<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SoulKeep — Terapi Relaksasi & Regulasi Mandiri. Box Breathing, 4-7-8, Grounding. Mendukung UN SDG 3.">
    <meta name="theme-color" content="#396696">
    <title>Terapi Regulasi Mandiri Aktif — SoulKeep</title>
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
                        brand: { 50:'#F4F7FB', 100:'#E4EDF7', 200:'#C7DCEF', 300:'#9CBEDF', 400:'#6E9DCC', 500:'#4B81B7', 600:'#396696', 700:'#2E5178', 850:'#203853', 900:'#17293D' },
                        neutralDark: '#1E2229',
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
        /* Relaxation-specific */
        .breathing-circle { transition:transform 4s cubic-bezier(0.4,0,0.2,1); }
        .inhale { transform:scale(1.6); }
        .hold-large { transform:scale(1.6); }
        .exhale { transform:scale(0.9); }
        .hold-small { transform:scale(0.9); }
        .technique-btn { transition:all .2s; border-radius:14px; font-weight:700; font-size:.8125rem; padding:.5rem 1rem; border:1.5px solid #E4EDF7; background:#fff; color:#94a3b8; cursor:pointer; }
        .technique-btn.active { background:#396696; color:#fff; border-color:#396696; box-shadow:0 4px 16px rgba(57,102,150,0.3); }
        .technique-btn:not(.active):hover { background:#F4F7FB; color:#1E2229; }
        .tab-btn { transition:all .2s; border-radius:10px; font-weight:700; font-size:.8125rem; padding:.5rem 1rem; border:none; cursor:pointer; color:#94a3b8; background:transparent; }
        .tab-btn.active { background:#396696; color:#fff; box-shadow:0 2px 8px rgba(57,102,150,0.25); }
        /* === VISUAL UPGRADE === */
        @keyframes blobMove { 0%,100%{border-radius:60% 40% 30% 70%/60% 30% 70% 40%} 50%{border-radius:30% 60% 70% 40%/50% 60% 30% 60%} }
        .blob-anim { animation: blobMove 12s ease-in-out infinite; }
        .blob-delay-1 { animation-delay: 3s; }
        .blob-delay-2 { animation-delay: 6s; }
        .img-overlay { position: absolute; inset: 0; background: linear-gradient(180deg, transparent 0%, rgba(30,34,41,0.65) 100%); }
        .icon-box { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .shape-circle { border-radius: 50%; position: absolute; opacity: 0.5; filter: blur(40px); pointer-events: none; }
        .shape-blob { position: absolute; filter: blur(60px); pointer-events: none; }
    </style>
</head>
<body class="min-h-screen flex flex-col" style="background:#F4F7FB;color:#1E2229">

    <script>
        if (!localStorage.getItem('soulkeep_token')) window.location.href = '/login';
    </script>

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
                <a href="/relaxation" class="nav-item active px-3 py-2 text-sm font-semibold">🌬️ Relaksasi</a>
                <a href="/games"      class="nav-item px-3 py-2 text-sm font-semibold">🎮 Terapi Game</a>
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

    <!-- Mobile Bottom Nav -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 border-t border-[#E4EDF7] bg-white/95 backdrop-blur-sm">
        <div class="flex justify-around h-16 items-center px-1">
            <a href="/dashboard"  class="mob-nav-item"><span class="text-xl">🏠</span><span class="text-[8px] font-bold mt-0.5">Home</span></a>
            <a href="/assessment" class="mob-nav-item"><span class="text-xl">📝</span><span class="text-[8px] font-bold mt-0.5">Tes</span></a>
            <a href="/games"      class="mob-nav-item"><span class="text-xl">🎮</span><span class="text-[8px] font-bold mt-0.5">Game</span></a>
            <a href="/nearby"     class="mob-nav-item"><span class="text-xl">📍</span><span class="text-[8px] font-bold mt-0.5">Psikolog</span></a>
            <a href="/relaxation" class="mob-nav-item active"><span class="text-xl">🌬️</span><span class="text-[8px] font-bold mt-0.5">Napas</span></a>
        </div>
    </nav>

    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 sm:py-8 pb-20 md:pb-8">

        <!-- Hero Section -->
        <div class="relative overflow-hidden rounded-2xl mb-8 h-[260px] sm:h-[300px] fade-up fade-up-d1">
            <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1200&q=70" alt="hero relaxation" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute -top-20 -right-20 w-64 h-64 shape-blob bg-white/5 shape-circle blob-anim hidden sm:block"></div>
            <div class="img-overlay"></div>
            <div class="relative z-10 h-full flex flex-col justify-between p-6 sm:p-8">
                <div>
                    <span class="inline-flex items-center gap-2 text-xs font-bold bg-white/15 text-white px-4 py-1.5 rounded-full border border-white/30 backdrop-blur-sm">🌬️ Mindfulness & Relaksasi</span>
                </div>
                <div class="space-y-2">
                    <h1 class="text-3xl sm:text-4xl font-outfit font-black text-white leading-tight">Pusat Relaksasi</h1>
                    <p class="text-white/80 text-sm sm:text-base max-w-md leading-relaxed">Latihan pernapasan dan grounding untuk pertolongan pertama kecemasan.</p>
                </div>
            </div>
        </div>

        <!-- Breathing Panel -->
        <div class="w-full bg-white rounded-3xl border border-brand-100 p-6 shadow-xl shadow-brand-100/10 mb-6 space-y-6 text-center">
            <div class="space-y-1">
                <span class="inline-block bg-brand-50 text-brand-700 text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-full border border-brand-100">
                    Target UN SDG 3 — Regulasi Emosi Aktif
                </span>
                <h1 class="text-2xl sm:text-3xl font-outfit font-extrabold text-neutralDark">Pusat Terapi & Regulasi Mandiri</h1>
                <p class="text-xs text-neutralDark/50 max-w-lg mx-auto leading-relaxed">
                    Sistem pertolongan pertama kecemasan kampus. Latihan pernapasan taktis atau grounding 5-4-3-2-1.
                </p>
            </div>

            <!-- Session Tracker -->
            <div class="flex items-center justify-center gap-4 flex-wrap">
                <div class="flex items-center gap-2 px-4 py-2 bg-brand-50 rounded-xl border border-brand-100 text-xs font-bold text-brand-700">
                    <span>🌬️</span>
                    <span>Sesi hari ini: <strong id="sessions-today">0</strong></span>
                </div>
                <div class="flex items-center gap-2 px-4 py-2 bg-brand-50 rounded-xl border border-brand-100 text-xs font-bold text-brand-700">
                    <span>🏆</span>
                    <span>Total sesi: <strong id="sessions-total">0</strong></span>
                </div>
            </div>

            <!-- Web Audio Calming Sound -->
            <div class="p-5 bg-brand-50/50 rounded-2xl border border-brand-100/50 max-w-xl mx-auto space-y-4">
                <div class="text-left">
                    <span class="block text-xs font-bold text-brand-850">🎵 Terapi Frekuensi Suara Penenang</span>
                    <span class="text-[9px] text-neutralDark/50 block">Disintesis alami oleh browser untuk menenangkan saraf kognitif.</span>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <label class="p-2.5 bg-white border border-brand-100 rounded-xl flex flex-col items-center justify-center cursor-pointer text-center hover:border-brand-300 transition relative">
                        <input type="radio" name="sound-type" value="delta" checked class="absolute top-2 right-2 accent-brand-600 scale-90">
                        <span class="text-lg">🧘</span>
                        <span class="text-[9px] font-bold text-neutralDark mt-1">Delta 85Hz</span>
                        <span class="text-[7px] text-neutralDark/40">Grounding</span>
                    </label>
                    <label class="p-2.5 bg-white border border-brand-100 rounded-xl flex flex-col items-center justify-center cursor-pointer text-center hover:border-brand-300 transition relative">
                        <input type="radio" name="sound-type" value="solfeggio" class="absolute top-2 right-2 accent-brand-600 scale-90">
                        <span class="text-lg">✨</span>
                        <span class="text-[9px] font-bold text-neutralDark mt-1">528Hz</span>
                        <span class="text-[7px] text-neutralDark/40">Fokus & Damai</span>
                    </label>
                    <label class="p-2.5 bg-white border border-brand-100 rounded-xl flex flex-col items-center justify-center cursor-pointer text-center hover:border-brand-300 transition relative">
                        <input type="radio" name="sound-type" value="rain" class="absolute top-2 right-2 accent-brand-600 scale-90">
                        <span class="text-lg">🌧️</span>
                        <span class="text-[9px] font-bold text-neutralDark mt-1">Derau Hujan</span>
                        <span class="text-[7px] text-neutralDark/40">Isolasi Bising</span>
                    </label>
                </div>
                <div class="flex items-center justify-between border-t border-brand-100 pt-3">
                    <span id="ambient-status" class="text-[9px] font-bold text-neutralDark/50 uppercase">Status: Suara Mati</span>
                    <button onclick="toggleAmbientSound()" id="sound-btn"
                        class="px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl shadow-sm transition-all flex items-center gap-1.5">
                        <span id="sound-icon">🔊</span> <span id="sound-text">Mulai Suara Alam</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Tab Selector -->
        <div class="w-full max-w-md bg-white/70 backdrop-blur-md rounded-2xl border border-brand-100 p-1.5 flex gap-2 mb-6 shadow-sm">
            <button onclick="switchTab('breathing')" id="tab-breathing"
                class="tab-btn flex-1 py-3 text-xs font-bold rounded-xl transition flex items-center justify-center gap-1.5 active">
                🌬️ Latihan Napas
            </button>
            <button onclick="switchTab('grounding')" id="tab-grounding"
                class="tab-btn flex-1 py-3 text-xs font-bold rounded-xl transition flex items-center justify-center gap-1.5 text-neutralDark/60">
                🧘 Grounding 5-4-3-2-1
            </button>
        </div>

        <!-- Breathing Arena -->
        <div id="breathing-arena" class="w-full bg-white rounded-3xl border border-brand-100 p-6 sm:p-10 shadow-xl shadow-brand-100/20 flex flex-col items-center min-h-[440px]">

            <!-- Technique Selector -->
            <div class="w-full mb-6">
                <p class="text-xs font-bold text-neutralDark/50 uppercase tracking-wider text-center mb-3">Pilih Teknik Pernapasan</p>
                <div class="grid grid-cols-3 gap-2">
                    <button onclick="selectTechnique('box')" id="tech-box"
                        class="technique-btn active px-2 py-3 rounded-xl border border-brand-100 text-center">
                        <div class="text-lg mb-1">⬜</div>
                        <div class="text-[9px] font-bold">Box Breathing</div>
                        <div class="text-[8px] text-current opacity-70">4-4-4-4</div>
                    </button>
                    <button onclick="selectTechnique('478')" id="tech-478"
                        class="technique-btn px-2 py-3 rounded-xl border border-brand-100 text-center text-neutralDark/70">
                        <div class="text-lg mb-1">🌙</div>
                        <div class="text-[9px] font-bold">4-7-8 Method</div>
                        <div class="text-[8px] opacity-70">Tidur Lebih Mudah</div>
                    </button>
                    <button onclick="selectTechnique('21')" id="tech-21"
                        class="technique-btn px-2 py-3 rounded-xl border border-brand-100 text-center text-neutralDark/70">
                        <div class="text-lg mb-1">🌊</div>
                        <div class="text-[9px] font-bold">2:1 Breathing</div>
                        <div class="text-[8px] opacity-70">Relaksasi Cepat</div>
                    </button>
                </div>
            </div>

            <!-- Breathing Circle -->
            <div class="relative w-64 h-64 flex items-center justify-center">
                <div class="absolute inset-0 rounded-full bg-brand-100/35 border border-brand-200/55 animate-ping duration-1000"></div>
                <div id="breathing-bubble" class="breathing-circle w-36 h-36 rounded-full bg-gradient-to-tr from-brand-400 to-purple-200 border-2 border-brand-500 shadow-2xl flex items-center justify-center scale-90">
                    <div class="w-28 h-28 rounded-full bg-white/70 backdrop-blur-sm flex items-center justify-center">
                        <span id="countdown" class="text-4xl font-outfit font-extrabold text-brand-700">4</span>
                    </div>
                </div>
            </div>

            <div class="mt-8 space-y-2 text-center">
                <h3 id="instruction" class="text-xl sm:text-2xl font-outfit font-bold text-brand-700 tracking-tight">Siap Memulai... ✨</h3>
                <p id="state-desc" class="text-xs text-neutralDark/50">Pilih teknik dan tekan Mulai Latihan.</p>
            </div>

            <div class="flex gap-3 mt-6">
                <button onclick="startBreathing()" id="play-btn"
                    class="px-8 py-3.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-bold rounded-xl shadow-md transition-all flex items-center gap-2">
                    <span>▶️</span> Mulai Latihan
                </button>
                <button onclick="resetBreathing()"
                    class="px-6 py-3.5 border-2 border-brand-200 text-brand-700 hover:bg-brand-50 transition text-sm font-bold rounded-xl">
                    Reset
                </button>
            </div>

            <div class="mt-5 text-[10px] text-neutralDark/40 font-bold uppercase tracking-widest flex items-center gap-2">
                <span>🔄 Siklus Ke:</span>
                <span id="cycle-count" class="bg-brand-100 text-brand-850 px-2 py-0.5 rounded">0</span>
            </div>
        </div>

        <!-- Grounding Arena (Hidden) -->
        <div id="grounding-arena" class="w-full bg-white rounded-3xl border border-brand-100 p-6 sm:p-10 shadow-xl shadow-brand-100/20 hidden min-h-[420px] flex flex-col justify-between">
            <div class="space-y-4" id="grounding-form">
                <div class="flex justify-between items-center text-xs font-bold text-neutralDark/40">
                    <span id="grounding-step-title">LANGKAH 5: 👁️ APA SAJA YANG KAMU LIHAT?</span>
                    <span id="grounding-step-indicator">Langkah 1 dari 5</span>
                </div>
                <div class="w-full bg-brand-100 h-1.5 rounded-full overflow-hidden">
                    <div id="grounding-progress" class="bg-brand-600 h-full transition-all duration-300" style="width:20%"></div>
                </div>
                <div class="space-y-2 pt-2">
                    <h3 id="grounding-question-text" class="text-base sm:text-lg font-outfit font-extrabold text-neutralDark leading-relaxed">
                        Tuliskan 5 benda yang kamu lihat sekarang di sekelilingmu.
                    </h3>
                    <p id="grounding-help" class="text-[10px] text-neutralDark/50 leading-relaxed">
                        Metode Grounding klinis mengalihkan fokus kepanikan ke panca indera fisik secara bertahap.
                    </p>
                </div>
                <div class="pt-2">
                    <textarea id="grounding-input" rows="3"
                        class="w-full bg-brand-50/50 border border-brand-100 focus:border-brand-400 focus:bg-white rounded-2xl px-4 py-3 text-xs focus:outline-none transition resize-none font-medium"
                        placeholder="Contoh: Layar laptop, cangkir teh, jendela kamar..."></textarea>
                </div>
            </div>
            <div id="grounding-finish" class="hidden text-center py-8 space-y-4 my-auto">
                <span class="text-5xl">🧘</span>
                <h3 class="text-xl font-outfit font-extrabold text-brand-700">Pertolongan Pertama Selesai</h3>
                <p class="text-xs text-neutralDark/65 leading-relaxed max-w-md mx-auto">
                    Hebat! Kamu telah berhasil melakukan regulasi kecemasanmu dengan mengembalikan fokus otak ke realitas sekitar.
                </p>
                <div class="p-4 bg-brand-50 rounded-2xl border border-brand-100 text-[10px] text-brand-900 leading-relaxed max-w-sm mx-auto">
                    💡 <strong>Afirmasi:</strong> "Saya aman di sini, sekarang. Saya telah berusaha sekuat tenaga, dan saya mampu menghadapi ini."
                </div>
                <button onclick="resetGrounding()" class="text-xs font-bold text-neutralDark/50 hover:text-brand-600 transition underline">
                    🔄 Ulangi Metode Grounding
                </button>
            </div>
            <div class="flex justify-between items-center border-t border-brand-50 pt-4 mt-6">
                <button onclick="prevGroundingStep()" id="grounding-prev-btn" disabled
                    class="px-4 py-2 text-xs font-bold text-neutralDark/40 border border-transparent rounded-lg hover:bg-brand-50 transition disabled:opacity-40 disabled:hover:bg-transparent">
                    ← Kembali
                </button>
                <button onclick="nextGroundingStep()" id="grounding-next-btn"
                    class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl shadow-md transition-all">
                    Selanjutnya →
                </button>
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

    <script>
        // ==============================================
        // SESSION TRACKER
        // ==============================================
        function loadSessionStats() {
            const today = new Date().toDateString();
            const sessions = JSON.parse(localStorage.getItem('relaxation_sessions') || '{}');
            const todayCount = sessions[today] || 0;
            const totalCount = Object.values(sessions).reduce((a, b) => a + b, 0);
            document.getElementById('sessions-today').textContent = todayCount;
            document.getElementById('sessions-total').textContent = totalCount;
        }

        function recordSession() {
            const today = new Date().toDateString();
            const sessions = JSON.parse(localStorage.getItem('relaxation_sessions') || '{}');
            sessions[today] = (sessions[today] || 0) + 1;
            localStorage.setItem('relaxation_sessions', JSON.stringify(sessions));
            loadSessionStats();
        }

        loadSessionStats();

        // ==============================================
        // TAB SWITCHING
        // ==============================================
        function switchTab(tab) {
            const tabBreathing = document.getElementById('tab-breathing');
            const tabGrounding = document.getElementById('tab-grounding');
            const breathingArena = document.getElementById('breathing-arena');
            const groundingArena = document.getElementById('grounding-arena');

            if (tab === 'breathing') {
                tabBreathing.classList.add('active'); tabBreathing.classList.remove('text-neutralDark/60');
                tabGrounding.classList.remove('active'); tabGrounding.classList.add('text-neutralDark/60');
                breathingArena.classList.remove('hidden');
                groundingArena.classList.add('hidden');
                resetGrounding();
            } else {
                tabGrounding.classList.add('active'); tabGrounding.classList.remove('text-neutralDark/60');
                tabBreathing.classList.remove('active'); tabBreathing.classList.add('text-neutralDark/60');
                groundingArena.classList.remove('hidden');
                breathingArena.classList.add('hidden');
                resetBreathing();
            }
        }

        // ==============================================
        // TECHNIQUE DEFINITIONS
        // ==============================================
        const techniques = {
            box: {
                name: 'Box Breathing',
                states: [
                    { class:'inhale', text:'Tarik Napas... 🌬️', desc:'Tarik napas selama 4 detik, isi paru-parumu.', duration:4 },
                    { class:'hold-large', text:'Tahan Napas... ⚓', desc:'Tahan udara di paru-parumu selama 4 detik.', duration:4 },
                    { class:'exhale', text:'Hembuskan Napas... 💨', desc:'Keluarkan napas perlahan selama 4 detik.', duration:4 },
                    { class:'hold-small', text:'Tahan... 🧘', desc:'Tahan kosong selama 4 detik sebelum mulai lagi.', duration:4 },
                ]
            },
            '478': {
                name: '4-7-8 Method',
                states: [
                    { class:'inhale', text:'Tarik Napas... 🌬️', desc:'Tarik napas dalam selama 4 detik.', duration:4 },
                    { class:'hold-large', text:'Tahan Napas... ⚓', desc:'Tahan napas selama 7 detik penuh.', duration:7 },
                    { class:'exhale', text:'Hembuskan Napas... 💨', desc:'Hembuskan perlahan selama 8 detik penuh.', duration:8 },
                ]
            },
            '21': {
                name: '2:1 Breathing',
                states: [
                    { class:'inhale', text:'Tarik Napas... 🌬️', desc:'Tarik napas selama 4 detik.', duration:4 },
                    { class:'exhale', text:'Hembuskan Napas... 💨', desc:'Hembuskan perlahan selama 8 detik (dua kali lipat).', duration:8 },
                ]
            }
        };

        let currentTechnique = 'box';
        let state = 0;
        let timer = null;
        let count = 4;
        let cycleCount = 0;
        let isRunning = false;

        const bubble = document.getElementById('breathing-bubble');
        const countdownText = document.getElementById('countdown');
        const instructionText = document.getElementById('instruction');
        const stateDescText = document.getElementById('state-desc');
        const cycleText = document.getElementById('cycle-count');
        const playBtn = document.getElementById('play-btn');

        function selectTechnique(techKey) {
            resetBreathing();
            currentTechnique = techKey;
            ['box', '478', '21'].forEach(k => {
                const btn = document.getElementById(`tech-${k}`);
                if (k === techKey) {
                    btn.classList.add('active');
                    btn.classList.remove('text-neutralDark/70');
                } else {
                    btn.classList.remove('active');
                    btn.classList.add('text-neutralDark/70');
                }
            });
            const tech = techniques[techKey];
            count = tech.states[0].duration;
            countdownText.textContent = count;
            instructionText.textContent = `${tech.name} siap... ✨`;
            stateDescText.textContent = `Pilih teknik ${tech.name} dan tekan Mulai.`;
        }

        function startBreathing() {
            if (isRunning) {
                clearInterval(timer);
                isRunning = false;
                playBtn.innerHTML = '<span>▶️</span> Lanjutkan Latihan';
                instructionText.textContent = 'Latihan Dijeda ⏸️';
                stateDescText.textContent = 'Tekan lanjutkan untuk meneruskan terapi.';
            } else {
                isRunning = true;
                playBtn.innerHTML = '<span>⏸️</span> Jeda Latihan';
                runCycleStep();
                timer = setInterval(countdownTick, 1000);
            }
        }

        function resetBreathing() {
            clearInterval(timer);
            isRunning = false;
            state = 0;
            count = techniques[currentTechnique].states[0].duration;
            cycleCount = 0;
            cycleText.textContent = '0';
            countdownText.textContent = count;
            playBtn.innerHTML = '<span>▶️</span> Mulai Latihan';
            instructionText.textContent = 'Siap Memulai Terapi... ✨';
            stateDescText.textContent = 'Pilih teknik dan tekan Mulai Latihan.';
            bubble.className = 'breathing-circle w-36 h-36 rounded-full bg-gradient-to-tr from-brand-400 to-purple-200 border-2 border-brand-500 shadow-2xl flex items-center justify-center scale-90';
        }

        function runCycleStep() {
            const tech = techniques[currentTechnique];
            const config = tech.states[state];
            bubble.className = `breathing-circle w-36 h-36 rounded-full bg-gradient-to-tr from-brand-400 to-purple-200 border-2 border-brand-500 shadow-2xl flex items-center justify-center ${config.class}`;
            instructionText.textContent = config.text;
            stateDescText.textContent = config.desc;
            count = config.duration;
            countdownText.textContent = count;
            playCalmingBeep(state);
        }

        function countdownTick() {
            count--;
            countdownText.textContent = count;
            if (count === 0) {
                const tech = techniques[currentTechnique];
                state = (state + 1) % tech.states.length;
                if (state === 0) {
                    cycleCount++;
                    cycleText.textContent = cycleCount;
                    // Record session every completed cycle
                    if (cycleCount === 1) recordSession();
                }
                runCycleStep();
            }
        }

        // ==============================================
        // GROUNDING 5-4-3-2-1
        // ==============================================
        let groundingStep = 1;
        const groundingData = {
            1: { title:"LANGKAH 5: 👁️ APA SAJA YANG KAMU LIHAT?", text:"Tuliskan 5 benda yang kamu lihat sekarang di sekelilingmu.", pct:20, placeholder:"Contoh: Layar laptop, cangkir teh, jendela, pulpen, buku..." },
            2: { title:"LANGKAH 4: 🤝 APA SAJA YANG KAMU SENTUH?", text:"Tuliskan 4 hal yang bisa kamu sentuh atau rasakan fisiknya.", pct:40, placeholder:"Contoh: Dinginnya AC, kasarnya meja, lembutnya bantal..." },
            3: { title:"LANGKAH 3: 👂 APA SAJA YANG KAMU DENGAR?", text:"Tuliskan 3 suara yang terdengar di sekitarmu.", pct:60, placeholder:"Contoh: Kipas laptop, gemericik hujan, suara kendaraan..." },
            4: { title:"LANGKAH 2: 👃 APA SAJA YANG KAMU CIUM?", text:"Tuliskan 2 aroma yang bisa kamu hirup sekarang.", pct:80, placeholder:"Contoh: Wangi kopi, aroma kertas buku..." },
            5: { title:"LANGKAH 1: 🗣️ APA YANG KAMU YAKINI?", text:"Tuliskan 1 pernyataan positif yang kamu yakini tentang dirimu.", pct:100, placeholder:"Contoh: Saya berharga, saya aman di sini..." }
        };

        function updateGroundingStep() {
            const step = groundingData[groundingStep];
            document.getElementById('grounding-step-title').textContent = step.title;
            document.getElementById('grounding-step-indicator').textContent = `Langkah ${groundingStep} dari 5`;
            document.getElementById('grounding-progress').style.width = `${step.pct}%`;
            document.getElementById('grounding-question-text').textContent = step.text;
            const input = document.getElementById('grounding-input');
            input.placeholder = step.placeholder; input.value = ''; input.focus();
            document.getElementById('grounding-prev-btn').disabled = (groundingStep === 1);
            document.getElementById('grounding-next-btn').textContent = (groundingStep === 5) ? 'Selesaikan Terapi ✓' : 'Selanjutnya →';
        }

        function nextGroundingStep() {
            const val = document.getElementById('grounding-input').value.trim();
            const form = document.getElementById('grounding-form');
            if (val === '' && !form.classList.contains('hidden')) { alert('Harap tuliskan jawabanmu sebelum melanjutkan.'); return; }
            if (groundingStep < 5) { groundingStep++; updateGroundingStep(); }
            else {
                form.classList.add('hidden');
                document.getElementById('grounding-finish').classList.remove('hidden');
                document.getElementById('grounding-prev-btn').classList.add('hidden');
                document.getElementById('grounding-next-btn').classList.add('hidden');
                recordSession();
            }
        }

        function prevGroundingStep() {
            if (groundingStep > 1) { groundingStep--; updateGroundingStep(); }
        }

        function resetGrounding() {
            groundingStep = 1;
            document.getElementById('grounding-form').classList.remove('hidden');
            document.getElementById('grounding-finish').classList.add('hidden');
            document.getElementById('grounding-prev-btn').classList.remove('hidden');
            document.getElementById('grounding-next-btn').classList.remove('hidden');
            updateGroundingStep();
        }

        // ==============================================
        // WEB AUDIO API
        // ==============================================
        let audioCtx = null, isSoundPlaying = false;
        let oscL = null, oscR = null, noiseSource = null, noiseFilter = null, ambientGain = null, merger = null;

        function toggleAmbientSound() {
            if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            const btnText = document.getElementById('sound-text');
            const btnIcon = document.getElementById('sound-icon');
            const statusText = document.getElementById('ambient-status');

            if (isSoundPlaying) {
                stopAllAmbientSounds(); isSoundPlaying = false;
                btnText.textContent = 'Mulai Suara Alam'; btnIcon.textContent = '🔊';
                statusText.textContent = 'Status: Suara Mati';
            } else {
                if (audioCtx.state === 'suspended') audioCtx.resume();
                ambientGain = audioCtx.createGain();
                ambientGain.gain.setValueAtTime(0.08, audioCtx.currentTime);
                ambientGain.connect(audioCtx.destination);
                const soundType = document.querySelector('input[name="sound-type"]:checked').value;

                if (soundType === 'delta') {
                    merger = audioCtx.createChannelMerger(2);
                    oscL = audioCtx.createOscillator(); oscL.type = 'sine'; oscL.frequency.setValueAtTime(85, audioCtx.currentTime);
                    oscR = audioCtx.createOscillator(); oscR.type = 'sine'; oscR.frequency.setValueAtTime(90, audioCtx.currentTime);
                    const gainL = audioCtx.createGain(); gainL.gain.setValueAtTime(0.7, audioCtx.currentTime);
                    const gainR = audioCtx.createGain(); gainR.gain.setValueAtTime(0.7, audioCtx.currentTime);
                    oscL.connect(gainL).connect(merger, 0, 0); oscR.connect(gainR).connect(merger, 0, 1);
                    merger.connect(ambientGain); oscL.start(); oscR.start();
                    statusText.textContent = 'Status: Delta Binaural 85Hz';
                } else if (soundType === 'solfeggio') {
                    oscL = audioCtx.createOscillator(); oscL.type = 'sine'; oscL.frequency.setValueAtTime(528, audioCtx.currentTime);
                    const lfo = audioCtx.createOscillator(); lfo.frequency.value = 1.5;
                    const lfoGain = audioCtx.createGain(); lfoGain.gain.value = 0.02;
                    const oscGain = audioCtx.createGain(); oscGain.gain.value = 0.5;
                    lfo.connect(lfoGain).connect(oscGain.gain); oscL.connect(oscGain).connect(ambientGain);
                    lfo.start(); oscL.start();
                    statusText.textContent = 'Status: Solfeggio 528Hz';
                } else if (soundType === 'rain') {
                    const bufferSize = 2 * audioCtx.sampleRate;
                    const noiseBuffer = audioCtx.createBuffer(1, bufferSize, audioCtx.sampleRate);
                    const output = noiseBuffer.getChannelData(0);
                    for (let i = 0; i < bufferSize; i++) output[i] = Math.random() * 2 - 1;
                    noiseSource = audioCtx.createBufferSource(); noiseSource.buffer = noiseBuffer; noiseSource.loop = true;
                    noiseFilter = audioCtx.createBiquadFilter(); noiseFilter.type = 'bandpass';
                    noiseFilter.frequency.setValueAtTime(800, audioCtx.currentTime); noiseFilter.Q.setValueAtTime(1.0, audioCtx.currentTime);
                    const rainGain = audioCtx.createGain(); rainGain.gain.setValueAtTime(0.8, audioCtx.currentTime);
                    noiseSource.connect(noiseFilter).connect(rainGain).connect(ambientGain); noiseSource.start();
                    statusText.textContent = 'Status: Derau Hujan';
                }

                isSoundPlaying = true;
                btnText.textContent = 'Matikan Suara Alam'; btnIcon.textContent = '🔇';
            }
        }

        function stopAllAmbientSounds() {
            [oscL, oscR].forEach(o => { if (o) { try { o.stop(); } catch(e){} o.disconnect(); } });
            oscL = oscR = null;
            if (noiseSource) { try { noiseSource.stop(); } catch(e){} noiseSource.disconnect(); noiseSource = null; }
            if (noiseFilter) { noiseFilter.disconnect(); noiseFilter = null; }
            if (ambientGain) { ambientGain.disconnect(); ambientGain = null; }
        }

        function playCalmingBeep(stateId) {
            if (!audioCtx || !isSoundPlaying) return;
            const osc = audioCtx.createOscillator();
            const gainNode = audioCtx.createGain();
            osc.type = 'sine';
            const freqs = [329.63, 392.00, 261.63, 293.66];
            osc.frequency.setValueAtTime(freqs[stateId % freqs.length] || 261.63, audioCtx.currentTime);
            gainNode.gain.setValueAtTime(0.04, audioCtx.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 1.5);
            osc.connect(gainNode); gainNode.connect(audioCtx.destination);
            osc.start(); osc.stop(audioCtx.currentTime + 1.8);
        }

        document.querySelectorAll('input[name="sound-type"]').forEach(radio => {
            radio.addEventListener('change', () => {
                if (isSoundPlaying) { stopAllAmbientSounds(); isSoundPlaying = false; toggleAmbientSound(); }
            });
        });

        // Initialize
        updateGroundingStep();

        // Navbar: tampilkan nama user + logout
        const _name = localStorage.getItem('soulkeep_name') || 'Pengguna';
        const _el = document.getElementById('user-name');
        if (_el) _el.textContent = _name;
        const _av = document.getElementById('user-avatar');
        if (_av) _av.textContent = (localStorage.getItem('soulkeep_name') || 'P')[0].toUpperCase();
        window.addEventListener('scroll', () => { const nav = document.getElementById('main-nav'); if (nav) nav.classList.toggle('scrolled', window.scrollY > 10); });
        function logout() { localStorage.clear(); window.location.href = '/login'; }
    </script>
</body>
</html>
