<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SoulKeep — Platform kesehatan mental untuk mahasiswa Indonesia. Lacak mood, tes stres, teknik relaksasi, dan temukan psikolog terdekat. Gratis. Mendukung UN SDG 3.">
    <meta name="keywords" content="kesehatan mental, mahasiswa, mood tracker, psikolog, CBT, DBT, SDG 3">
    <meta name="theme-color" content="#396696">
    <meta property="og:title" content="SoulKeep — Jaga Kesehatan Mentalmu">
    <meta property="og:description" content="Platform kesehatan mental No.1 untuk mahasiswa Indonesia. Gratis, berbasis sains, privasi terjamin.">
    <title>SoulKeep — Platform Kesehatan Mental untuk Mahasiswa Indonesia</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💙</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #1E2229; background: #ffffff; }

        /* Animations */
        @keyframes float { 0%,100%{transform:translateY(0) rotate(-2deg)} 50%{transform:translateY(-14px) rotate(-2deg)} }
        .hero-float { animation: float 7s ease-in-out infinite; }
        @keyframes fadeUp { from{opacity:0;transform:translateY(28px)} to{opacity:1;transform:translateY(0)} }
        .fade-up { animation: fadeUp 0.65s ease-out forwards; opacity:0; }
        .fade-up-d1 { animation-delay:0.1s; }
        .fade-up-d2 { animation-delay:0.22s; }
        .fade-up-d3 { animation-delay:0.34s; }
        .fade-up-d4 { animation-delay:0.46s; }
        @keyframes blobMove { 0%,100%{border-radius:60% 40% 30% 70%/60% 30% 70% 40%} 50%{border-radius:30% 60% 70% 40%/50% 60% 30% 60%} }
        .blob-anim { animation: blobMove 12s ease-in-out infinite; }
        @keyframes gradientShift { 0%{background-position:0% 50%} 50%{background-position:100% 50%} 100%{background-position:0% 50%} }
        .gradient-animate { background-size:200% 200%; animation:gradientShift 8s ease infinite; }
        nav.scrolled { box-shadow:0 4px 24px -6px rgba(57,102,150,0.18); }
        .reveal { opacity:0; transform:translateY(36px); transition:all 0.65s cubic-bezier(0.4,0,0.2,1); }
        .reveal.visible { opacity:1; transform:translateY(0); }
        .feature-card { transition:all 0.3s ease; }
        .feature-card:hover { transform:translateY(-6px); box-shadow:0 20px 40px -12px rgba(57,102,150,0.18); }
        .testimonial-card { transition:all 0.3s ease; }
        .testimonial-card:hover { transform:translateY(-4px); box-shadow:0 16px 32px -8px rgba(57,102,150,0.14); }
        .cta-btn { transition:all 0.25s ease; }
        .cta-btn:hover { transform:translateY(-2px); box-shadow:0 12px 24px -6px rgba(57,102,150,0.35); }
        #mobile-menu { transition:all 0.25s ease; }
        .step-num { background:linear-gradient(135deg,#396696,#4B81B7); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        section { position:relative; }
    </style>
</head>
<body class="overflow-x-hidden">

    <!-- ==================== NAVBAR ==================== -->
    <nav id="main-nav" class="sticky top-0 z-50 backdrop-blur-xl bg-white/90 border-b border-brand-100 transition-all duration-300">
        <div class="max-w-6xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2.5 text-xl font-outfit font-extrabold text-brand-700 tracking-tight">
                    💙 SoulKeep
                    <span class="text-[10px] bg-brand-600 text-white px-2 py-0.5 rounded-full font-bold tracking-wide">SDG 3</span>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center gap-7 text-sm font-semibold text-neutralDark/70">
                    <a href="#fitur" class="hover:text-brand-600 transition">Fitur</a>
                    <a href="#cara-kerja" class="hover:text-brand-600 transition">Cara Kerja</a>
                    <a href="#testimoni" class="hover:text-brand-600 transition">Testimoni</a>
                    <a href="/nearby" class="hover:text-brand-600 transition">Psikolog Terdekat</a>

                </div>

                <!-- CTA + Hamburger -->
                <div class="flex items-center gap-3">
                    <a href="/login" class="hidden sm:inline text-sm font-bold text-neutralDark/70 hover:text-brand-600 transition px-4 py-2">Masuk</a>
                    <a href="/register" class="hidden sm:inline px-5 py-2.5 bg-brand-600 text-white text-sm font-bold rounded-xl hover:bg-brand-700 transition shadow-md shadow-brand-200">Daftar Gratis →</a>
                    <button id="hamburger" class="md:hidden p-2 rounded-xl hover:bg-brand-50 transition" aria-label="Menu">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pt-4 pb-3 space-y-1 border-t border-brand-100 mt-4">
                <a href="#fitur" class="block px-4 py-2.5 text-sm font-semibold text-neutralDark/70 hover:bg-brand-50 rounded-xl transition">Fitur</a>
                <a href="#cara-kerja" class="block px-4 py-2.5 text-sm font-semibold text-neutralDark/70 hover:bg-brand-50 rounded-xl transition">Cara Kerja</a>
                <a href="#testimoni" class="block px-4 py-2.5 text-sm font-semibold text-neutralDark/70 hover:bg-brand-50 rounded-xl transition">Testimoni</a>
                <a href="/nearby" class="block px-4 py-2.5 text-sm font-semibold text-neutralDark/70 hover:bg-brand-50 rounded-xl transition">Psikolog Terdekat</a>
                <div class="flex gap-3 px-4 pt-2">
                    <a href="/login" class="flex-1 text-center py-2.5 border border-brand-200 text-brand-700 text-sm font-bold rounded-xl hover:bg-brand-50 transition">Masuk</a>
                    <a href="/register" class="flex-1 text-center py-2.5 bg-brand-600 text-white text-sm font-bold rounded-xl hover:bg-brand-700 transition">Daftar Gratis</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ==================== HERO ==================== -->
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-50 via-white to-[#EFF5FC] min-h-[92vh] flex items-center">
        <!-- Background blobs -->
        <div class="absolute top-10 right-10 w-96 h-96 bg-brand-100/60 blob-anim" style="border-radius:60% 40% 30% 70%/60% 30% 70% 40%"></div>
        <div class="absolute bottom-10 left-10 w-64 h-64 bg-brand-200/30 blob-anim" style="border-radius:30% 60% 70% 40%/50% 60% 30% 60%;animation-delay:3s"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand-50/50 rounded-full blur-3xl"></div>

        <div class="max-w-6xl mx-auto px-6 py-20 w-full relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left: Text -->
                <div class="space-y-7">
                    <div class="fade-up">
                        <span class="inline-flex items-center gap-2 bg-brand-100 text-brand-700 text-xs font-bold px-4 py-2 rounded-full border border-brand-200">
                            🌍 Mendukung UN SDG Goal 3 — Kesehatan & Kesejahteraan
                        </span>
                    </div>
                    <div class="fade-up fade-up-d1">
                        <h1 class="text-5xl md:text-6xl font-outfit font-black text-neutralDark leading-tight tracking-tight">
                            Jaga Pikiran,<br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-[#4B81B7]">Raih Hidupmu.</span>
                        </h1>
                    </div>
                    <p class="fade-up fade-up-d2 text-lg text-neutralDark/65 leading-relaxed max-w-lg">
                        Platform kesehatan mental berbasis sains untuk mahasiswa Indonesia. Lacak mood harian, tes tingkat stres, latihan relaksasi, dan temukan psikolog terdekat — semua dalam satu tempat.
                    </p>
                    <div class="fade-up fade-up-d3 flex flex-col sm:flex-row gap-4">
                        <a href="/register" class="cta-btn inline-flex items-center justify-center gap-2 px-8 py-4 bg-brand-600 text-white font-bold rounded-2xl text-sm shadow-lg shadow-brand-200 hover:bg-brand-700">
                            💙 Mulai Gratis Sekarang
                        </a>
                        <a href="#cara-kerja" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-brand-700 font-bold rounded-2xl text-sm border-2 border-brand-200 hover:bg-brand-50 transition">
                            ▶ Lihat Cara Kerja
                        </a>
                    </div>
                    <div class="fade-up fade-up-d4 flex flex-wrap items-center gap-4 text-xs font-semibold text-neutralDark/50">
                        <span class="flex items-center gap-1.5">🔒 Data 100% Privat</span>
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                        <span class="flex items-center gap-1.5">⚡ Gratis Selamanya</span>
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                        <span class="flex items-center gap-1.5">🏥 Berbasis Sains CBT/DBT</span>
                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                        <span class="flex items-center gap-1.5">🎓 Untuk Mahasiswa</span>
                    </div>
                </div>

                <!-- Right: Hero visual -->
                <div class="hero-float hidden lg:block">
                    <div class="relative">
                        <!-- Main image card -->
                        <div class="bg-white rounded-3xl shadow-2xl shadow-brand-200/50 overflow-hidden border border-brand-100">
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=700&q=80"
                                 alt="Pemandangan tenang mendukung kesehatan mental"
                                 class="w-full h-72 object-cover">
                            <!-- Floating mood card -->
                            <div class="p-5 space-y-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-bold text-brand-600 uppercase tracking-wide">Mood Hari Ini</p>
                                        <p class="font-outfit font-extrabold text-2xl text-neutralDark">8/10 😊</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-400">7-hari streak</p>
                                        <p class="text-2xl">🔥</p>
                                    </div>
                                </div>
                                <div class="w-full bg-brand-100 rounded-full h-2.5">
                                    <div class="bg-gradient-to-r from-brand-500 to-brand-400 h-2.5 rounded-full" style="width:80%"></div>
                                </div>
                                <p class="text-xs text-gray-400">Lebih baik dari minggu lalu +12% ↑</p>
                            </div>
                        </div>
                        <!-- Floating badge -->
                        <div class="absolute -top-4 -right-4 bg-white rounded-2xl shadow-xl px-4 py-3 border border-brand-100 text-xs font-bold text-brand-700">
                            ✅ Tes Stres: <span class="text-green-600">Ringan</span>
                        </div>
                        <div class="absolute -bottom-4 -left-4 bg-brand-600 rounded-2xl shadow-xl px-4 py-3 text-white text-xs font-bold">
                            🧠 3 Game Terapi Aktif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== SOCIAL PROOF ==================== -->
    <div class="bg-brand-700 text-white py-4 overflow-hidden">
        <div class="flex gap-12 items-center justify-center flex-wrap px-6 text-sm font-semibold opacity-90">
            <span>🎓 Digunakan mahasiswa di seluruh Indonesia</span>
            <span class="hidden sm:inline">·</span>
            <span>🌍 Mendukung UN Sustainable Development Goal 3</span>
            <span class="hidden sm:inline">·</span>
            <span>🔐 Privasi & Keamanan Data 100% Terjamin</span>
            <span class="hidden sm:inline">·</span>
            <span>🆓 Sepenuhnya Gratis</span>
        </div>
    </div>

    <!-- ==================== FITUR ==================== -->
    <section id="fitur" class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16 reveal">
                <span class="inline-block text-xs font-bold bg-brand-50 text-brand-600 border border-brand-200 px-4 py-1.5 rounded-full mb-4">Fitur Unggulan</span>
                <h2 class="text-4xl font-outfit font-extrabold text-neutralDark mb-4">Semua yang Kamu Butuhkan<br>untuk Kesehatan Mental yang Lebih Baik</h2>
                <p class="text-neutralDark/60 max-w-xl mx-auto">Dirancang bersama konsep terapi berbasis bukti (evidence-based therapy) untuk mendukung perjalanan kesehatan mentalmu sehari-hari.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="feature-card bg-white border border-brand-100 rounded-3xl p-7 space-y-4 reveal shadow-sm">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="#396696" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-outfit font-bold text-lg text-neutralDark mb-1">Mood Tracker Harian</h3>
                        <p class="text-sm text-neutralDark/60 leading-relaxed">Catat perasaanmu setiap hari dan lihat tren emosionalmu dalam grafik yang cantik. Sadari pola sebelum stres menumpuk.</p>
                    </div>
                    <a href="/dashboard" class="text-sm font-bold text-brand-600 hover:underline inline-flex items-center gap-1">Mulai Tracking →</a>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card bg-white border border-brand-100 rounded-3xl p-7 space-y-4 reveal shadow-sm">
                    <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    <div>
                        <h3 class="font-outfit font-bold text-lg text-neutralDark mb-1">Tes Stres Mandiri</h3>
                        <p class="text-sm text-neutralDark/60 leading-relaxed">Skrining berbasis 10 pertanyaan klinis untuk burnout akademik, depresi, dan kecemasan. Hasil instan + rekomendasi personal.</p>
                    </div>
                    <a href="/assessment" class="text-sm font-bold text-brand-600 hover:underline inline-flex items-center gap-1">Ikuti Tes →</a>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card bg-white border border-brand-100 rounded-3xl p-7 space-y-4 reveal shadow-sm">
                    <div class="w-12 h-12 bg-sky-50 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="#0284c7" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-outfit font-bold text-lg text-neutralDark mb-1">Teknik Relaksasi</h3>
                        <p class="text-sm text-neutralDark/60 leading-relaxed">Latihan pernapasan terpandu (Box Breathing, 4-7-8), meditasi, dan grounding 5-4-3-2-1 untuk meredakan kecemasan akut.</p>
                    </div>
                    <a href="/relaxation" class="text-sm font-bold text-brand-600 hover:underline inline-flex items-center gap-1">Coba Sekarang →</a>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card bg-white border border-brand-100 rounded-3xl p-7 space-y-4 reveal shadow-sm">
                    <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="#7c3aed" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-outfit font-bold text-lg text-neutralDark mb-1">🎮 Terapi Lewat Game</h3>
                        <p class="text-sm text-neutralDark/60 leading-relaxed">3 permainan terapeutik berbasis CBT & DBT: Ruang Napas, Jurnal Rasa, dan Tangkap Pikiran. Sains dalam kemasan yang menyenangkan.</p>
                    </div>
                    <a href="/games" class="text-sm font-bold text-brand-600 hover:underline inline-flex items-center gap-1">Main Sekarang →</a>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card bg-white border border-brand-100 rounded-3xl p-7 space-y-4 reveal shadow-sm">
                    <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-outfit font-bold text-lg text-neutralDark mb-1">📍 Psikolog Terdekat</h3>
                        <p class="text-sm text-neutralDark/60 leading-relaxed">Temukan psikolog, klinik jiwa, dan konselor kampus di sekitarmu menggunakan GPS. Gratis, tidak butuh akun Google.</p>
                    </div>
                    <a href="/nearby" class="text-sm font-bold text-brand-600 hover:underline inline-flex items-center gap-1">Temukan →</a>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card bg-white border border-brand-100 rounded-3xl p-7 space-y-4 reveal shadow-sm">
                    <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="#e11d48" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <h3 class="font-outfit font-bold text-lg text-neutralDark mb-1">Edukasi SDG 3</h3>
                        <p class="text-sm text-neutralDark/60 leading-relaxed">Artikel, mitos vs fakta, dan panduan kesehatan mental berbasis UN Sustainable Development Goal 3 untuk masyarakat Indonesia.</p>
                    </div>
                    <a href="/education" class="text-sm font-bold text-brand-600 hover:underline inline-flex items-center gap-1">Baca Selengkapnya →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== CARA KERJA ==================== -->
    <section id="cara-kerja" class="py-24 bg-brand-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Image -->
                <div class="reveal">
                    <div class="rounded-3xl overflow-hidden shadow-2xl shadow-brand-200/40 relative">
                        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=700&q=80"
                             alt="Meditasi dan relaksasi untuk kesehatan mental"
                             class="w-full h-full object-cover" style="max-height:480px">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-900/40 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <div class="bg-white/95 backdrop-blur rounded-2xl px-5 py-3.5 flex items-center gap-3">
                                <div class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center text-white text-lg shrink-0">🧘</div>
                                <div>
                                    <p class="text-xs font-bold text-brand-700">Sesi Relaksasi Aktif</p>
                                    <p class="text-xs text-gray-500">Box Breathing — 5 menit tersisa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Steps -->
                <div class="space-y-8 reveal">
                    <div>
                        <span class="text-xs font-bold bg-brand-100 text-brand-600 px-3 py-1.5 rounded-full">Mudah & Cepat</span>
                        <h2 class="text-4xl font-outfit font-extrabold text-neutralDark mt-4 mb-3">Mulai dalam<br>30 Detik</h2>
                        <p class="text-neutralDark/60 text-sm">Tidak butuh setup rumit. Daftar, langsung pakai.</p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex gap-5 items-start">
                            <div class="shrink-0 w-12 h-12 bg-white border-2 border-brand-200 rounded-2xl flex items-center justify-center">
                                <span class="text-2xl font-outfit font-black step-num">1</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-neutralDark mb-1">Daftar dalam 30 Detik</h4>
                                <p class="text-sm text-neutralDark/60 leading-relaxed">Cukup nama dan email. Tidak perlu kartu kredit, tidak ada biaya tersembunyi. Selamanya gratis.</p>
                            </div>
                        </div>

                        <div class="flex gap-5 items-start">
                            <div class="shrink-0 w-12 h-12 bg-white border-2 border-brand-200 rounded-2xl flex items-center justify-center">
                                <span class="text-2xl font-outfit font-black step-num">2</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-neutralDark mb-1">Tes & Catat Moodmu</h4>
                                <p class="text-sm text-neutralDark/60 leading-relaxed">Ikuti tes stres singkat dan mulai catat mood harianmu. Sistem akan mempelajari polamu secara otomatis.</p>
                            </div>
                        </div>

                        <div class="flex gap-5 items-start">
                            <div class="shrink-0 w-12 h-12 bg-white border-2 border-brand-200 rounded-2xl flex items-center justify-center">
                                <span class="text-2xl font-outfit font-black step-num">3</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-neutralDark mb-1">Temukan Pola & Berkembang</h4>
                                <p class="text-sm text-neutralDark/60 leading-relaxed">Lihat statistik mood mingguan, ikuti game terapi, latihan relaksasi, dan akses psikolog jika diperlukan.</p>
                            </div>
                        </div>
                    </div>

                    <a href="/register" class="cta-btn inline-flex items-center gap-2 px-7 py-3.5 bg-brand-600 text-white font-bold rounded-2xl text-sm shadow-lg shadow-brand-200">
                        Mulai Perjalananmu →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== FITUR BARU HIGHLIGHT ==================== -->
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-14 reveal">
                <span class="text-xs font-bold bg-brand-50 text-brand-600 border border-brand-200 px-4 py-1.5 rounded-full">Fitur Terbaru</span>
                <h2 class="text-4xl font-outfit font-extrabold text-neutralDark mt-4">Lebih dari Sekadar Mood Tracker</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card Kiri: Games -->
                <div class="reveal rounded-3xl overflow-hidden border border-brand-100 shadow-sm hover:shadow-xl transition-shadow group">
                    <div class="relative overflow-hidden h-52">
                        <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=700&q=80"
                             alt="Terapi permainan psikologi"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-900/70 to-transparent"></div>
                        <div class="absolute top-4 left-4">
                            <span class="text-[10px] font-bold bg-white/20 backdrop-blur text-white border border-white/30 px-3 py-1 rounded-full">🆕 Baru</span>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <p class="text-2xl font-outfit font-extrabold text-white">🎮 Terapi Game</p>
                        </div>
                    </div>
                    <div class="p-6 bg-white space-y-3">
                        <p class="text-sm text-neutralDark/65 leading-relaxed">3 permainan terapeutik berbasis teknik CBT & DBT yang terbukti klinis: <strong>Ruang Napas</strong> untuk kecemasan, <strong>Jurnal Rasa</strong> untuk depresi, dan <strong>Tangkap Pikiran</strong> untuk overthinking.</p>
                        <a href="/games" class="inline-flex items-center gap-2 text-sm font-bold text-brand-600 hover:text-brand-700 transition">Main Sekarang <span>→</span></a>
                    </div>
                </div>

                <!-- Card Kanan: Psikolog -->
                <div class="reveal rounded-3xl overflow-hidden border border-brand-100 shadow-sm hover:shadow-xl transition-shadow group">
                    <div class="relative overflow-hidden h-52">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=700&q=80"
                             alt="Konsultasi dengan psikolog profesional"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-900/70 to-transparent"></div>
                        <div class="absolute top-4 left-4">
                            <span class="text-[10px] font-bold bg-white/20 backdrop-blur text-white border border-white/30 px-3 py-1 rounded-full">📍 Peta Real-time</span>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <p class="text-2xl font-outfit font-extrabold text-white">📍 Psikolog Terdekat</p>
                        </div>
                    </div>
                    <div class="p-6 bg-white space-y-3">
                        <p class="text-sm text-neutralDark/65 leading-relaxed">Temukan psikolog, klinik kesehatan jiwa, dan konselor kampus terdekat dari lokasimu menggunakan GPS. Powered by OpenStreetMap — gratis, tanpa akun Google, privasi terjamin.</p>
                        <a href="/nearby" class="inline-flex items-center gap-2 text-sm font-bold text-brand-600 hover:text-brand-700 transition">Temukan Sekarang <span>→</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== VIDEO SECTION ==================== -->
    <section class="py-20 bg-brand-50">
        <div class="max-w-3xl mx-auto px-6 text-center space-y-8">
            <div class="reveal">
                <span class="text-xs font-bold bg-brand-100 text-brand-600 px-4 py-1.5 rounded-full">Panduan Meditasi</span>
                <h2 class="text-3xl font-outfit font-extrabold text-neutralDark mt-4 mb-2">10 Menit untuk Tenangkan Pikiranmu</h2>
                <p class="text-sm text-neutralDark/60">Meditasi terpandu untuk kecemasan. Cocok dilakukan sebelum ujian, presentasi, atau saat overthinking.</p>
            </div>
            <div class="reveal rounded-3xl overflow-hidden shadow-2xl shadow-brand-200/50 border border-brand-100" style="aspect-ratio:16/9">
                <iframe
                    src="https://www.youtube.com/embed/inpok4MKVLM"
                    title="10 Minute Meditation for Anxiety"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                    class="w-full h-full">
                </iframe>
            </div>
            <p class="text-xs text-gray-400 reveal">Video dari YouTube — "10 Minute Meditation for Anxiety" oleh Great Meditation</p>
        </div>
    </section>

    <!-- ==================== TESTIMONI ==================== -->
    <section id="testimoni" class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-14 reveal">
                <span class="text-xs font-bold bg-brand-50 text-brand-600 border border-brand-200 px-4 py-1.5 rounded-full">Testimoni Pengguna</span>
                <h2 class="text-4xl font-outfit font-extrabold text-neutralDark mt-4">Cerita dari Mereka yang<br>Sudah Merasakan Manfaatnya</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Testimoni 1 -->
                <div class="testimonial-card bg-brand-50 border border-brand-100 rounded-3xl p-7 space-y-4 reveal">
                    <div class="flex gap-0.5 text-amber-400 text-sm">⭐⭐⭐⭐⭐</div>
                    <p class="text-sm text-neutralDark/75 leading-relaxed italic">"SoulKeep benar-benar membantu saya menyadari pola stres saat skripsi. Fitur tes stresnya sangat akurat dan rekomendasinya berguna banget. Sekarang mood saya jauh lebih stabil."</p>
                    <div class="flex items-center gap-3 pt-2 border-t border-brand-100">
                        <img src="https://i.pravatar.cc/80?img=1" alt="Alya" class="w-10 h-10 rounded-full object-cover border-2 border-brand-200">
                        <div>
                            <p class="font-bold text-sm text-neutralDark">Alya Rahmawati</p>
                            <p class="text-xs text-gray-400">Mahasiswi Psikologi, UGM</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 2 -->
                <div class="testimonial-card bg-brand-50 border border-brand-100 rounded-3xl p-7 space-y-4 reveal">
                    <div class="flex gap-0.5 text-amber-400 text-sm">⭐⭐⭐⭐⭐</div>
                    <p class="text-sm text-neutralDark/75 leading-relaxed italic">"Game 'Tangkap Pikiran' itu unik banget! Cara dia ngajarin cognitive restructuring sambil gamifikasi — rasanya lebih masuk daripada baca teori. Overthinking saya jauh berkurang."</p>
                    <div class="flex items-center gap-3 pt-2 border-t border-brand-100">
                        <img src="https://i.pravatar.cc/80?img=5" alt="Rizky" class="w-10 h-10 rounded-full object-cover border-2 border-brand-200">
                        <div>
                            <p class="font-bold text-sm text-neutralDark">Rizky Firmansyah</p>
                            <p class="text-xs text-gray-400">Mahasiswa Teknik Informatika, ITS</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 3 -->
                <div class="testimonial-card bg-brand-50 border border-brand-100 rounded-3xl p-7 space-y-4 reveal">
                    <div class="flex gap-0.5 text-amber-400 text-sm">⭐⭐⭐⭐⭐</div>
                    <p class="text-sm text-neutralDark/75 leading-relaxed italic">"Fitur psikolog terdekat sangat membantu saat saya butuh bantuan profesional tapi tidak tahu harus ke mana. Dalam 2 menit saya sudah temukan 5 klinik di sekitar kampus saya."</p>
                    <div class="flex items-center gap-3 pt-2 border-t border-brand-100">
                        <img src="https://i.pravatar.cc/80?img=8" alt="Sari" class="w-10 h-10 rounded-full object-cover border-2 border-brand-200">
                        <div>
                            <p class="font-bold text-sm text-neutralDark">Sari Dewi Kusuma</p>
                            <p class="text-xs text-gray-400">Mahasiswi Kedokteran, UNAIR</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== CTA AKHIR ==================== -->
    <section class="py-24 bg-gradient-to-br from-brand-700 via-brand-600 to-[#4B81B7] gradient-animate relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-white rounded-full blur-2xl"></div>
        </div>
        <div class="max-w-3xl mx-auto px-6 text-center relative z-10 space-y-8 reveal">
            <div>
                <span class="inline-block bg-white/15 text-white text-xs font-bold px-4 py-2 rounded-full border border-white/20 mb-5">🌍 Bersama untuk SDG 3</span>
                <h2 class="text-4xl md:text-5xl font-outfit font-extrabold text-white mb-4">Mulai Perjalanan Kesehatan<br>Mentalmu Hari Ini</h2>
                <p class="text-blue-100 text-base leading-relaxed max-w-xl mx-auto">Bergabung dengan ribuan mahasiswa yang sudah memprioritaskan kesehatan mental mereka. Gratis. Selamanya.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register" class="cta-btn px-10 py-4 bg-white text-brand-700 font-extrabold rounded-2xl text-sm shadow-xl hover:shadow-2xl">
                    💙 Daftar Gratis Sekarang
                </a>
                <a href="/login" class="px-10 py-4 bg-white/10 backdrop-blur text-white font-bold rounded-2xl text-sm border border-white/30 hover:bg-white/20 transition">
                    Sudah Punya Akun? Masuk →
                </a>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-6 text-white/70 text-xs font-semibold pt-2">
                <span>✅ Tidak butuh kartu kredit</span>
                <span>·</span>
                <span>✅ Daftar 30 detik</span>
                <span>·</span>
                <span>✅ Hapus kapan saja</span>
            </div>
        </div>
    </section>

    <!-- ==================== FOOTER ==================== -->
    <footer class="bg-neutralDark text-white">
        <div class="max-w-6xl mx-auto px-6 py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Col 1: Brand -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2 text-xl font-outfit font-extrabold">
                        💙 SoulKeep
                    </div>
                    <p class="text-sm text-white/60 leading-relaxed">Platform kesehatan mental gratis untuk mahasiswa Indonesia. Mendukung UN SDG Goal 3.</p>
                    <p class="text-xs text-white/40">© 2026 SoulKeep · Dibuat dengan 💙 untuk Indonesia</p>
                </div>

                <!-- Col 2: Navigasi -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-widest text-white/40 mb-4">Navigasi</h4>
                    <a href="/dashboard" class="block text-sm text-white/70 hover:text-white transition">🏠 Dashboard</a>
                    <a href="/assessment" class="block text-sm text-white/70 hover:text-white transition">📝 Tes Stres</a>
                    <a href="/relaxation" class="block text-sm text-white/70 hover:text-white transition">🌬️ Relaksasi</a>
                    <a href="/games" class="block text-sm text-white/70 hover:text-white transition">🎮 Terapi Game</a>
                    <a href="/nearby" class="block text-sm text-white/70 hover:text-white transition">📍 Psikolog Terdekat</a>
                    <a href="/education" class="block text-sm text-white/70 hover:text-white transition">🌍 Info SDG 3</a>

                </div>

                <!-- Col 3: Sumber Daya -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-widest text-white/40 mb-4">Sumber Daya</h4>
                    <a href="https://sdgs.un.org/goals/goal3" target="_blank" class="block text-sm text-white/70 hover:text-white transition">🌍 Tentang SDG 3</a>
                    <a href="/education" class="block text-sm text-white/70 hover:text-white transition">📖 Panduan Kesehatan Mental</a>

                    <a href="#" class="block text-sm text-white/70 hover:text-white transition">🔐 Kebijakan Privasi</a>
                    <a href="#" class="block text-sm text-white/70 hover:text-white transition">📋 Panduan Penggunaan</a>
                </div>

                <!-- Col 4: Darurat -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-widest text-red-400/80 mb-4">🆘 Bantuan Darurat</h4>
                    <a href="tel:119" class="flex items-center gap-2 text-sm text-white/70 hover:text-white transition">
                        <span class="text-base">📞</span>
                        <div><p class="text-[10px] text-white/40">SEJIWA (Kemenkes)</p><p class="font-bold">119 ext 8</p></div>
                    </a>
                    <a href="tel:08113855472" class="flex items-center gap-2 text-sm text-white/70 hover:text-white transition">
                        <span class="text-base">📱</span>
                        <div><p class="text-[10px] text-white/40">LISA (24 jam)</p><p class="font-bold">0811-385-5472</p></div>
                    </a>
                    <a href="https://www.intothelightid.org" target="_blank" class="flex items-center gap-2 text-sm text-white/70 hover:text-white transition">
                        <span class="text-base">🌐</span>
                        <div><p class="text-[10px] text-white/40">Into The Light</p><p class="font-bold">intothelightid.org</p></div>
                    </a>
                    <a href="https://www.pulih.or.id" target="_blank" class="flex items-center gap-2 text-sm text-white/70 hover:text-white transition">
                        <span class="text-base">💚</span>
                        <div><p class="text-[10px] text-white/40">Yayasan Pulih</p><p class="font-bold">pulih.or.id</p></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 py-5">
            <div class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-white/40">
                <span>SoulKeep adalah proyek pendidikan non-komersial untuk mendukung kesehatan mental mahasiswa.</span>
                <span class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    Semua sistem berjalan normal
                </span>
            </div>
        </div>
    </footer>

    <script>
        // Navbar shadow on scroll
        window.addEventListener('scroll', () => {
            document.getElementById('main-nav').classList.toggle('scrolled', window.scrollY > 40);
        });

        // Scroll reveal
        const observer = new IntersectionObserver(els => {
            els.forEach(el => { if (el.isIntersecting) el.target.classList.add('visible'); });
        }, { threshold: 0.08 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Mobile hamburger
        document.getElementById('hamburger').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Smooth close mobile menu on nav link click
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('mobile-menu').classList.add('hidden');
            });
        });

        // If already logged in, redirect to dashboard
        if (localStorage.getItem('soulkeep_token')) {
            // Show dashboard link instead of register
        }
    </script>
</body>
</html>