<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SoulKeep — Panduan lengkap kesehatan mental, tips self-care harian, mitos vs fakta, kontak bantuan, dan resources untuk mahasiswa Indonesia.">
    <meta name="theme-color" content="#396696">
    <title>Edukasi & Sumber Daya Kesehatan Mental — SoulKeep</title>
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
        /* Education-specific */
        .tab-btn { border-radius:10px; font-weight:700; font-size:.8125rem; padding:.5rem 1rem; transition:all .18s; border:1.5px solid transparent; color:#64748b; background:transparent; cursor:pointer; }
        .tab-btn.active { background:#396696; color:#fff; box-shadow:0 4px 12px rgba(57,102,150,.3); }
        .tab-btn:hover:not(.active) { background:#E4EDF7; color:#1E2229; }
        .tab-content { display: none; }
        .tab-content.active { display: block; animation: fadeUp 0.3s ease-out; }
        .accordion-body { display: none; }
        .accordion-body.open { display: block; }
        .accordion-header:hover { background:#F0ECFF; }
        .accordion-icon { color:#7C5CFC; }
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

    <script>
        if (!localStorage.getItem('soulkeep_token')) window.location.href = '/login';
    </script>

    <!-- Navbar -->
@include('partials.user-sidebar', ['active' => 'education'])

    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 sm:py-8 space-y-6 pb-20 md:pb-8">

        <!-- PROMINENT EMERGENCY ALERT BANNER -->
        <div class="bg-red-50 border-2 border-red-200 rounded-2xl p-4 flex items-center gap-4">
            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center text-2xl shrink-0">🆘</div>
            <div class="flex-1">
                <p class="font-bold text-red-700 text-sm">Butuh Bantuan Segera?</p>
                <p class="text-red-600 text-xs mt-0.5 leading-relaxed">
                    <strong>Into The Light Indonesia:</strong> <a href="tel:119" class="underline font-bold">119 ext 8</a> &nbsp;|&nbsp;
                    <strong>Yayasan Pulih:</strong> <a href="tel:02178842580" class="underline font-bold">(021) 788-42580</a> &nbsp;|&nbsp;
                    <strong>SEJIWA Kemenkes:</strong> <a href="tel:119" class="underline font-bold">119</a>
                </p>
            </div>
            <a href="tel:119" class="shrink-0 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-xs transition">
                📞 Hubungi
            </a>
        </div>

        <!-- Hero Section -->
        <div class="relative overflow-hidden rounded-2xl mb-8 h-[260px] sm:h-[300px] fade-up fade-up-d1">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200&q=70" alt="hero education" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute -top-20 -right-20 w-64 h-64 shape-blob bg-white/5 shape-circle blob-anim hidden sm:block"></div>
            <div class="img-overlay"></div>
            <div class="relative z-10 h-full flex flex-col justify-between p-6 sm:p-8">
                <div>
                    <span class="inline-flex items-center gap-2 text-xs font-bold bg-white/15 text-white px-4 py-1.5 rounded-full border border-white/30 backdrop-blur-sm">🌍 SDG Goal 3 · Kesehatan Mental</span>
                </div>
                <div class="space-y-2">
                    <h1 class="text-3xl sm:text-4xl font-outfit font-black text-white leading-tight">Edukasi Kesehatan Mental</h1>
                    <p class="text-white/80 text-sm sm:text-base max-w-md leading-relaxed">Fakta, tips, dan sumber daya untuk kehidupan yang lebih sehat.</p>
                </div>
            </div>
        </div>

        <!-- Tab Navigator -->
        <div class="bg-white/70 backdrop-blur-md rounded-2xl border border-brand-100 p-1.5 flex flex-wrap gap-2 shadow-sm">
            <button onclick="switchTab('sdg3')" id="tab-sdg3" class="tab-btn flex-1 min-w-fit py-2.5 px-4 text-xs font-bold rounded-xl active">📚 Panduan Awal</button>
            <button onclick="switchTab('tips')" id="tab-tips" class="tab-btn flex-1 min-w-fit py-2.5 px-4 text-xs font-bold rounded-xl text-neutralDark/60">💡 Tips Sehat</button>
            <button onclick="switchTab('contact')" id="tab-contact" class="tab-btn flex-1 min-w-fit py-2.5 px-4 text-xs font-bold rounded-xl text-neutralDark/60">📞 Kontak Bantuan</button>
            <button onclick="switchTab('myths')" id="tab-myths" class="tab-btn flex-1 min-w-fit py-2.5 px-4 text-xs font-bold rounded-xl text-neutralDark/60">🔍 Mitos & Fakta</button>
        </div>

        <!-- TAB 1: TENTANG SDG 3 -->
        <div id="content-sdg3" class="tab-content active space-y-6">
            <div class="bg-white rounded-3xl border border-brand-100 p-6 sm:p-8 shadow-sm space-y-4">
                <h2 class="text-xl font-outfit font-bold text-neutralDark flex items-center gap-2">
                    <span>🌍</span> Keterkaitan Kesehatan Jiwa & SDG 3
                </h2>
                <p class="text-sm text-neutralDark/65 leading-relaxed">
                    Kesehatan mental adalah fondasi mutlak kesejahteraan hidup manusia. Bagi mahasiswa, tekanan akademik yang tinggi, ekspektasi sosial, dan kurangnya waktu tidur seringkali memicu kecemasan atau depresi ringan.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                    <div class="p-4 bg-brand-50 rounded-2xl border border-brand-100 text-center">
                        <p class="text-3xl font-outfit font-extrabold text-brand-600 mb-1">3.4</p>
                        <p class="text-xs font-bold text-neutralDark">Target SDG 3</p>
                        <p class="text-[10px] text-neutralDark/60 mt-1">Promosi kesehatan mental & well-being</p>
                    </div>
                    <div class="p-4 bg-brand-50 rounded-2xl border border-brand-100 text-center">
                        <p class="text-3xl font-outfit font-extrabold text-brand-600 mb-1">1 in 4</p>
                        <p class="text-xs font-bold text-neutralDark">Orang Terdampak</p>
                        <p class="text-[10px] text-neutralDark/60 mt-1">Gangguan mental dalam hidupnya</p>
                    </div>
                    <div class="p-4 bg-brand-50 rounded-2xl border border-brand-100 text-center">
                        <p class="text-3xl font-outfit font-extrabold text-brand-600 mb-1">2030</p>
                        <p class="text-xs font-bold text-neutralDark">Target Global</p>
                        <p class="text-[10px] text-neutralDark/60 mt-1">Tahun pencapaian SDGs</p>
                    </div>
                </div>
            </div>

            <!-- SDG Targets Accordion -->
            <div class="bg-white rounded-3xl border border-brand-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-brand-50">
                    <h2 class="text-xl font-outfit font-bold text-neutralDark">Target SDG 3 Terkait Kesehatan Mental</h2>
                    <p class="text-xs text-neutralDark/50 mt-1">Klik untuk melihat detail masing-masing target</p>
                </div>
                <div>
                    <div class="accordion-item border-b border-brand-50">
                        <button class="accordion-header w-full p-5 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <span class="text-sm font-bold text-neutralDark">🎯 Target 3.4 — Kesehatan Non-Menular & Mental</span>
                            <span class="accordion-icon text-brand-400 text-lg">▼</span>
                        </button>
                        <div class="accordion-body px-5 pb-5">
                            <p class="text-sm text-neutralDark/65 leading-relaxed">
                                Pada tahun 2030, mengurangi sepertiga kematian dini akibat penyakit tidak menular melalui pencegahan dan pengobatan, serta <strong>mempromosikan kesehatan mental dan kesejahteraan hidup</strong>.
                            </p>
                        </div>
                    </div>
                    <div class="accordion-item border-b border-brand-50">
                        <button class="accordion-header w-full p-5 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <span class="text-sm font-bold text-neutralDark">💊 Target 3.8 — Universal Health Coverage</span>
                            <span class="accordion-icon text-brand-400 text-lg">▼</span>
                        </button>
                        <div class="accordion-body px-5 pb-5">
                            <p class="text-sm text-neutralDark/65 leading-relaxed">
                                Mencapai cakupan kesehatan universal, termasuk perlindungan risiko keuangan, akses ke layanan kesehatan esensial berkualitas, dan akses ke obat-obatan serta vaksin yang aman dan efektif.
                            </p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-header w-full p-5 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <span class="text-sm font-bold text-neutralDark">🧑‍⚕️ Peran Mahasiswa dalam SDG 3</span>
                            <span class="accordion-icon text-brand-400 text-lg">▼</span>
                        </button>
                        <div class="accordion-body px-5 pb-5">
                            <p class="text-sm text-neutralDark/65 leading-relaxed">
                                Mahasiswa memiliki peran penting dalam mencapai SDG 3 — dengan menjaga kesehatan mental sendiri, saling mendukung rekan, dan berkontribusi sebagai agent of change dalam mengurangi stigma kesehatan mental di masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quote -->
            <div class="p-6 bg-white border border-brand-100 rounded-3xl text-center max-w-xl mx-auto space-y-2">
                <span class="text-3xl">🌱</span>
                <p class="text-xs sm:text-sm italic text-neutralDark/70 leading-relaxed">
                    "Kesehatan adalah kekayaan terbesar. Kedamaian pikiran adalah kebahagiaan sejati."
                </p>
            </div>

            <!-- SDG Progress Section -->
            <div class="bg-white rounded-3xl border border-[#E4EDF7] p-6 sm:p-8 shadow-sm space-y-6">
                <h2 class="text-xl font-outfit font-bold text-[#1E2229]">🌐 Indonesia &amp; Kesehatan Mental Global</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-5 rounded-2xl bg-gradient-to-br from-[#F4F7FB] to-[#EFF5FC] border border-[#E4EDF7] space-y-2">
                        <p class="text-3xl font-outfit font-extrabold text-[#396696]">19 Juta</p>
                        <p class="text-sm font-bold text-[#1E2229]">Penduduk Indonesia dengan gangguan jiwa</p>
                        <p class="text-xs text-[#64748b] leading-relaxed">Berdasarkan data Riskesdas 2018. Hanya 9% yang mendapat penanganan profesional.</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-gradient-to-br from-[#F4F7FB] to-[#EFF5FC] border border-[#E4EDF7] space-y-2">
                        <p class="text-3xl font-outfit font-extrabold text-[#396696]">1 : 2000</p>
                        <p class="text-sm font-bold text-[#1E2229]">Rasio psikiater per penduduk di Indonesia</p>
                        <p class="text-xs text-[#64748b] leading-relaxed">WHO merekomendasikan minimal 1 psikiater per 30.000 penduduk. Indonesia masih jauh dari target.</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-gradient-to-br from-[#F4F7FB] to-[#EFF5FC] border border-[#E4EDF7] space-y-2">
                        <p class="text-3xl font-outfit font-extrabold text-[#396696]">68%</p>
                        <p class="text-sm font-bold text-[#1E2229]">Mahasiswa pernah mengalami kecemasan tinggi</p>
                        <p class="text-xs text-[#64748b] leading-relaxed">Survei Healthy Minds Network 2023 terhadap mahasiswa di 373 universitas.</p>
                    </div>
                    <div class="p-5 rounded-2xl bg-gradient-to-br from-[#F4F7FB] to-[#EFF5FC] border border-[#E4EDF7] space-y-2">
                        <p class="text-3xl font-outfit font-extrabold text-[#396696]">SDG 3.4</p>
                        <p class="text-sm font-bold text-[#1E2229]">Target PBB: kurangi kematian prematur 1/3</p>
                        <p class="text-xs text-[#64748b] leading-relaxed">Termasuk pencegahan gangguan mental dan promosi well-being hingga tahun 2030.</p>
                    </div>
                </div>
                <div class="p-5 rounded-2xl bg-[#396696] text-white space-y-2">
                    <p class="font-outfit font-bold text-base">💡 Apa yang bisa kamu lakukan?</p>
                    <p class="text-sm text-white/80 leading-relaxed">Dengan menggunakan SoulKeep secara rutin, kamu berkontribusi nyata pada SDG 3 — menjaga kesehatan mentalmu sendiri adalah tindakan yang bermakna.</p>
                    <a href="/assessment" class="inline-block mt-2 bg-white text-[#396696] font-bold text-sm px-4 py-2 rounded-xl hover:bg-[#F4F7FB] transition">Mulai Tes Stres →</a>
                </div>
            </div>
        </div>

        <!-- TAB 2: TIPS KESEHATAN MENTAL -->
        <div id="content-tips" class="tab-content space-y-6">
            <div class="bg-white rounded-3xl border border-brand-100 p-6 sm:p-8 shadow-sm space-y-6">
                <div>
                    <h2 class="text-xl font-outfit font-bold text-neutralDark">Panduan Perawatan Diri Mandiri</h2>
                    <p class="text-[10px] text-neutralDark/40 uppercase tracking-widest font-bold mt-1">Langkah Kecil Berdampak Besar</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-brand-50/50 rounded-2xl border border-brand-100/50 space-y-2">
                        <span class="text-2xl">😴</span>
                        <strong class="text-xs font-bold text-brand-850 block">Pola Tidur Teratur</strong>
                        <p class="text-[10px] text-neutralDark/60 leading-relaxed">Tidur 7-8 jam setiap hari. Matikan gawai 30 menit sebelum tidur untuk kualitas tidur yang lebih baik.</p>
                    </div>
                    <div class="p-4 bg-brand-50/50 rounded-2xl border border-brand-100/50 space-y-2">
                        <span class="text-2xl">🍉</span>
                        <strong class="text-xs font-bold text-brand-850 block">Asupan Nutrisi Sehat</strong>
                        <p class="text-[10px] text-neutralDark/60 leading-relaxed">Makanan bernutrisi mempengaruhi produksi dopamin dan serotonin yang mengontrol perasaan bahagia.</p>
                    </div>
                    <div class="p-4 bg-brand-50/50 rounded-2xl border border-brand-100/50 space-y-2">
                        <span class="text-2xl">🤸</span>
                        <strong class="text-xs font-bold text-brand-850 block">Aktivitas Fisik Ringan</strong>
                        <p class="text-[10px] text-neutralDark/60 leading-relaxed">15 menit olahraga per hari melepaskan hormon endorfin yang meredakan stres secara alami.</p>
                    </div>
                    <div class="p-4 bg-brand-50/50 rounded-2xl border border-brand-100/50 space-y-2">
                        <span class="text-2xl">📵</span>
                        <strong class="text-xs font-bold text-brand-850 block">Detoks Media Sosial</strong>
                        <p class="text-[10px] text-neutralDark/60 leading-relaxed">Batasi medsos saat kamu mulai membandingkan pencapaian hidupmu secara tidak sehat.</p>
                    </div>
                    <div class="p-4 bg-brand-50/50 rounded-2xl border border-brand-100/50 space-y-2">
                        <span class="text-2xl">🌬️</span>
                        <strong class="text-xs font-bold text-brand-850 block">Latihan Pernapasan</strong>
                        <p class="text-[10px] text-neutralDark/60 leading-relaxed">Box breathing atau 4-7-8 selama 5 menit sehari terbukti mengurangi kortisol dan kecemasan.</p>
                    </div>
                    <div class="p-4 bg-brand-50/50 rounded-2xl border border-brand-100/50 space-y-2">
                        <span class="text-2xl">🗣️</span>
                        <strong class="text-xs font-bold text-brand-850 block">Berbicara dengan Orang Dipercaya</strong>
                        <p class="text-[10px] text-neutralDark/60 leading-relaxed">Menceritakan perasaan pada orang terpercaya atau konselor adalah tanda keberanian, bukan kelemahan.</p>
                    </div>
                </div>
            </div>

            <!-- Tips Accordion -->
            <div class="bg-white rounded-3xl border border-brand-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-brand-50">
                    <h2 class="text-xl font-outfit font-bold text-neutralDark">Strategi Menghadapi Situasi Sulit</h2>
                </div>
                <div>
                    <div class="accordion-item border-b border-brand-50">
                        <button class="accordion-header w-full p-5 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <span class="text-sm font-bold text-neutralDark">😰 Saat Merasa Cemas Berlebihan</span>
                            <span class="accordion-icon text-brand-400 text-lg">▼</span>
                        </button>
                        <div class="accordion-body px-5 pb-5">
                            <ul class="text-sm text-neutralDark/65 leading-relaxed space-y-1.5 list-disc pl-4">
                                <li>Coba teknik grounding 5-4-3-2-1: identifikasi 5 hal yang kamu lihat, 4 yang kamu sentuh, dst.</li>
                                <li>Tarik napas dalam 4 detik, tahan 7 detik, hembuskan 8 detik (metode 4-7-8).</li>
                                <li>Jika kecemasan berlanjut lebih dari 2 minggu, pertimbangkan konsultasi ke psikolog.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordion-item border-b border-brand-50">
                        <button class="accordion-header w-full p-5 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <span class="text-sm font-bold text-neutralDark">😔 Saat Merasa Sangat Tertekan (Burnout)</span>
                            <span class="accordion-icon text-brand-400 text-lg">▼</span>
                        </button>
                        <div class="accordion-body px-5 pb-5">
                            <ul class="text-sm text-neutralDark/65 leading-relaxed space-y-1.5 list-disc pl-4">
                                <li>Izinkan dirimu untuk beristirahat tanpa rasa bersalah.</li>
                                <li>Bagi tugas besar menjadi langkah-langkah kecil yang bisa dikelola.</li>
                                <li>Jangan ragu untuk meminta perpanjangan waktu dari dosen jika diperlukan.</li>
                                <li>Hubungi unit konseling kampus untuk sesi gratis.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-header w-full p-5 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <span class="text-sm font-bold text-neutralDark">🌙 Saat Kesulitan Tidur</span>
                            <span class="accordion-icon text-brand-400 text-lg">▼</span>
                        </button>
                        <div class="accordion-body px-5 pb-5">
                            <ul class="text-sm text-neutralDark/65 leading-relaxed space-y-1.5 list-disc pl-4">
                                <li>Coba metode 4-7-8 sebelum tidur — sangat efektif untuk menenangkan sistem saraf.</li>
                                <li>Hindari layar (HP/laptop) 30 menit sebelum tidur.</li>
                                <li>Jaga suhu kamar tetap sejuk (18-22°C ideal untuk tidur).</li>
                                <li>Dengarkan suara alam atau musik instrumental yang menenangkan.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Journaling + Digital Detox Section -->
            <div class="bg-white rounded-3xl border border-[#E4EDF7] p-6 sm:p-8 shadow-sm space-y-6">
                <h2 class="text-xl font-outfit font-bold text-[#1E2229]">📓 Journaling &amp; Digital Detox</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#E4EDF7] flex items-center justify-center text-xl">📓</div>
                            <h3 class="font-outfit font-bold text-[#1E2229]">Journaling Harian</h3>
                        </div>
                        <p class="text-sm text-[#64748b] leading-relaxed">Menulis 5 menit setiap hari terbukti menurunkan kadar kortisol (hormon stres) dan meningkatkan kejernihan pikiran.</p>
                        <div class="space-y-3">
                            <div class="flex gap-3 p-3 rounded-xl bg-[#F4F7FB] border border-[#E4EDF7]">
                                <span class="text-[#396696] font-bold shrink-0">1.</span>
                                <p class="text-xs text-[#64748b]"><strong class="text-[#1E2229]">Gratitude Journal</strong> — Tulis 3 hal yang kamu syukuri hari ini, sekecil apapun.</p>
                            </div>
                            <div class="flex gap-3 p-3 rounded-xl bg-[#F4F7FB] border border-[#E4EDF7]">
                                <span class="text-[#396696] font-bold shrink-0">2.</span>
                                <p class="text-xs text-[#64748b]"><strong class="text-[#1E2229]">Brain Dump</strong> — Tuliskan semua yang ada di pikiran tanpa filter. Kosongkan beban mental.</p>
                            </div>
                            <div class="flex gap-3 p-3 rounded-xl bg-[#F4F7FB] border border-[#E4EDF7]">
                                <span class="text-[#396696] font-bold shrink-0">3.</span>
                                <p class="text-xs text-[#64748b]"><strong class="text-[#1E2229]">Mood Tracker Analog</strong> — Warnai kotak kecil di buku harian sesuai mood harianmu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#E4EDF7] flex items-center justify-center text-xl">📵</div>
                            <h3 class="font-outfit font-bold text-[#1E2229]">Digital Detox</h3>
                        </div>
                        <p class="text-sm text-[#64748b] leading-relaxed">Rata-rata orang memeriksa ponsel 96× sehari. Social media meningkatkan kecemasan hingga 40% pada usia 18–25 tahun.</p>
                        <div class="space-y-2">
                            <div class="flex items-center gap-3 p-3 rounded-xl border border-[#E4EDF7] bg-white">
                                <span class="text-lg">🌅</span>
                                <p class="text-xs text-[#64748b]"><strong class="text-[#1E2229]">30 menit pertama</strong> setelah bangun: no phone. Mulai hari dengan tenang.</p>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-xl border border-[#E4EDF7] bg-white">
                                <span class="text-lg">🌙</span>
                                <p class="text-xs text-[#64748b]"><strong class="text-[#1E2229]">1 jam sebelum tidur</strong>: matikan semua notifikasi dan simpan ponsel.</p>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-xl border border-[#E4EDF7] bg-white">
                                <span class="text-lg">⏰</span>
                                <p class="text-xs text-[#64748b]"><strong class="text-[#1E2229]">Screen time limit</strong>: set app timer 30 menit/hari untuk media sosial.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Check-In CTA -->
            <div class="bg-gradient-to-br from-[#396696] to-[#2E5178] rounded-3xl p-6 sm:p-8 text-white space-y-4">
                <h3 class="font-outfit font-bold text-lg">⚡ Quick Check-In</h3>
                <p class="text-sm text-white/80">Bagaimana kondisimu sekarang? Catat mood sekarang untuk melacak pola emosionalmu.</p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="/dashboard" class="inline-block bg-white text-[#396696] font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-[#F4F7FB] transition text-center">📊 Lihat Dashboard</a>
                    <a href="/assessment" class="inline-block bg-white/20 text-white font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-white/30 transition border border-white/30 text-center">📝 Mulai Tes Stres</a>
                </div>
            </div>
        </div>

        <!-- TAB 3: KONTAK BANTUAN -->
        <div id="content-contact" class="tab-content space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <h2 class="text-xl font-outfit font-bold text-neutralDark">Direktori Bantuan Psikologis</h2>

                    <!-- Hotline 1 -->
                    <div class="p-5 bg-red-50 border border-red-200 rounded-2xl space-y-3">
                        <div class="flex items-center justify-between">
                            <strong class="text-sm font-bold text-red-800">🆘 Into The Light Indonesia</strong>
                            <span class="px-2 py-0.5 bg-red-100 text-red-800 font-bold text-[9px] rounded-full border border-red-200">Hotline Resmi</span>
                        </div>
                        <p class="text-xs text-red-700/80 leading-relaxed">Layanan pencegahan bunuh diri dan dukungan kesehatan mental untuk remaja dan mahasiswa Indonesia.</p>
                        <a href="tel:119" class="inline-flex items-center gap-2 text-sm font-extrabold text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl transition">
                            📞 119 ext 8
                        </a>
                    </div>

                    <!-- Hotline 2 -->
                    <div class="p-5 bg-amber-50 border border-amber-200 rounded-2xl space-y-3">
                        <div class="flex items-center justify-between">
                            <strong class="text-sm font-bold text-amber-900">📞 Yayasan Pulih</strong>
                            <span class="px-2 py-0.5 bg-amber-100 text-amber-900 font-bold text-[9px] rounded-full border border-amber-200">24 Jam</span>
                        </div>
                        <p class="text-xs text-amber-800/80 leading-relaxed">Layanan psikologi dan konseling profesional yang bisa diakses kapan saja.</p>
                        <a href="tel:02178842580" class="inline-flex items-center gap-2 text-sm font-extrabold text-white bg-amber-600 hover:bg-amber-700 px-4 py-2 rounded-xl transition">
                            📞 (021) 788-42580
                        </a>
                    </div>

                    <!-- Hotline 3 -->
                    <div class="p-5 bg-sky-50 border border-sky-200 rounded-2xl space-y-3">
                        <div class="flex items-center justify-between">
                            <strong class="text-sm font-bold text-sky-900">🏥 SEJIWA (Kemenkes RI)</strong>
                            <span class="px-2 py-0.5 bg-sky-100 text-sky-900 font-bold text-[9px] rounded-full border border-sky-200">Resmi Pemerintah</span>
                        </div>
                        <p class="text-xs text-sky-800/80 leading-relaxed">Layanan dukungan psikologi awal gratis oleh Kemenkes RI bekerja sama dengan HIMPSI.</p>
                        <a href="tel:119" class="inline-flex items-center gap-2 text-sm font-extrabold text-white bg-sky-600 hover:bg-sky-700 px-4 py-2 rounded-xl transition">
                            📞 119
                        </a>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-xl font-outfit font-bold text-neutralDark">Sumber Daya Online</h2>

                    <div class="p-5 bg-brand-50 border border-brand-100 rounded-2xl space-y-3">
                        <strong class="text-sm font-bold text-brand-850">🌐 Into The Light Indonesia</strong>
                        <p class="text-xs text-brand-800/70 leading-relaxed">Platform lengkap dengan panduan mencari psikolog/psikiater terdekat, artikel edukasi, dan komunitas dukungan.</p>
                        <a href="https://www.intothelightid.org" target="_blank" rel="noopener"
                            class="inline-flex items-center gap-2 text-xs font-bold text-brand-700 bg-white border border-brand-200 px-4 py-2 rounded-xl transition hover:bg-brand-50">
                            🌐 Kunjungi Website
                        </a>
                    </div>

                    <div class="p-5 bg-green-50 border border-green-200 rounded-2xl space-y-3">
                        <strong class="text-sm font-bold text-green-800">🏫 Konseling Kampus</strong>
                        <p class="text-xs text-green-700/80 leading-relaxed">Hampir semua perguruan tinggi Indonesia menyediakan layanan konseling gratis. Hubungi unit kesehatan kampus atau dosen wali untuk mendapatkan rujukan.</p>
                        <div class="text-xs text-green-700 font-semibold">✓ Gratis &nbsp;|&nbsp; ✓ Rahasia &nbsp;|&nbsp; ✓ Profesional</div>
                    </div>

                    <div class="p-5 bg-purple-50 border border-purple-200 rounded-2xl space-y-3">
                        <strong class="text-sm font-bold text-purple-800">📱 Aplikasi & Platform Digital</strong>
                        <ul class="text-xs text-purple-700/80 space-y-1.5">
                            <li>✦ <strong>Halodoc</strong> — Konsultasi psikolog online</li>
                            <li>✦ <strong>Alodokter</strong> — Chat dengan psikolog</li>
                            <li>✦ <strong>Sehatq</strong> — Direktori psikolog terdekat</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Online Resources -->
            <div class="bg-white rounded-3xl border border-[#E4EDF7] p-6 sm:p-8 shadow-sm space-y-5">
                <h2 class="text-xl font-outfit font-bold text-[#1E2229]">🌐 Sumber Daya Online</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="https://www.intothelightid.org" target="_blank" class="flex gap-4 p-4 rounded-2xl border border-[#E4EDF7] hover:border-[#396696] hover:bg-[#F4F7FB] transition group">
                        <div class="w-10 h-10 rounded-xl bg-[#E4EDF7] flex items-center justify-center text-xl shrink-0">💙</div>
                        <div>
                            <p class="font-bold text-sm text-[#1E2229] group-hover:text-[#396696] transition">Into The Light Indonesia</p>
                            <p class="text-xs text-[#64748b] mt-1">Organisasi pencegahan bunuh diri &amp; edukasi kesehatan jiwa</p>
                            <p class="text-[10px] text-[#396696] mt-1 font-semibold">intothelightid.org →</p>
                        </div>
                    </a>
                    <a href="https://www.who.int/health-topics/mental-health" target="_blank" class="flex gap-4 p-4 rounded-2xl border border-[#E4EDF7] hover:border-[#396696] hover:bg-[#F4F7FB] transition group">
                        <div class="w-10 h-10 rounded-xl bg-[#E4EDF7] flex items-center justify-center text-xl shrink-0">🌍</div>
                        <div>
                            <p class="font-bold text-sm text-[#1E2229] group-hover:text-[#396696] transition">WHO Mental Health</p>
                            <p class="text-xs text-[#64748b] mt-1">Panduan resmi kesehatan mental dari Organisasi Kesehatan Dunia</p>
                            <p class="text-[10px] text-[#396696] mt-1 font-semibold">who.int →</p>
                        </div>
                    </a>
                    <a href="https://yankes.kemkes.go.id" target="_blank" class="flex gap-4 p-4 rounded-2xl border border-[#E4EDF7] hover:border-[#396696] hover:bg-[#F4F7FB] transition group">
                        <div class="w-10 h-10 rounded-xl bg-[#E4EDF7] flex items-center justify-center text-xl shrink-0">🏥</div>
                        <div>
                            <p class="font-bold text-sm text-[#1E2229] group-hover:text-[#396696] transition">Kemenkes RI</p>
                            <p class="text-xs text-[#64748b] mt-1">Layanan kesehatan jiwa resmi Kementerian Kesehatan Indonesia</p>
                            <p class="text-[10px] text-[#396696] mt-1 font-semibold">yankes.kemkes.go.id →</p>
                        </div>
                    </a>
                    <a href="/nearby" class="flex gap-4 p-4 rounded-2xl border border-[#396696] bg-[#F4F7FB] hover:bg-[#E4EDF7] transition group">
                        <div class="w-10 h-10 rounded-xl bg-[#396696] flex items-center justify-center text-xl shrink-0">📍</div>
                        <div>
                            <p class="font-bold text-sm text-[#396696]">Psikolog Terdekat</p>
                            <p class="text-xs text-[#64748b] mt-1">Temukan psikolog &amp; klinik kesehatan jiwa di kotamu</p>
                            <p class="text-[10px] text-[#396696] mt-1 font-semibold">Buka peta →</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- TAB 4: MITOS & FAKTA -->
        <div id="content-myths" class="tab-content space-y-6">
            <div class="bg-white rounded-3xl border border-brand-100 p-6 sm:p-8 shadow-sm space-y-5">
                <div>
                    <h2 class="text-xl font-outfit font-bold text-neutralDark">Mitos & Fakta Kesehatan Mental</h2>
                    <p class="text-xs text-neutralDark/50 mt-1">Klik untuk melihat faktanya</p>
                </div>

                <div class="space-y-3">
                    <div class="accordion-item rounded-2xl border border-brand-100 overflow-hidden">
                        <button class="accordion-header w-full p-4 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-3">
                                <span class="text-lg">❌</span>
                                <span class="text-sm font-bold text-neutralDark">"Masalah mental itu tanda kelemahan jiwa"</span>
                            </div>
                            <span class="accordion-icon text-brand-400 text-sm">▼</span>
                        </button>
                        <div class="accordion-body px-4 pb-4">
                            <div class="flex items-start gap-2">
                                <span class="text-green-500 font-bold text-lg">✓</span>
                                <p class="text-sm text-neutralDark/65 leading-relaxed">
                                    <strong class="text-green-700">FAKTA:</strong> Gangguan mental adalah kondisi medis yang kompleks, sama seperti diabetes atau patah tulang. Butuh keberanian besar untuk menyadari dan mencari bantuan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item rounded-2xl border border-brand-100 overflow-hidden">
                        <button class="accordion-header w-full p-4 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-3">
                                <span class="text-lg">❌</span>
                                <span class="text-sm font-bold text-neutralDark">"Kalau sudah ke psikolog, berarti gila"</span>
                            </div>
                            <span class="accordion-icon text-brand-400 text-sm">▼</span>
                        </button>
                        <div class="accordion-body px-4 pb-4">
                            <div class="flex items-start gap-2">
                                <span class="text-green-500 font-bold text-lg">✓</span>
                                <p class="text-sm text-neutralDark/65 leading-relaxed">
                                    <strong class="text-green-700">FAKTA:</strong> Psikolog membantu semua orang — dari yang mengalami stres ringan hingga yang butuh dukungan intensif. Pergi ke psikolog adalah tanda kecerdasan emosional.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item rounded-2xl border border-brand-100 overflow-hidden">
                        <button class="accordion-header w-full p-4 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-3">
                                <span class="text-lg">❌</span>
                                <span class="text-sm font-bold text-neutralDark">"Stres akademik itu wajar, tidak perlu ditangani"</span>
                            </div>
                            <span class="accordion-icon text-brand-400 text-sm">▼</span>
                        </button>
                        <div class="accordion-body px-4 pb-4">
                            <div class="flex items-start gap-2">
                                <span class="text-green-500 font-bold text-lg">✓</span>
                                <p class="text-sm text-neutralDark/65 leading-relaxed">
                                    <strong class="text-green-700">FAKTA:</strong> Stres ringan memang wajar, tapi stres kronis yang tidak ditangani bisa berkembang menjadi kecemasan klinis, depresi, atau burnout yang jauh lebih berat.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item rounded-2xl border border-brand-100 overflow-hidden">
                        <button class="accordion-header w-full p-4 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-3">
                                <span class="text-lg">❌</span>
                                <span class="text-sm font-bold text-neutralDark">"Depresi bisa hilang hanya dengan berpikir positif"</span>
                            </div>
                            <span class="accordion-icon text-brand-400 text-sm">▼</span>
                        </button>
                        <div class="accordion-body px-4 pb-4">
                            <div class="flex items-start gap-2">
                                <span class="text-green-500 font-bold text-lg">✓</span>
                                <p class="text-sm text-neutralDark/65 leading-relaxed">
                                    <strong class="text-green-700">FAKTA:</strong> Depresi adalah kondisi medis yang melibatkan ketidakseimbangan kimia otak. Meskipun mindset positif membantu, depresi serius membutuhkan penanganan profesional.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item rounded-2xl border border-brand-100 overflow-hidden">
                        <button class="accordion-header w-full p-4 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-3">
                                <span class="text-lg">❌</span>
                                <span class="text-sm font-bold text-neutralDark">"Orang dengan gangguan mental itu berbahaya"</span>
                            </div>
                            <span class="accordion-icon text-brand-400 text-sm">▼</span>
                        </button>
                        <div class="accordion-body px-4 pb-4">
                            <div class="flex items-start gap-2">
                                <span class="text-green-500 font-bold text-lg">✓</span>
                                <p class="text-sm text-neutralDark/65 leading-relaxed">
                                    <strong class="text-green-700">FAKTA:</strong> Sebagian besar orang dengan gangguan mental tidak berbahaya. Stigma ini justru berbahaya karena mencegah orang mencari bantuan yang mereka butuhkan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item rounded-2xl border border-brand-100 overflow-hidden">
                        <button class="accordion-header w-full p-4 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-3">
                                <span class="text-lg">❌</span>
                                <span class="text-sm font-bold text-neutralDark">"Terapi/konseling hanya untuk orang gila"</span>
                            </div>
                            <span class="accordion-icon text-brand-400 text-sm">▼</span>
                        </button>
                        <div class="accordion-body px-4 pb-4">
                            <div class="flex items-start gap-2 pt-3">
                                <span class="text-green-500 font-bold text-lg">✓</span>
                                <p class="text-sm text-neutralDark/65 leading-relaxed"><strong class="text-green-700">FAKTA:</strong> Terapi adalah layanan kesehatan untuk siapa pun yang ingin memahami dirinya lebih baik — sama seperti olahraga untuk tubuh. Mayoritas klien terapis adalah orang-orang yang ingin tumbuh, bukan yang "sakit parah".</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item rounded-2xl border border-brand-100 overflow-hidden">
                        <button class="accordion-header w-full p-4 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-3">
                                <span class="text-lg">❌</span>
                                <span class="text-sm font-bold text-neutralDark">"Depresi bisa hilang cukup dengan berpikir positif"</span>
                            </div>
                            <span class="accordion-icon text-brand-400 text-sm">▼</span>
                        </button>
                        <div class="accordion-body px-4 pb-4">
                            <div class="flex items-start gap-2 pt-3">
                                <span class="text-green-500 font-bold text-lg">✓</span>
                                <p class="text-sm text-neutralDark/65 leading-relaxed"><strong class="text-green-700">FAKTA:</strong> Depresi adalah kondisi medis yang melibatkan ketidakseimbangan kimiawi di otak. Menyuruh orang depresi "berpikir positif" sama seperti menyuruh penderita diabetes untuk "berpikir sehat". Butuh penanganan yang tepat.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item rounded-2xl border border-brand-100 overflow-hidden">
                        <button class="accordion-header w-full p-4 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-3">
                                <span class="text-lg">❌</span>
                                <span class="text-sm font-bold text-neutralDark">"Anak muda tidak bisa mengalami burnout"</span>
                            </div>
                            <span class="accordion-icon text-brand-400 text-sm">▼</span>
                        </button>
                        <div class="accordion-body px-4 pb-4">
                            <div class="flex items-start gap-2 pt-3">
                                <span class="text-green-500 font-bold text-lg">✓</span>
                                <p class="text-sm text-neutralDark/65 leading-relaxed"><strong class="text-green-700">FAKTA:</strong> Burnout tidak mengenal usia. Tekanan akademik, deadline tugas, dan tuntutan sosial membuat mahasiswa justru sangat rentan. WHO secara resmi mengakui burnout sebagai fenomena pekerjaan/studi yang perlu ditangani.</p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item rounded-2xl border border-brand-100 overflow-hidden">
                        <button class="accordion-header w-full p-4 flex justify-between items-center text-left" onclick="toggleAccordion(this)">
                            <div class="flex items-center gap-3">
                                <span class="text-lg">❌</span>
                                <span class="text-sm font-bold text-neutralDark">"Obat kesehatan mental membuat ketergantungan"</span>
                            </div>
                            <span class="accordion-icon text-brand-400 text-sm">▼</span>
                        </button>
                        <div class="accordion-body px-4 pb-4">
                            <div class="flex items-start gap-2 pt-3">
                                <span class="text-green-500 font-bold text-lg">✓</span>
                                <p class="text-sm text-neutralDark/65 leading-relaxed"><strong class="text-green-700">FAKTA:</strong> Sebagian besar antidepresan dan antiansietas modern tidak bersifat adiktif jika dikonsumsi sesuai resep dokter. Penghentian selalu dilakukan bertahap di bawah pengawasan profesional.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Quick Mood Check-in Widget -->
    <div class="max-w-lg mx-auto w-full px-6 pb-8 md:pb-10">
        <div class="bg-white rounded-2xl border border-brand-100 p-6 shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <div class="text-3xl">💙</div>
                <div>
                    <h3 class="font-bold text-neutralDark text-sm">Bagaimana Perasaanmu Sekarang?</h3>
                    <p class="text-xs text-neutralDark/50">Catat moodmu langsung dari sini — tersimpan ke dashboard.</p>
                </div>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-xs font-semibold text-neutralDark">Skala Mood (1-10)</span>
                    <div class="flex items-center gap-2">
                        <span id="edu-score-emoji" class="text-lg">🙂</span>
                        <span class="text-xl font-outfit font-extrabold text-brand-600" id="edu-score-display">5</span>
                    </div>
                </div>
                <input type="range" id="edu-mood-score" min="1" max="10" value="5"
                    class="w-full h-2 bg-brand-100 rounded-lg appearance-none cursor-pointer accent-brand-600"
                    oninput="updateEduScore(this.value)">
                <div class="flex justify-between text-[10px] text-gray-400 px-0.5">
                    <span>😞 Buruk</span><span>😄 Sangat Baik</span>
                </div>
                <button onclick="submitEduMood()" id="edu-submit-btn"
                    class="w-full bg-brand-600 text-white font-bold py-3 rounded-xl hover:bg-brand-700 transition text-sm">
                    💾 Simpan Mood Sekarang
                </button>
                <div id="edu-mood-msg" class="hidden text-center text-xs font-semibold py-2.5 rounded-xl"></div>
            </div>
        </div>
    </div>

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
        function switchTab(tab) {
            const tabs = ['sdg3', 'tips', 'contact', 'myths'];
            tabs.forEach(t => {
                const btn = document.getElementById(`tab-${t}`);
                const content = document.getElementById(`content-${t}`);
                if (t === tab) {
                    btn.classList.add('active'); btn.classList.remove('text-neutralDark/60');
                    content.classList.add('active');
                } else {
                    btn.classList.remove('active'); btn.classList.add('text-neutralDark/60');
                    content.classList.remove('active');
                }
            });
        }

        function toggleAccordion(btn) {
            const body = btn.nextElementSibling;
            const icon = btn.querySelector('.accordion-icon');
            const isOpen = body.classList.contains('open');
            // Close all accordions in parent container
            const container = btn.closest('.space-y-3');
            if (container) {
                container.querySelectorAll('.accordion-body').forEach(b => {
                    b.classList.remove('open');
                });
                container.querySelectorAll('.accordion-icon').forEach(i => {
                    i.style.transform = '';
                });
            }
            // Open clicked one if it was closed
            if (!isOpen) {
                body.classList.add('open');
                icon.style.transform = 'rotate(180deg)';
            }
        }

        // =====================
        // QUICK MOOD CHECK-IN
        // =====================
        const eduEmojis = {1:'😞',2:'😞',3:'😔',4:'😐',5:'🙂',6:'🙂',7:'😊',8:'😄',9:'😄',10:'🤩'};

        function updateEduScore(val) {
            document.getElementById('edu-score-display').textContent = val;
            document.getElementById('edu-score-emoji').textContent = eduEmojis[parseInt(val)];
        }

        async function submitEduMood() {
            const token = localStorage.getItem('soulkeep_token');
            if (!token) { window.location.href = '/login'; return; }
            const score = parseInt(document.getElementById('edu-mood-score').value);
            const btn = document.getElementById('edu-submit-btn');
            const msg = document.getElementById('edu-mood-msg');

            btn.disabled = true;
            btn.textContent = 'Menyimpan...';

            try {
                const r = await fetch('/api/moods', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-API-KEY': 'rahasia-uas-123',
                        'Authorization': `Bearer ${token}`
                    },
                    body: JSON.stringify({ score, notes: 'Dicatat dari halaman Edukasi & Info SDG 3' })
                });
                const d = await r.json();
                msg.className = 'text-center text-xs font-semibold py-2.5 rounded-xl ' +
                    (r.ok ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200');
                msg.textContent = r.ok
                    ? `✓ Mood ${score}/10 berhasil disimpan! Terlihat di dashboard kamu.`
                    : (d.error || 'Gagal menyimpan mood');
                msg.classList.remove('hidden');
            } catch(e) {
                msg.className = 'text-center text-xs font-semibold py-2.5 rounded-xl bg-red-50 text-red-700 border border-red-200';
                msg.textContent = 'Gagal terhubung ke server';
                msg.classList.remove('hidden');
            } finally {
                btn.disabled = false;
                btn.textContent = '💾 Simpan Mood Sekarang';
            }
        }

        // Navbar: tampilkan nama user + logout
        const _name = localStorage.getItem('soulkeep_name') || 'Pengguna';
        const _el = document.getElementById('user-name');
        if (_el) _el.textContent = _name;
        const _av = document.getElementById('user-avatar');
        if (_av) _av.textContent = (localStorage.getItem('soulkeep_name') || 'P')[0].toUpperCase();
        window.addEventListener('scroll', () => { const nav = document.getElementById('main-nav'); if (nav) nav.classList.toggle('scrolled', window.scrollY > 10); });
        function logout() { localStorage.clear(); window.location.href = '/login'; }
        // Verify tab system on load
        console.log('switchTab function loaded:', typeof switchTab);
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Tab elements found:', document.querySelectorAll('.tab-btn').length);
            console.log('Content elements found:', document.querySelectorAll('.tab-content').length);
        });
    </script>
</body>
</html>
