@extends('layouts.app')

@section('title', 'Chat Room')

@section('extra_styles')
/* Chat layout */
.chat-container { height: calc(100vh - 64px); display: flex; }
.messages-area { flex: 1; overflow-y: auto; padding: 1.5rem; scroll-behavior: smooth; }
.messages-area::-webkit-scrollbar { width: 4px; }
.messages-area::-webkit-scrollbar-track { background: transparent; }
.messages-area::-webkit-scrollbar-thumb { background: #C7DCEF; border-radius: 4px; }
.bubble { max-width: 70%; word-break: break-word; }
.bubble-own { background: linear-gradient(135deg,#396696,#4B81B7); color:white; }
.bubble-other { background: white; color: #1E2229; border: 1px solid #E4EDF7; }
@keyframes bubblePop { from{opacity:0;transform:scale(0.92) translateY(6px)} to{opacity:1;transform:scale(1) translateY(0)} }
.bubble-new { animation: bubblePop 0.2s ease-out; }
.input-area { border-top: 1px solid #E4EDF7; background: white; padding: 1rem 1.5rem; }
@endsection

@section('content')
@php
    $currentUserId = session('user.id');
    $isTherapist   = $role === 'therapist';
    $other         = $isTherapist ? $room->user : $room->therapist;
    $backUrl       = $isTherapist ? '/therapist/dashboard' : '/chat';
    $sendUrl       = $isTherapist ? "/therapist/room/{$room->id}/send" : "/chat/room/{$room->id}/send";
    $readUrl       = $isTherapist ? "/therapist/room/{$room->id}/read" : "/chat/room/{$room->id}/read";
    $pollUrl       = $isTherapist ? "/therapist/room/{$room->id}/messages" : "/chat/room/{$room->id}/messages";
    $jitsiRoom     = 'soulkeep-room-' . $room->id;
@endphp

<div class="chat-container bg-brand-50/50">

    {{-- ── LEFT SIDEBAR: Room list / back link ─────────────── --}}
    <div class="w-72 shrink-0 bg-white border-r border-brand-100 flex flex-col hidden lg:flex">
        {{-- Header --}}
        <div class="p-4 border-b border-brand-100 flex items-center gap-3">
            <a href="{{ $backUrl }}" class="p-2 rounded-xl hover:bg-brand-50 transition text-brand-600 font-bold text-sm">←</a>
            <div>
                <p class="font-outfit font-bold text-sm text-neutralDark">{{ $isTherapist ? 'Panel Terapis' : 'Chat Terapis' }}</p>
                <p class="text-[11px] text-gray-400">Pilih percakapan</p>
            </div>
        </div>

        {{-- Active room highlight --}}
        <div class="p-3 flex-1 overflow-y-auto">
            <div class="flex items-center gap-3 p-3 bg-brand-50 rounded-2xl border border-brand-100">
                <img src="{{ $other->avatar_url }}" alt="{{ $other->name }}"
                    class="w-10 h-10 rounded-full object-cover border-2 border-brand-200 shrink-0">
                <div class="min-w-0">
                    <p class="font-bold text-sm text-neutralDark truncate">{{ $other->name }}</p>
                    <p class="text-[11px] text-gray-400">{{ $isTherapist ? 'Pengguna' : 'Terapis' }}</p>
                </div>
                <span class="w-2 h-2 bg-emerald-400 rounded-full shrink-0 ml-auto"></span>
            </div>
        </div>

        {{-- Status / close room (therapist only) --}}
        @if($isTherapist && $room->status === 'active')
        <div class="p-4 border-t border-brand-100">
            <form method="POST" action="/therapist/room/{{ $room->id }}/close">
                @csrf
                <button type="submit"
                    onclick="return confirm('Tutup sesi chat ini?')"
                    class="w-full py-2.5 bg-rose-100 text-rose-700 text-xs font-bold rounded-xl hover:bg-rose-600 hover:text-white transition">
                    🔒 Tutup Sesi Chat
                </button>
            </form>
        </div>
        @endif
    </div>

    {{-- ── MAIN CHAT AREA ───────────────────────────────────── --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Chat Header --}}
        <div class="bg-white border-b border-brand-100 px-5 py-3.5 flex items-center gap-4 shadow-sm">
            <a href="{{ $backUrl }}" class="lg:hidden p-2 rounded-xl hover:bg-brand-50 transition text-brand-600 font-bold">←</a>

            <img src="{{ $other->avatar_url }}" alt="{{ $other->name }}"
                class="w-10 h-10 rounded-full object-cover border-2 border-brand-200 shrink-0">
            <div class="flex-1 min-w-0">
                <p class="font-outfit font-bold text-sm text-neutralDark">{{ $other->name }}</p>
                <p class="text-[11px] text-gray-400 flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full {{ $room->status === 'active' ? 'bg-emerald-400' : 'bg-gray-300' }}"></span>
                    {{ $room->status === 'active' ? 'Sesi Aktif' : 'Sesi Ditutup' }}
                </p>
            </div>

            {{-- Video Call Button --}}
            @if($room->status === 'active')
            <button onclick="startVideoCall()"
                class="flex items-center gap-2 px-4 py-2 bg-brand-600 text-white text-xs font-bold rounded-xl hover:bg-brand-700 transition shadow-md">
                🎥 Video Call
            </button>
            @endif

            @if($isTherapist && $room->status === 'active')
            <form method="POST" action="/therapist/room/{{ $room->id }}/close" class="lg:hidden">
                @csrf
                <button type="submit" onclick="return confirm('Tutup sesi ini?')"
                    class="px-3 py-2 bg-rose-100 text-rose-700 text-xs font-bold rounded-xl hover:bg-rose-600 hover:text-white transition">
                    🔒 Tutup
                </button>
            </form>
            @endif
        </div>

        {{-- Closed room banner --}}
        @if($room->status === 'closed')
        <div class="bg-amber-50 border-b border-amber-200 px-5 py-3 text-xs text-amber-800 font-semibold text-center">
            🔒 Sesi chat ini telah ditutup oleh terapis.
        </div>
        @endif

        {{-- Therapist pending warning (only for therapist view) --}}
        @if($isTherapist && session('user.status') === 'pending')
        <div class="bg-amber-50 border-b border-amber-200 px-5 py-3 text-xs text-amber-800 font-semibold text-center">
            ⏳ Menunggu verifikasi admin — Akun kamu belum disetujui.
        </div>
        @endif

        {{-- Messages --}}
        <div class="messages-area" id="messages-area">
            @if($messages->isEmpty())
                <div class="flex flex-col items-center justify-center h-full text-center py-12 opacity-60">
                    <span class="text-5xl mb-3">💬</span>
                    <p class="text-sm text-gray-400 font-semibold">Belum ada pesan</p>
                    <p class="text-xs text-gray-300 mt-1">Kirim pesan pertama untuk memulai percakapan!</p>
                </div>
            @else
                <div id="messages-list" class="space-y-3">
                    @foreach($messages as $msg)
                    @php $isOwn = $msg->sender_id == $currentUserId; @endphp
                    <div class="flex {{ $isOwn ? 'justify-end' : 'justify-start' }} items-end gap-2" data-msg-id="{{ $msg->id }}">
                        @if(!$isOwn)
                            <img src="{{ $msg->sender->avatar_url }}" alt="{{ $msg->sender->name }}"
                                class="w-7 h-7 rounded-full object-cover border border-brand-100 shrink-0 mb-1">
                        @endif
                        <div class="bubble {{ $isOwn ? 'bubble-own' : 'bubble-other' }} px-4 py-2.5 rounded-2xl {{ $isOwn ? 'rounded-br-sm' : 'rounded-bl-sm' }} shadow-sm">
                            @if(!$isOwn)
                                <p class="text-[10px] font-bold mb-1 opacity-60">{{ $msg->sender->name }}</p>
                            @endif
                            <p class="text-sm leading-relaxed">{{ $msg->body }}</p>
                            <p class="text-[10px] mt-1 {{ $isOwn ? 'text-white/60' : 'text-gray-400' }} text-right">
                                {{ $msg->created_at->format('H:i') }}
                                @if($isOwn)
                                    {{ $msg->is_read ? '✓✓' : '✓' }}
                                @endif
                            </p>
                        </div>
                        @if($isOwn)
                            <img src="{{ session('user.avatar_url') ?? 'https://ui-avatars.com/api/?name=' . urlencode(session('user.name')) . '&background=396696&color=fff' }}"
                                alt="Me" class="w-7 h-7 rounded-full object-cover border border-brand-100 shrink-0 mb-1">
                        @endif
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Message Input --}}
        @if($room->status === 'active')
        <div class="input-area">
            <form id="msg-form" class="flex items-end gap-3">
                @csrf
                <div class="flex-1 bg-brand-50 border border-brand-100 rounded-2xl px-4 py-2.5 flex items-end">
                    <textarea id="msg-input" rows="1"
                        placeholder="Tulis pesan... (Enter untuk kirim)"
                        class="flex-1 bg-transparent text-sm text-neutralDark focus:outline-none resize-none leading-relaxed max-h-28"
                        onkeydown="handleKey(event)"
                        oninput="autoResize(this)"></textarea>
                </div>
                <button type="submit" id="send-btn"
                    class="w-11 h-11 bg-brand-600 text-white rounded-2xl hover:bg-brand-700 transition shadow-md flex items-center justify-center shrink-0 text-lg">
                    ➤
                </button>
            </form>
        </div>
        @else
        <div class="input-area text-center text-sm text-gray-400 py-4">
            Sesi ini telah ditutup. Tidak dapat mengirim pesan.
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    const CURRENT_USER_ID = {{ session('user.id') }};
    const SEND_URL        = '{{ $sendUrl }}';
    const POLL_URL        = '{{ $pollUrl }}';
    const CSRF_TOKEN      = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
    const JITSI_ROOM      = '{{ $jitsiRoom }}';

    // ── Scroll to bottom ──────────────────────────────────────────────
    function scrollBottom(smooth = true) {
        const area = document.getElementById('messages-area');
        area.scrollTo({ top: area.scrollHeight, behavior: smooth ? 'smooth' : 'auto' });
    }
    scrollBottom(false);

    // ── Determine last message ID ─────────────────────────────────────
    function getLastId() {
        const msgs = document.querySelectorAll('[data-msg-id]');
        if (!msgs.length) return 0;
        return parseInt(msgs[msgs.length - 1].getAttribute('data-msg-id'));
    }

    // ── Append new messages from polling ─────────────────────────────
    function appendMessage(msg) {
        const isOwn = msg.sender_id == CURRENT_USER_ID;
        const list  = document.getElementById('messages-list');
        if (!list) {
            // First message — replace empty state
            const area = document.getElementById('messages-area');
            area.innerHTML = '<div id="messages-list" class="space-y-3"></div>';
        }

        const avatarSrc = `https://ui-avatars.com/api/?name=${encodeURIComponent(msg.sender)}&background=396696&color=fff`;

        const html = `
        <div class="flex ${isOwn ? 'justify-end' : 'justify-start'} items-end gap-2 bubble-new" data-msg-id="${msg.id}">
            ${!isOwn ? `<img src="${avatarSrc}" alt="${msg.sender}" class="w-7 h-7 rounded-full object-cover border border-brand-100 shrink-0 mb-1">` : ''}
            <div class="bubble ${isOwn ? 'bubble-own' : 'bubble-other'} px-4 py-2.5 rounded-2xl ${isOwn ? 'rounded-br-sm' : 'rounded-bl-sm'} shadow-sm">
                ${!isOwn ? `<p class="text-[10px] font-bold mb-1 opacity-60">${msg.sender}</p>` : ''}
                <p class="text-sm leading-relaxed">${escHtml(msg.body)}</p>
                <p class="text-[10px] mt-1 ${isOwn ? 'text-white/60' : 'text-gray-400'} text-right">${msg.time}</p>
            </div>
            ${isOwn ? `<img src="${avatarSrc}" alt="Me" class="w-7 h-7 rounded-full object-cover border border-brand-100 shrink-0 mb-1">` : ''}
        </div>`;

        document.getElementById('messages-list').insertAdjacentHTML('beforeend', html);
        scrollBottom();
    }

    function escHtml(str) {
        return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    // ── Send message ──────────────────────────────────────────────────
    document.getElementById('msg-form')?.addEventListener('submit', async function(e) {
        e.preventDefault();
        const input = document.getElementById('msg-input');
        const body  = input.value.trim();
        if (!body) return;

        const btn = document.getElementById('send-btn');
        btn.disabled = true;
        btn.textContent = '⏳';

        try {
            const resp = await fetch(SEND_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
                body: JSON.stringify({ body })
            });
            const data = await resp.json();
            if (resp.ok) {
                input.value = '';
                input.style.height = 'auto';
                appendMessage({ ...data, sender_id: CURRENT_USER_ID });
            }
        } catch(err) {
            console.error('Send error:', err);
        } finally {
            btn.disabled = false;
            btn.textContent = '➤';
            input.focus();
        }
    });

    // ── Keyboard handler ──────────────────────────────────────────────
    function handleKey(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('msg-form').dispatchEvent(new Event('submit'));
        }
    }

    // ── Textarea auto-resize ──────────────────────────────────────────
    function autoResize(el) {
        el.style.height = 'auto';
        el.style.height = Math.min(el.scrollHeight, 112) + 'px';
    }

    // ── Polling (every 3 seconds) ─────────────────────────────────────
    @if($room->status === 'active')
    setInterval(async function() {
        const lastId = getLastId();
        try {
            const resp = await fetch(`${POLL_URL}?after=${lastId}`, {
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN }
            });
            const msgs = await resp.json();
            if (Array.isArray(msgs)) {
                msgs.forEach(msg => {
                    // Only append messages from others (own messages already appended on send)
                    if (msg.sender_id != CURRENT_USER_ID) {
                        appendMessage(msg);
                    } else if (!document.querySelector(`[data-msg-id="${msg.id}"]`)) {
                        appendMessage(msg);
                    }
                });
            }
        } catch(err) { /* silent */ }
    }, 3000);
    @endif

    // ── Video Call (Jitsi Meet) ───────────────────────────────────────
    function startVideoCall() {
        window.open(`https://meet.jit.si/${JITSI_ROOM}`, '_blank', 'noopener');
    }
</script>
@endsection
