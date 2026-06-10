@extends('layouts.app')

@section('title', 'Panel Terapis — SoulKeep')

@section('extra_styles')
.chat-room-item { transition: all 0.2s ease; cursor: pointer; border-radius: 1rem; padding: 0.75rem; display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.25rem; }
.chat-room-item:hover { background: #F4F7FB; }
.chat-room-item.active { background: #E4EDF7; border-left: 3px solid #396696; padding-left: calc(0.75rem - 3px); }
.msg-bubble-me { background: #396696; color: #fff; border-radius: 1.25rem 1.25rem 0.25rem 1.25rem; }
.msg-bubble-other { background: #F4F7FB; color: #1E2229; border-radius: 1.25rem 1.25rem 1.25rem 0.25rem; }
#messages-area { scroll-behavior: smooth; }
.chat-input-field { flex: 1; border: 1.5px solid #E4EDF7; border-radius: 0.875rem; padding: 0.6rem 1rem; font-size: 0.875rem; font-family: inherit; outline: none; background: #F4F7FB; transition: border-color 0.2s; }
.chat-input-field:focus { border-color: #396696; background: #fff; }
.send-btn { background: #396696; color: #fff; font-weight: 700; border: none; border-radius: 0.875rem; padding: 0.6rem 1.25rem; font-size: 0.875rem; cursor: pointer; transition: all 0.2s; flex-shrink: 0; }
.send-btn:hover { background: #2E5178; }
.send-btn:disabled { opacity: 0.5; cursor: not-allowed; }
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">

    {{-- Status Banners --}}
    @if(session('user.status') === 'pending')
    <div class="mb-6 flex items-start gap-3 bg-amber-50 border border-amber-200 rounded-2xl px-5 py-4">
        <span class="text-xl mt-0.5">⏳</span>
        <div>
            <p class="font-bold text-amber-800 text-sm">Menunggu Verifikasi Admin</p>
            <p class="text-xs text-amber-700 mt-0.5">Akun terapis kamu sedang ditinjau. Biasanya 1–2 hari kerja.</p>
        </div>
    </div>
    @elseif(session('user.status') === 'rejected')
    <div class="mb-6 flex items-start gap-3 bg-rose-50 border border-rose-200 rounded-2xl px-5 py-4">
        <span class="text-xl mt-0.5">❌</span>
        <div>
            <p class="font-bold text-rose-800 text-sm">Pendaftaran Ditolak</p>
            <p class="text-xs text-rose-700 mt-0.5">Hubungi admin untuk informasi lebih lanjut.</p>
        </div>
    </div>
    @endif

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-2xl font-outfit font-extrabold text-neutralDark">💬 Panel Terapis</h1>
            <p class="text-sm text-gray-500 mt-1">
                Selamat datang, {{ session('user.name') }}. 
                {{ $rooms->count() }} percakapan aktif.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" style="min-height:600px">

        {{-- LEFT PANEL: Room / Patient List --}}
        <div class="bg-white rounded-2xl border border-brand-100 shadow-sm overflow-hidden flex flex-col" style="max-height:650px">
            <div class="p-4 border-b border-brand-100">
                <p class="font-outfit font-bold text-sm text-neutralDark">Pasien Aktif</p>
                <p class="text-xs text-gray-400 mt-0.5">{{ $rooms->count() }} percakapan</p>
            </div>

            <div class="flex-1 overflow-y-auto p-2">
                @forelse($rooms as $room)
                @php $patient = $room->user; $lastMsg = $room->messages->first(); @endphp
                <div class="chat-room-item" onclick="openRoom({{ $room->id }}, '{{ addslashes($patient->name ?? 'Pengguna') }}')" id="room-item-{{ $room->id }}">
                    <div class="w-11 h-11 rounded-full bg-[#E4EDF7] flex items-center justify-center font-bold text-brand-700 text-sm flex-shrink-0 overflow-hidden">
                        @if($patient && $patient->avatar)
                            <img src="{{ $patient->avatar_url ?? '' }}" alt="{{ $patient->name }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr($patient->name ?? 'P', 0, 1)) }}
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <p class="font-semibold text-sm text-neutralDark truncate">{{ $patient->name ?? 'Pengguna' }}</p>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full flex-shrink-0 ml-1
                                {{ $room->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $room->status === 'active' ? 'Aktif' : 'Tutup' }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-400 truncate">
                            @if($lastMsg) {{ Str::limit($lastMsg->body, 38) }}
                            @else <span class="italic">Belum ada pesan</span>
                            @endif
                        </p>
                    </div>
                </div>
                @empty
                <div class="flex flex-col items-center justify-center h-48 text-center px-4">
                    <span class="text-4xl mb-3">📭</span>
                    <p class="text-sm font-semibold text-neutralDark">Belum ada percakapan</p>
                    @if(session('user.status') !== 'active')
                    <p class="text-xs text-gray-400 mt-1">Tunggu verifikasi akun kamu</p>
                    @else
                    <p class="text-xs text-gray-400 mt-1">Pasien akan menghubungimu segera</p>
                    @endif
                </div>
                @endforelse
            </div>
        </div>

        {{-- RIGHT PANEL: Chat Window --}}
        <div class="lg:col-span-2">

            {{-- Empty State --}}
            <div id="chat-empty" class="h-full bg-white rounded-2xl border border-brand-100 shadow-sm flex flex-col items-center justify-center py-20">
                <span class="text-6xl mb-4">💙</span>
                <p class="font-outfit font-bold text-neutralDark text-lg">Pilih percakapan</p>
                <p class="text-sm text-gray-400 mt-1 text-center max-w-xs">Klik nama pasien di panel kiri untuk membuka chat</p>
            </div>

            {{-- Chat Window --}}
            <div id="chat-window" class="hidden bg-white rounded-2xl border border-brand-100 shadow-sm flex-col" style="height:650px;display:none">

                {{-- Chat Header --}}
                <div class="p-4 border-b border-brand-100 flex items-center gap-3 flex-shrink-0">
                    <div id="chat-avatar"
                        class="w-10 h-10 rounded-full bg-[#E4EDF7] flex items-center justify-center font-bold text-brand-700 text-sm flex-shrink-0">P</div>
                    <div class="flex-1">
                        <p id="chat-name" class="font-outfit font-bold text-neutralDark">Pasien</p>
                        <p class="text-xs text-gray-400">Sesi konsultasi</p>
                    </div>
                    <button id="close-room-btn" onclick="closeRoom()"
                        class="text-xs font-bold text-rose-600 border border-rose-200 px-3 py-1.5 rounded-lg hover:bg-rose-50 transition">
                        ✕ Tutup Sesi
                    </button>
                </div>

                {{-- Messages Area --}}
                <div id="messages-area" class="flex-1 overflow-y-auto p-4 space-y-3"></div>

                {{-- Input --}}
                <div class="p-4 border-t border-brand-100 flex gap-2 flex-shrink-0">
                    <input id="msg-input" type="text" placeholder="Balas pesan pasien..."
                        class="chat-input-field"
                        onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();sendMessage();}">
                    <button onclick="sendMessage()" id="send-btn" class="send-btn">Kirim ➤</button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const myId = {{ session('user.id', 0) }};
    let currentRoomId = null;
    let refreshTimer = null;
    let lastMsgCount = 0;
    const csrfToken = document.querySelector('meta[name=csrf-token]').content;

    function openRoom(roomId, patientName) {
        currentRoomId = roomId;
        lastMsgCount = 0;

        document.querySelectorAll('.chat-room-item').forEach(el => el.classList.remove('active'));
        document.getElementById('room-item-' + roomId)?.classList.add('active');

        document.getElementById('chat-name').textContent = patientName;
        document.getElementById('chat-avatar').textContent = patientName.charAt(0).toUpperCase();

        document.getElementById('chat-empty').style.display = 'none';
        const win = document.getElementById('chat-window');
        win.style.display = 'flex';
        win.style.flexDirection = 'column';
        win.classList.remove('hidden');

        loadMessages(roomId);
        clearInterval(refreshTimer);
        refreshTimer = setInterval(() => loadMessages(roomId), 5000);
    }

    async function loadMessages(roomId) {
        try {
            const res = await fetch(`/therapist/room/${roomId}/messages?after=0`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrfToken }
            });
            if (!res.ok) return;
            const msgs = await res.json();
            renderMessages(Array.isArray(msgs) ? msgs : (msgs.messages || []));
        } catch(e) { console.warn('loadMessages error:', e); }
    }

    function renderMessages(msgs) {
        const area = document.getElementById('messages-area');
        if (msgs.length === lastMsgCount && msgs.length > 0) return;
        lastMsgCount = msgs.length;

        if (msgs.length === 0) {
            area.innerHTML = '<div class="text-center text-gray-400 text-sm py-10">Belum ada pesan. 👋</div>';
            return;
        }

        area.innerHTML = msgs.map(m => {
            const isMe = m.sender_id === myId;
            const time = new Date(m.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            const body = m.body ?? m.message ?? '';
            return `<div class="flex ${isMe ? 'justify-end' : 'justify-start'}">
                <div class="max-w-xs sm:max-w-sm px-4 py-2.5 text-sm ${isMe ? 'msg-bubble-me' : 'msg-bubble-other'}">
                    <p>${esc(body)}</p>
                    <p class="text-[10px] mt-1 ${isMe ? 'text-white/60' : 'text-gray-400'}">${time}</p>
                </div>
            </div>`;
        }).join('');

        area.scrollTop = area.scrollHeight;
    }

    function esc(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }

    async function sendMessage() {
        const input = document.getElementById('msg-input');
        const body  = input.value.trim();
        if (!body || !currentRoomId) return;

        input.value = '';
        const btn = document.getElementById('send-btn');
        btn.disabled = true;

        try {
            const res = await fetch(`/therapist/room/${currentRoomId}/send`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ body })
            });
            if (res.ok) { await loadMessages(currentRoomId); }
        } catch(e) { console.warn('sendMessage error:', e); }
        finally { btn.disabled = false; input.focus(); }
    }

    async function closeRoom() {
        if (!currentRoomId || !confirm('Tutup sesi chat dengan pasien ini?')) return;
        try {
            await fetch(`/therapist/room/${currentRoomId}/close`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest' }
            });
            window.location.reload();
        } catch(e) { console.warn('closeRoom error:', e); }
    }
</script>
@endsection
