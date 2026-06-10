<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * List chat rooms.
     * - user role: shows own rooms with therapist info
     * - therapist role: shows own rooms with user info
     */
    public function index()
    {
        $role   = session('role');
        $userId = session('user.id');

        if ($role === 'therapist') {
            $rooms = ChatRoom::where('therapist_id', $userId)
                ->with(['user', 'messages' => function ($q) {
                    $q->latest()->limit(1);
                }])
                ->latest()
                ->get();
            return view('therapist.dashboard', compact('rooms'));
        }

        // user
        $rooms = ChatRoom::where('user_id', $userId)
            ->with(['therapist', 'messages' => function ($q) {
                $q->latest()->limit(1);
            }])
            ->latest()
            ->get();
        return view('chat.index', compact('rooms'));
    }

    /**
     * List active therapists for a user to start chat with.
     */
    public function therapists()
    {
        $therapists = User::therapists()->get();
        return view('chat.therapists', compact('therapists'));
    }

    /**
     * Find or create a chat room between user and therapist, then redirect.
     */
    public function startRoom(User $therapist)
    {
        $userId = session('user.id');

        $room = ChatRoom::firstOrCreate(
            ['user_id' => $userId, 'therapist_id' => $therapist->id],
            ['status' => 'active']
        );

        return redirect()->route('chat.room', $room->id);
    }

    /**
     * Show the chat room view (shared for user and therapist).
     */
    public function room(ChatRoom $room)
    {
        $userId = session('user.id');

        // Authorize: must be user or therapist of this room
        if ($room->user_id !== $userId && $room->therapist_id !== $userId) {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }

        $messages = $room->messages()->with('sender:id,name,avatar')->orderBy('id')->get();

        // Mark incoming messages as read
        $room->messages()
            ->where('sender_id', '!=', $userId)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        $role = session('role');
        return view('chat.room', compact('room', 'messages', 'role'));
    }

    /**
     * Send a new message to a room (returns JSON).
     */
    public function sendMessage(Request $request, ChatRoom $room)
    {
        $userId = session('user.id');

        if ($room->user_id !== $userId && $room->therapist_id !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate(['body' => 'required|string|max:2000']);

        $message = Message::create([
            'room_id'   => $room->id,
            'sender_id' => $userId,
            'body'      => $request->body,
            'is_read'   => 0,
        ]);

        $message->load('sender:id,name,avatar');

        return response()->json([
            'id'     => $message->id,
            'body'   => $message->body,
            'sender' => $message->sender->name,
            'time'   => $message->created_at->format('H:i'),
        ]);
    }

    /**
     * Mark all unread messages (from other party) as read.
     */
    public function markRead(ChatRoom $room)
    {
        $userId = session('user.id');

        $room->messages()
            ->where('sender_id', '!=', $userId)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        return response()->json(['status' => 'ok']);
    }

    /**
     * Close a room (therapist only).
     */
    public function closeRoom(ChatRoom $room)
    {
        $userId = session('user.id');

        if ($room->therapist_id !== $userId) {
            return redirect()->back()->with('error', 'Hanya terapis yang dapat menutup sesi.');
        }

        $room->update(['status' => 'closed']);

        return redirect('/therapist/dashboard')->with('success', 'Sesi chat telah ditutup.');
    }

    /**
     * Polling endpoint — returns messages after a given ID.
     * GET /chat/room/{room}/messages?after={last_id}
     */
    public function messages(ChatRoom $room, Request $request)
    {
        $userId = session('user.id');

        if ($room->user_id !== $userId && $room->therapist_id !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $msgs = $room->messages()
            ->where('id', '>', $request->input('after', 0))
            ->with('sender:id,name,avatar')
            ->get()
            ->map(function ($m) {
                return [
                    'id'         => $m->id,
                    'body'       => $m->body,
                    'sender_id'  => $m->sender_id,
                    'sender'     => $m->sender->name ?? '',
                    'created_at' => $m->created_at->toISOString(),
                    'time'       => $m->created_at->format('H:i'),
                ];
            });

        return response()->json($msgs);
    }

    // ─── API Methods (JWT auth, return JSON) ────────────────────────────────────

    /** GET /api/therapists — list verified & active therapists */
    public function getTherapists()
    {
        return response()->json(
            User::therapists()->select('id', 'name', 'avatar', 'address')->get()
        );
    }

    /** POST /api/chat/start — find or create a room with a therapist */
    public function startChat(Request $request)
    {
        $request->validate(['therapist_id' => 'required|integer']);

        $therapist = User::where('id', $request->therapist_id)
            ->where('role', 'therapist')
            ->where('status', 'active')
            ->firstOrFail();

        $room = ChatRoom::firstOrCreate(
            ['user_id' => auth('api')->id(), 'therapist_id' => $therapist->id],
            ['status'  => 'active']
        );

        return response()->json($room->load('therapist:id,name,avatar'));
    }

    /** GET /api/chat/rooms — rooms for current user (role-aware) */
    public function myRooms()
    {
        $user = auth('api')->user();

        if ($user->role === 'therapist') {
            $rooms = ChatRoom::where('therapist_id', $user->id)
                ->with('user:id,name,avatar')
                ->latest()->get();
        } else {
            $rooms = ChatRoom::where('user_id', $user->id)
                ->with('therapist:id,name,avatar')
                ->latest()->get();
        }

        return response()->json($rooms);
    }

    /** GET /api/chat/rooms/{id}/messages */
    public function getMessages($roomId)
    {
        $room = ChatRoom::findOrFail($roomId);
        $user = auth('api')->user();

        if ($room->user_id !== $user->id && $room->therapist_id !== $user->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return response()->json(
            $room->messages()->with('sender:id,name,avatar')->orderBy('id')->get()
        );
    }

    /** POST /api/chat/rooms/{id}/messages */
    public function apiSendMessage(Request $request, $roomId)
    {
        $request->validate(['message' => 'required|string|max:2000']);

        $room = ChatRoom::findOrFail($roomId);
        $user = auth('api')->user();

        if ($room->user_id !== $user->id && $room->therapist_id !== $user->id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $msg = Message::create([
            'room_id'   => $room->id,
            'sender_id' => $user->id,
            'body'      => $request->message,
            'is_read'   => 0,
        ]);

        return response()->json($msg->load('sender:id,name,avatar'), 201);
    }
}
