<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Mentor;
use App\Models\Startup;

class MessageController extends Controller
{
    /**
     * Display the user's inbox with all active conversations.
     */
    public function inbox(Request $request)
    {
        $currentUserId = $request->session()->get('user_id');
        $currentUserRole = $request->session()->get('user_role');

        if (!$currentUserId) {
            return redirect()->route('login');
        }

        // Fetch all messages involving this user
        $messages = Message::where('sender_id', $currentUserId)
                           ->orWhere('receiver_id', $currentUserId)
                           ->orderBy('created_at', 'desc')
                           ->get();

        // Group into distinct conversations
        $conversations = collect();
        foreach ($messages as $message) {
            $isSender = $message->sender_id === $currentUserId && $message->sender_type === $currentUserRole;
            $otherId = $isSender ? $message->receiver_id : $message->sender_id;
            $otherType = $isSender ? $message->receiver_type : $message->sender_type;
            
            $convoKey = $otherType . '_' . $otherId;
            
            if (!$conversations->has($convoKey)) {
                $otherUser = null;
                if ($otherType === 'mentor') {
                    $otherUser = Mentor::find($otherId);
                } elseif ($otherType === 'startup') {
                    $otherUser = Startup::find($otherId);
                }
                
                if ($otherUser) {
                    $conversations->put($convoKey, [
                        'otherType' => $otherType,
                        'otherId' => $otherId,
                        'otherUser' => $otherUser,
                        'latestMessage' => $message,
                    ]);
                }
            }
        }

        return view('messages.inbox', compact('conversations', 'currentUserRole'));
    }

    /**
     * Display the chat interface with a specific user.
     */
    public function index(Request $request, $receiverType, $receiverId)
    {
        $currentUserId = $request->session()->get('user_id');
        $currentUserRole = $request->session()->get('user_role');

        if (!$currentUserId) {
            return redirect()->route('login');
        }

        // Validate receiver
        if ($receiverType === 'mentor') {
            $receiver = Mentor::findOrFail($receiverId);
        } elseif ($receiverType === 'startup') {
            $receiver = Startup::findOrFail($receiverId);
        } else {
            abort(404);
        }

        // Fetch messages between these two users
        $messages = Message::where(function ($query) use ($currentUserId, $currentUserRole, $receiverId, $receiverType) {
            $query->where('sender_id', $currentUserId)
                  ->where('sender_type', $currentUserRole)
                  ->where('receiver_id', $receiverId)
                  ->where('receiver_type', $receiverType);
        })->orWhere(function ($query) use ($currentUserId, $currentUserRole, $receiverId, $receiverType) {
            $query->where('sender_id', $receiverId)
                  ->where('sender_type', $receiverType)
                  ->where('receiver_id', $currentUserId)
                  ->where('receiver_type', $currentUserRole);
        })->orderBy('created_at', 'asc')->get();

        return view('messages.index', compact('messages', 'receiver', 'receiverType', 'receiverId', 'currentUserId', 'currentUserRole'));
    }

    /**
     * Store a new message.
     */
    public function store(Request $request, $receiverType, $receiverId)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $currentUserId = $request->session()->get('user_id');
        $currentUserRole = $request->session()->get('user_role');

        if (!$currentUserId) {
            return redirect()->route('login');
        }

        Message::create([
            'sender_id' => $currentUserId,
            'sender_type' => $currentUserRole,
            'receiver_id' => $receiverId,
            'receiver_type' => $receiverType,
            'content' => $validated['content'],
        ]);

        return back();
    }
}
