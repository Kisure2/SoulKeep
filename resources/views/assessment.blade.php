<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SoulKeep — Tes Skrining Kesehatan Mental Mandiri. Evaluasi tingkat stres akademismu. Mendukung UN SDG 3.">
    <meta name="theme-color" content="#396696">
    <title>Tes Skrining Kesehatan Mental — SoulKeep</title>
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
        /* Assessment-specific */
        @keyframes questionIn { from{opacity:0;transform:translateX(20px)} to{opacity:1;transform:translateX(0)} }
        @keyframes toastIn { from{opacity:0;transform:translateY(16px) scale(.96)} to{opacity:1;transform:translateY(0) scale(1)} }
        @keyframes ringProgress { from{stroke-dashoffset:283} to{stroke-dashoffset:var(--target)} }
        .question-animate { animation:questionIn .3s ease-out; }
        .option-btn { transition:all .2s; border:2px solid #E4EDF7; background:#fff; color:#3D4454; border-radius:16px; padding:.75rem 1rem; font-size:.875rem; font-weight:600; cursor:pointer; width:100%; text-align:left; }
        .option-btn.selected { border-color:#396696 !important; background:#E4EDF7 !important; color:#1E2229 !important; }
        .option-btn:hover:not(.selected) { border-color:#C7DCEF; background:#F4F7FB; }
        .ring-progress { animation:ringProgress 1.2s ease-out forwards; }
        .toast-notification { animation:toastIn .3s cubic-bezier(.34,1.56,.64,1) both; border-radius:14px; }
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
@include('partials.user-sidebar', ['active' => 'assessment'])

    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 sm:py-8 pb-20 md:pb-8">

        <!-- Hero Section -->
        <div class="relative overflow-hidden rounded-2xl mb-8 h-[260px] sm:h-[300px] fade-up fade-up-d1">
            <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=1200&q=70" alt="hero assessment" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute -top-20 -right-20 w-64 h-64 shape-blob bg-white/5 shape-circle blob-anim hidden sm:block"></div>
            <div class="img-overlay"></div>
            <div class="relative z-10 h-full flex flex-col justify-between p-6 sm:p-8">
                <div>
                    <span class="inline-flex items-center gap-2 text-xs font-bold bg-white/15 text-white px-4 py-1.5 rounded-full border border-white/30 backdrop-blur-sm">📝 Evaluasi Diri</span>
                </div>
                <div class="space-y-2">
                    <h1 class="text-3xl sm:text-4xl font-outfit font-black text-white leading-tight">Tes Kesehatan Mental</h1>
                    <p class="text-white/80 text-sm sm:text-base max-w-md leading-relaxed">10 pertanyaan dalam 3 menit. Data tersimpan pribadi di akun kamu.</p>
                </div>
            </div>
        </div>

        <!-- Intro Card -->
        <div id="intro-card" class="bg-white rounded-3xl border border-brand-100 p-8 shadow-xl shadow-brand-100/30 space-y-6">
            <div class="text-center space-y-4">
                <span class="text-6xl">🧠</span>
                <h1 class="text-3xl font-outfit font-extrabold text-neutralDark">Tes Skrining Kesehatan Mental</h1>
                <p class="text-sm text-neutralDark/60 max-w-xl mx-auto leading-relaxed">
                    Evaluasi tingkat stres akademis, emosional, dan kesejahteraan dirimu secara cepat & privat. Diadaptasi dari indikator psikologis umum untuk mendukung <strong>UN SDG 3 (Kesehatan & Kesejahteraan)</strong>.
                </p>
            </div>

            <div class="grid grid-cols-3 gap-4 text-center">
                <div class="p-4 bg-brand-50 rounded-2xl border border-brand-100">
                    <p class="text-2xl font-outfit font-extrabold text-brand-600">10</p>
                    <p class="text-xs text-neutralDark/60 font-semibold mt-1">Pertanyaan</p>
                </div>
                <div class="p-4 bg-brand-50 rounded-2xl border border-brand-100">
                    <p class="text-2xl font-outfit font-extrabold text-brand-600">~3</p>
                    <p class="text-xs text-neutralDark/60 font-semibold mt-1">Menit</p>
                </div>
                <div class="p-4 bg-brand-50 rounded-2xl border border-brand-100">
                    <p class="text-2xl font-outfit font-extrabold text-brand-600">100%</p>
                    <p class="text-xs text-neutralDark/60 font-semibold mt-1">Privat</p>
                </div>
            </div>

            <div class="p-5 bg-brand-50 rounded-2xl border border-brand-100 space-y-2">
                <h3 class="text-sm font-bold text-brand-850">Ketentuan Pengujian:</h3>
                <ul class="text-xs text-neutralDark/70 space-y-1.5 list-disc pl-5 leading-relaxed">
                    <li>Kuesioner berisi 10 pertanyaan tentang apa yang kamu rasakan dalam 1 bulan terakhir.</li>
                    <li>Tidak ada jawaban benar/salah. Pilih yang paling menggambarkan kondisimu.</li>
                    <li>Privasi 100% aman: Hasil tes diproses di browsermu dan disimpan di localStorage.</li>
                </ul>
            </div>

            <button onclick="startTest()"
                class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-4 rounded-xl shadow-md transition-all text-center text-sm">
                🧠 Mulai Tes Mandiri Sekarang
            </button>
        </div>

        <!-- Quiz Card -->
        <div id="quiz-card" class="bg-white rounded-3xl border border-brand-100 p-6 sm:p-8 shadow-xl shadow-brand-100/30 space-y-6 hidden">
            <!-- Progress Header -->
            <div class="flex justify-between items-center text-xs font-semibold text-neutralDark/40">
                <span id="quiz-progress-text">Pertanyaan 1 dari 10</span>
                <span id="quiz-percentage-text">10%</span>
            </div>
            <div class="w-full bg-brand-100 h-2 rounded-full overflow-hidden">
                <div id="quiz-progress-bar" class="bg-gradient-to-r from-brand-500 to-brand-600 h-full rounded-full transition-all duration-500" style="width:10%"></div>
            </div>

            <!-- Question -->
            <div id="question-wrapper" class="space-y-3 question-animate">
                <span class="inline-block px-3 py-1 bg-brand-50 text-brand-700 text-[10px] font-bold tracking-widest uppercase rounded-full border border-brand-100">
                    Skala Kesejahteraan Jiwa
                </span>
                <h2 id="question-text" class="text-lg sm:text-xl font-outfit font-bold text-neutralDark leading-relaxed"></h2>
            </div>

            <!-- Options -->
            <div class="space-y-2.5" id="options-container">
                <button onclick="selectOption(0)" class="option-btn w-full text-left p-4 bg-brand-50/30 border border-brand-100 hover:border-brand-400 rounded-2xl hover:bg-brand-50 transition flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-white border border-brand-200 flex items-center justify-center text-xs font-bold shrink-0">A</span>
                    <span class="text-xs sm:text-sm font-semibold">Tidak Pernah</span>
                </button>
                <button onclick="selectOption(1)" class="option-btn w-full text-left p-4 bg-brand-50/30 border border-brand-100 hover:border-brand-400 rounded-2xl hover:bg-brand-50 transition flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-white border border-brand-200 flex items-center justify-center text-xs font-bold shrink-0">B</span>
                    <span class="text-xs sm:text-sm font-semibold">Jarang</span>
                </button>
                <button onclick="selectOption(2)" class="option-btn w-full text-left p-4 bg-brand-50/30 border border-brand-100 hover:border-brand-400 rounded-2xl hover:bg-brand-50 transition flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-white border border-brand-200 flex items-center justify-center text-xs font-bold shrink-0">C</span>
                    <span class="text-xs sm:text-sm font-semibold">Kadang-kadang</span>
                </button>
                <button onclick="selectOption(3)" class="option-btn w-full text-left p-4 bg-brand-50/30 border border-brand-100 hover:border-brand-400 rounded-2xl hover:bg-brand-50 transition flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-white border border-brand-200 flex items-center justify-center text-xs font-bold shrink-0">D</span>
                    <span class="text-xs sm:text-sm font-semibold">Sering</span>
                </button>
                <button onclick="selectOption(4)" class="option-btn w-full text-left p-4 bg-brand-50/30 border border-brand-100 hover:border-brand-400 rounded-2xl hover:bg-brand-50 transition flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-white border border-brand-200 flex items-center justify-center text-xs font-bold shrink-0">E</span>
                    <span class="text-xs sm:text-sm font-semibold">Hampir Selalu</span>
                </button>
            </div>

            <!-- Navigation -->
            <div class="flex justify-between items-center pt-2 border-t border-brand-50">
                <button onclick="prevQuestion()" id="prev-btn" disabled
                    class="px-4 py-2 text-xs font-bold text-neutralDark/40 border border-transparent rounded-lg hover:bg-brand-50 transition disabled:opacity-40 disabled:hover:bg-transparent">
                    ← Sebelumnya
                </button>
                <span class="text-[10px] text-neutralDark/30 uppercase font-bold tracking-wider">SoulKeep Wellness</span>
            </div>
        </div>

        <!-- Result Card -->
        <div id="result-card" class="bg-white rounded-3xl border border-brand-100 p-8 shadow-xl shadow-brand-100/30 space-y-6 hidden">

            <!-- Score Ring + Header -->
            <div class="text-center space-y-4">
                <div class="relative w-40 h-40 mx-auto">
                    <svg class="w-full h-full -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#E4EDF7" stroke-width="8"/>
                        <circle id="result-ring" cx="50" cy="50" r="45" fill="none" stroke="#396696" stroke-width="8"
                            stroke-linecap="round" stroke-dasharray="283" stroke-dashoffset="283"
                            style="transition: stroke-dashoffset 1.2s ease-out;"/>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span id="result-icon" class="text-4xl">🟢</span>
                        <span id="result-score-num" class="text-2xl font-outfit font-extrabold text-neutralDark mt-1"></span>
                    </div>
                </div>

                <div class="space-y-1">
                    <span class="inline-block px-3 py-1 bg-brand-50 text-brand-700 text-[10px] font-bold tracking-widest uppercase rounded-full border border-brand-100">
                        Hasil Pengujian Anda
                    </span>
                    <h2 class="text-2xl font-outfit font-extrabold text-neutralDark" id="result-title"></h2>
                    <p class="text-xs text-neutralDark/50">Skor <span id="result-score-display"></span> dari 40</p>
                </div>
            </div>

            <!-- Category Breakdown -->
            <div class="grid grid-cols-3 gap-3" id="breakdown-grid">
                <div class="text-center p-3 bg-brand-50 rounded-2xl border border-brand-100">
                    <p class="text-lg">😰</p>
                    <p class="text-xs font-bold text-neutralDark mt-1">Stres</p>
                    <p class="text-sm font-outfit font-extrabold text-brand-600" id="cat-stress">—</p>
                </div>
                <div class="text-center p-3 bg-brand-50 rounded-2xl border border-brand-100">
                    <p class="text-lg">😟</p>
                    <p class="text-xs font-bold text-neutralDark mt-1">Kecemasan</p>
                    <p class="text-sm font-outfit font-extrabold text-brand-600" id="cat-anxiety">—</p>
                </div>
                <div class="text-center p-3 bg-brand-50 rounded-2xl border border-brand-100">
                    <p class="text-lg">😴</p>
                    <p class="text-xs font-bold text-neutralDark mt-1">Burnout</p>
                    <p class="text-sm font-outfit font-extrabold text-brand-600" id="cat-burnout">—</p>
                </div>
            </div>

            <p class="text-sm text-neutralDark/65 leading-relaxed text-center max-w-lg mx-auto" id="result-desc"></p>

            <!-- Recommendation Box -->
            <div id="result-recommendation-box" class="p-5 rounded-2xl border flex items-start gap-3 max-w-xl mx-auto">
                <span class="text-2xl shrink-0" id="rec-icon">🌱</span>
                <div>
                    <span class="font-bold text-xs block mb-1" id="rec-title">Saran Kesejahteraan (SDG 3):</span>
                    <p class="text-xs leading-relaxed" id="result-recommendation-text"></p>
                </div>
            </div>

            <!-- Breakdown 3 Kategori -->
            <div class="space-y-3 p-5 bg-brand-50 rounded-2xl border border-brand-100 max-w-xl mx-auto">
                <h4 class="text-xs font-bold text-brand-700 uppercase tracking-wider">📊 Rincian per Kategori</h4>
                <div>
                    <div class="flex justify-between text-xs mb-1.5">
                        <span class="font-semibold text-neutralDark">🔥 Burnout Akademik</span>
                        <span id="breakdown-burnout-val" class="text-gray-500 font-mono">0/12</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div id="breakdown-burnout" class="bg-orange-400 h-2 rounded-full transition-all duration-700" style="width:0%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs mb-1.5">
                        <span class="font-semibold text-neutralDark">😔 Gejala Depresi</span>
                        <span id="breakdown-depresi-val" class="text-gray-500 font-mono">0/12</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div id="breakdown-depresi" class="bg-blue-400 h-2 rounded-full transition-all duration-700" style="width:0%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs mb-1.5">
                        <span class="font-semibold text-neutralDark">😰 Kecemasan</span>
                        <span id="breakdown-kecemasan-val" class="text-gray-500 font-mono">0/16</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div id="breakdown-kecemasan" class="bg-purple-400 h-2 rounded-full transition-all duration-700" style="width:0%"></div>
                    </div>
                </div>
                <p class="text-[10px] text-gray-400">Bar yang lebih panjang = tingkat gejala lebih tinggi pada kategori tersebut</p>
            </div>

            <!-- Emergency Hotline (shown for high scores) -->
            <div id="emergency-banner" class="hidden p-4 bg-red-50 border border-red-200 rounded-2xl flex items-center gap-3">
                <span class="text-2xl">🆘</span>
                <div>
                    <p class="font-bold text-red-700 text-sm">Butuh Bantuan Segera?</p>
                    <p class="text-red-600 text-xs mt-0.5">Into The Light Indonesia: <strong>119 ext 8</strong> | Yayasan Pulih: <strong>(021) 788-42580</strong></p>
                </div>
            </div>

            <!-- CTAs -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-xl mx-auto">
                <a href="/relaxation" class="px-5 py-3.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow-md transition text-xs flex items-center justify-center gap-2">
                    🌬️ Coba Relaksasi Napas
                </a>
                <a href="/dashboard" class="px-5 py-3.5 border-2 border-brand-200 text-brand-700 hover:bg-brand-50 font-bold rounded-xl transition text-xs flex items-center justify-center gap-2">
                    🏠 Kembali ke Dashboard
                </a>
            </div>

            <div class="text-center">
                <button onclick="resetTest()" class="text-xs font-bold text-neutralDark/50 hover:text-brand-600 transition underline">
                    🔄 Jalankan Ulang Tes
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
        const questions = [
            "Seberapa sering kamu merasa terbebani dengan tugas kuliah atau aktivitas akademik dalam sebulan terakhir?",
            "Seberapa sering kamu merasa kesulitan untuk tidur nyenyak akibat memikirkan masalah perkuliahan?",
            "Seberapa sering kamu merasa cemas, gelisah, atau panik tanpa alasan yang jelas?",
            "Seberapa sering kamu merasa kehilangan minat untuk bersosialisasi dengan teman atau melakukan hobimu?",
            "Seberapa sering kamu merasa tubuhmu sangat lelah sepanjang hari meskipun tidak beraktivitas berat?",
            "Seberapa sering kamu kesulitan berkonsentrasi saat mengikuti perkuliahan atau belajar mandiri?",
            "Seberapa sering kamu merasa tidak berdaya atau tidak mampu mengontrol arah hidup perkuliahanmu?",
            "Seberapa sering kamu merasa mudah marah, tersinggung, atau frustrasi karena masalah kecil?",
            "Seberapa sering kamu merasa kesepian atau merasa tidak ada yang mendukungmu di lingkungan kampus?",
            "Seberapa sering kamu mengkhawatirkan masa depan akademis atau karirmu secara berlebihan?"
        ];

        let currentStep = 0;
        let scores = Array(questions.length).fill(null);

        function startTest() {
            document.getElementById('intro-card').classList.add('hidden');
            document.getElementById('quiz-card').classList.remove('hidden');
            showQuestion();
        }

        function showQuestion() {
            const wrapper = document.getElementById('question-wrapper');
            wrapper.classList.remove('question-animate');
            void wrapper.offsetWidth;
            wrapper.classList.add('question-animate');

            document.getElementById('question-text').textContent = questions[currentStep];
            document.getElementById('quiz-progress-text').textContent = `Pertanyaan ${currentStep + 1} dari ${questions.length}`;
            const pct = Math.round(((currentStep + 1) / questions.length) * 100);
            document.getElementById('quiz-percentage-text').textContent = `${pct}%`;
            document.getElementById('quiz-progress-bar').style.width = `${pct}%`;
            document.getElementById('prev-btn').disabled = (currentStep === 0);

            const optionBtns = document.querySelectorAll('.option-btn');
            optionBtns.forEach((btn, i) => {
                btn.className = "option-btn w-full text-left p-4 bg-brand-50/30 border border-brand-100 hover:border-brand-400 rounded-2xl hover:bg-brand-50 transition flex items-center gap-3";
                if (scores[currentStep] === i) btn.classList.add('selected');
            });
        }

        function selectOption(value) {
            scores[currentStep] = value;
            document.querySelectorAll('.option-btn').forEach((btn, i) => {
                btn.classList.toggle('selected', i === value);
            });
            setTimeout(() => {
                if (currentStep < questions.length - 1) { currentStep++; showQuestion(); }
                else { calculateResults(); }
            }, 280);
        }

        function prevQuestion() {
            if (currentStep > 0) { currentStep--; showQuestion(); }
        }

        async function calculateResults() {
            document.getElementById('quiz-card').classList.add('hidden');
            document.getElementById('result-card').classList.remove('hidden');

            const totalScore = scores.reduce((a, b) => a + (b || 0), 0);

            // Kategori: Q1-3=Burnout Akademik | Q4-6=Gejala Depresi | Q7-10=Kecemasan
            const burnout   = scores.slice(0, 3).reduce((a,b)=>a+(b||0),0); // max 12
            const depresi   = scores.slice(3, 6).reduce((a,b)=>a+(b||0),0); // max 12
            const kecemasan = scores.slice(6, 10).reduce((a,b)=>a+(b||0),0); // max 16

            // Update breakdown bars
            setTimeout(() => {
                document.getElementById('breakdown-burnout').style.width   = `${Math.round((burnout/12)*100)}%`;
                document.getElementById('breakdown-depresi').style.width   = `${Math.round((depresi/12)*100)}%`;
                document.getElementById('breakdown-kecemasan').style.width = `${Math.round((kecemasan/16)*100)}%`;
            }, 200);
            document.getElementById('breakdown-burnout-val').textContent   = `${burnout}/12`;
            document.getElementById('breakdown-depresi-val').textContent   = `${depresi}/12`;
            document.getElementById('breakdown-kecemasan-val').textContent = `${kecemasan}/16`;

            // Score ring animation
            const ring = document.getElementById('result-ring');
            const pct = totalScore / 40;
            const dashOffset = 283 - (283 * pct);
            let ringColor = '#16a34a';
            if (pct > 0.65) ringColor = '#ef4444';
            else if (pct > 0.35) ringColor = '#f59e0b';
            ring.style.stroke = ringColor;
            setTimeout(() => { ring.style.strokeDashoffset = dashOffset; }, 100);

            document.getElementById('result-score-num').textContent = totalScore;
            document.getElementById('result-score-display').textContent = totalScore;

            // Tentukan level untuk API
            let level = totalScore <= 13 ? 'Ringan' : totalScore <= 26 ? 'Sedang' : 'Berat';

            // Legacy category breakdown (ring-based)
            const stressScore  = scores.slice(0,3).reduce((a,b)=>a+(b||0),0);
            const anxietyScore = scores.slice(3,6).reduce((a,b)=>a+(b||0),0);
            const burnoutScore = scores.slice(6,10).reduce((a,b)=>a+(b||0),0);
            const levelLabel = (s, max) => { const r=s/max; if(r<=0.25)return'Ringan'; if(r<=0.5)return'Sedang'; if(r<=0.75)return'Tinggi'; return'Berat'; };
            document.getElementById('cat-stress').textContent  = levelLabel(stressScore, 8);
            document.getElementById('cat-anxiety').textContent = levelLabel(anxietyScore, 8);
            document.getElementById('cat-burnout').textContent = levelLabel(burnoutScore, 12);

            let icon, title, desc, recText, recTitle, recIcon;
            const recBox = document.getElementById('result-recommendation-box');
            const emergencyBanner = document.getElementById('emergency-banner');

            if (totalScore <= 13) {
                icon = '🟢'; title = 'Tingkat Stres: Ringan / Normal';
                desc = 'Luar biasa! Tingkat stres emosional dan akademismu berada pada batas normal/sehat. Kamu mampu menyelaraskan waktu belajar dengan kesehatan mentalmu dengan sangat baik.';
                recText = 'Pertahankan rutinitas positifmu. Catat mood harian di SoulKeep secara rutin untuk memantau kestabilan kesehatan mentalmu. Lanjutkan kebiasaan tidur cukup, olahraga ringan, dan interaksi sosial yang sehat.';
                recIcon = '🌱'; recTitle = 'Saran Kesejahteraan:';
                recBox.className = 'p-5 rounded-2xl border border-green-200 bg-green-50 flex items-start gap-3 max-w-xl mx-auto';
                document.getElementById('rec-title').style.color = '#15803d';
                document.getElementById('result-recommendation-text').style.color = '#166534';
            } else if (totalScore <= 26) {
                icon = '🟡'; title = 'Tingkat Stres: Sedang / Moderat';
                desc = 'Kamu sedang berada dalam kondisi stres tingkat sedang. Beban kuliah atau kekhawatiran masa depan mungkin mulai menumpuk. Ini sinyal untuk mulai beristirahat lebih intentional.';
                recText = 'Cobalah fitur Latihan Pernapasan & Meditasi kami selama 5-10 menit setiap hari. Teknik Box Breathing dan 4-7-8 sangat efektif meredakan kecemasan akademik. Jangan tunda untuk berbicara dengan orang yang kamu percaya.';
                recIcon = '🌬️'; recTitle = 'Rekomendasi Relaksasi:';
                recBox.className = 'p-5 rounded-2xl border border-yellow-200 bg-yellow-50 flex items-start gap-3 max-w-xl mx-auto';
                document.getElementById('rec-title').style.color = '#b45309';
                document.getElementById('result-recommendation-text').style.color = '#92400e';
            } else {
                icon = '🛑'; title = 'Tingkat Stres: Tinggi / Berat';
                desc = 'Skormu menunjukkan stres tingkat tinggi atau kelelahan emosional (burnout) yang cukup berat. Beban pikiran ini dapat mengganggu aktivitas harian dan kesehatan fisikmu.';
                recText = 'Sangat penting untuk segera mengambil tindakan. Hubungi layanan konseling kampus, dosen wali, atau psikolog profesional. Jangan tunda mencari bantuan — itu tanda keberanian, bukan kelemahan.';
                recIcon = '🆘'; recTitle = 'Perlu Tindakan Segera:';
                recBox.className = 'p-5 rounded-2xl border border-red-200 bg-red-50 flex items-start gap-3 max-w-xl mx-auto';
                document.getElementById('rec-title').style.color = '#b91c1c';
                document.getElementById('result-recommendation-text').style.color = '#7f1d1d';
                emergencyBanner.classList.remove('hidden');
            }

            document.getElementById('result-icon').textContent = icon;
            document.getElementById('result-title').textContent = title;
            document.getElementById('result-desc').textContent = desc;
            document.getElementById('rec-icon').textContent = recIcon;
            document.getElementById('rec-title').textContent = recTitle;
            document.getElementById('result-recommendation-text').textContent = recText;

            // Simpan ke API (jika sudah login)
            const token = localStorage.getItem('soulkeep_token');
            if (token) {
                try {
                    await fetch('/api/assessments', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-API-KEY': 'rahasia-uas-123',
                            'Authorization': `Bearer ${token}`
                        },
                        body: JSON.stringify({
                            total_score: totalScore,
                            level: level,
                            category_scores: { burnout, depresi, kecemasan }
                        })
                    });
                } catch(e) { /* Fallback ke localStorage saja */ }
            }

            // Simpan ke localStorage (untuk widget dashboard & offline fallback)
            localStorage.setItem('soulkeep_last_assessment', JSON.stringify({
                score: totalScore,
                level: level,
                date: new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })
            }));
        }

        function resetTest() {
            currentStep = 0;
            scores = Array(questions.length).fill(null);
            document.getElementById('result-card').classList.add('hidden');
            document.getElementById('emergency-banner').classList.add('hidden');
            document.getElementById('intro-card').classList.remove('hidden');
            document.getElementById('result-ring').style.strokeDashoffset = '283';
            // Reset breakdown bars
            ['breakdown-burnout','breakdown-depresi','breakdown-kecemasan'].forEach(id => {
                document.getElementById(id).style.width = '0%';
            });
        }

        // Navbar: tampilkan nama user + logout
        const _name = localStorage.getItem('soulkeep_name') || 'Pengguna';
        const _av = document.getElementById('user-avatar');
        if (_av) _av.textContent = (localStorage.getItem('soulkeep_name') || 'P')[0].toUpperCase();
        window.addEventListener('scroll', () => { const nav = document.getElementById('main-nav'); if (nav) nav.classList.toggle('scrolled', window.scrollY > 10); });
        const _el = document.getElementById('user-name');
        if (_el) _el.textContent = _name;
        function logout() { localStorage.clear(); window.location.href = '/login'; }
    </script>
</body>
</html>
