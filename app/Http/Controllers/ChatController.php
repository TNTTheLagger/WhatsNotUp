<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // Get all chat rooms (for now, assuming only one chat room)
        $chatRoom = ChatRoom::first();

        // Get all messages from the chat room
        $messages = $chatRoom->messages()->whereNull('parent_id')->latest()->get();

        return view('chat.inner', compact('chatRoom', 'messages'));
    }

    public function storeMessage(Request $request)
    {
        // Validate the message input
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Create a new message
        $chatRoom = ChatRoom::first();  // Get the first (or specific) chat room
        $message = new Message([
            'user_id' => Auth::id(),
            'room_id' => $chatRoom->id,
            'content' => $request->input('content'),
        ]);
        $message->save();

        return redirect()->route('chat.inner');
    }

    public function storeReply(Request $request)
    {
        // Validate the reply input
        $request->validate([
            'content' => 'required|string|max:255',
            'parent_id' => 'required|exists:messages,id',
        ]);

        // Create a new reply message
        $chatRoom = ChatRoom::first();  // Get the first (or specific) chat room
        $parentMessage = Message::find($request->input('parent_id'));

        $message = new Message([
            'user_id' => Auth::id(),
            'room_id' => $chatRoom->id,
            'content' => $request->input('content'),
            'parent_id' => $parentMessage->id,  // Set the parent ID for the reply
        ]);
        $message->save();

        return redirect()->route('chat.inner');
    }
}
