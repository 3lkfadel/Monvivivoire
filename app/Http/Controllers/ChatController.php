<?php

// app/Http/Controllers/ChatController.php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function createConversation($userId)
    {
        $user = Auth::user();
        $conversation = Conversation::firstOrCreate([
            'user1_id' => $user->id,
            'user2_id' => $userId,
        ]);

        return redirect()->route('chat.show', $conversation->id);
    }

    public function showConversation($conversationId)
    {
        $conversation = Conversation::with('messages.user')->findOrFail($conversationId);
        return view('chat.show', compact('conversation'));
    }

    public function sendMessage(Request $request, $conversationId)
    {
        $conversation = Conversation::findOrFail($conversationId);
        $message = new Message([
            'user_id' => Auth::user()->id,
            'message' => $request->message,
        ]);
        $conversation->messages()->save($message);

        return redirect()->route('chat.show', $conversationId);
    }
}
