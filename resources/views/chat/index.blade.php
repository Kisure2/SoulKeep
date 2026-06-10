@extends('layouts.app')

@section('title', 'Chat dengan Terapis')

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

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-outfit font-extrabold text-neutralDark">💬 Chat dengan Terapis</h1>
        <p class="text-sm text-gray-500 mt-1">Konsultasikan kondisi mentalmu dengan terapis yang telah diverifikasi.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" style="min-height:600px">

        {{-- LEFT PANEL: Room List --}}
        <div class="bg-white rounded-2xl border border-brand-100 shadow-sm overflow-hidden flex flex-col" style="max-height:650px">
            <div class="p-4 border-b border-brand-100 flex items-center justify-between">
                <p class="font-outfit font-bold text-sm text-neutralDark">Percakapan</p>
                <a href="/chat/therapists" class="text-xs font-bold text-brand-600 hover:underline">+ Cari Terapis</a>
            </div>

            <div class="flex-1 overflow-y-auto p-2">
                @forelse($rooms as $room)
                @php $lastMsg = $room->messages->first(); $therapist = $room->therapist; @endphp
                <div class="chat-room-item" onclick="openRoom({{ $room->id }}, '{{ addslashes($therapist->name ?? 'Terapis') }}')" id="room-item-{{ $room->id }}">
                    <div class="w-11 h-11 rounded-full bg-[#E4EDF7] flex items-center justify-center font-bold text-[#396696] text-sm flex-shrink-0 overflow-hidden">
                        @if($therapist && $therapist->avatar)
                            <img src="{{ $therapist->avatar_url ?? '' }}" alt="{{ $therapist->name }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr($therapist->name ?? 'T', 0, 1)) }}
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <p class="font-semibold text-sm text-neutralDark truncate">{{ $therapist->name ?? 'Terapis' }}</p>
                            @if($lastMsg)
                            <span class="text-[10px] text-gray-400 flex-shrink-0 ml-1">{{ $lastMsg->created_at->format('H:i') }}</span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-400 truncate">
                            @if($lastMsg)
                                {{ Str::limit($lastMsg->body, 38) }}
                            @else
                                <span class="italic">Mulai percakapan...</span>
                            @endif
                        </p>
                    </div>
                </div>
                @empty
                <div class="flex flex-col items-center justify-center h-48 text-center px-4">
                    <span class="text-4xl mb-3">💬</span>
                    <p class="text-sm font-semibold text-neutralDark">Belum ada percakapan</p>
                    <p class="text-xs text-gray-400 mt-1">Temukan terapis untuk mulai chat</p>
                    <a href="/chat/therapists" class="mt-3 text-xs font-bold text-brand-600 hover:underline">Cari Terapis →</a>
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
                <p class="text-sm text-gray-400 mt-1 text-center max-w-xs">Klik terapis di panel kiri untuk memulai atau melanjutkan chat</p>
                <a href="/chat/therapists"
                    class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 transition shadow-md text-sm">
                    🔍 Temukan Terapis
                </a>
            </div>

            {{-- Chat Window --}}
            <div id="chat-window" class="hidden bg-white rounded-2xl border border-brand-100 shadow-sm flex-col" style="height:650px;display:none">
                {{-- Chat Header --}}
                <div class="p-4 border-b border-brand-100 flex items-center gap-3 flex-shrink-0">
                    <div id="chat-avatar"
                        class="w-10 h-10 rounded-full bg-[#E4EDF7] flex items-center justify-center font-bold text-brand-700 text-sm flex-shrink-0">T</div>
                    <div class="flex-1">
                        <p id="chat-name" class="font-outfit font-bold text-neutralDark">Terapis</p>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 inline-block"></span>
                            <span class="text-xs text-emerald-600 font-semibold">Aktif</span>
                        </div>
                    </div>
                    <span class="text-xs text-gray-300">Auto-refresh setiap 5s</span>
                </div>

                {{-- Messages Area --}}
                <div id="messages-area" class="flex-1 overflow-y-auto p-4 space-y-3"></div>

                {{-- Typing indicator area --}}
                <div id="no-msgs" class="hidden text-center text-sm text-gray-400 py-6">
                    Belum ada pesan. Mulai percakapan! 👋
                </div>

                {{-- Input Area --}}
                <div class="p-4 border-t border-brand-100 flex gap-2 flex-shrink-0">
                    <input id="msg-input" type="text" placeholder="Tulis pesan..."
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

    function openRoom(roomId, therapistName) {
        currentRoomId = roomId;
        lastMsgCount = 0;

        // Highlight active room
        document.querySelectorAll('.chat-room-item').forEach(el => el.classList.remove('active'));
        document.getElementById('room-item-' + roomId)?.classList.add('active');

        // Update header
        document.getElementById('chat-name').textContent = therapistName;
        document.getElementById('chat-avatar').textContent = therapistName.charAt(0).toUpperCase();

        // Show chat window
        document.getElementById('chat-empty').style.display = 'none';
        const win = document.getElementById('chat-window');
        win.style.display = 'flex';
        win.style.flexDirection = 'column';
        win.classList.remove('hidden');

        // Load messages + start polling
        loadMessages(roomId);
        clearInterval(refreshTimer);
        refreshTimer = setInterval(() => loadMessages(roomId), 5000);
    }

    async function loadMessages(roomId) {
        try {
            const res = await fetch(`/chat/room/${roomId}/messages?after=0`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            if (!res.ok) return;
            const msgs = await res.json();
            renderMessages(Array.isArray(msgs) ? msgs : (msgs.messages || []));
        } catch(e) { console.warn('loadMessages error:', e); }
    }

    function renderMessages(msgs) {
        const area = document.getElementById('messages-area');
        if (msgs.length === lastMsgCount && msgs.length > 0) return; // no change
        lastMsgCount = msgs.length;

        if (msgs.length === 0) {
            area.innerHTML = '<div class="text-center text-gray-400 text-sm py-10">Belum ada pesan. Mulai percakapan! 👋</div>';
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
            const res = await fetch(`/chat/room/${currentRoomId}/send`, {
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
</script>
@endsection
