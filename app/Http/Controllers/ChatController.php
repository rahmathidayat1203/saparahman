<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;

class ChatController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index($chatId)
    {
        $messages = $this->firebase->getMessages($chatId);
        return view('chat.index', compact('chatId', 'messages'));
    }

    public function send(Request $request, $chatId)
    {
        $this->firebase->sendMessage($chatId, [
            'sender' => $request->user()->name,
            'message' => $request->message,
            'timestamp' => now()->timestamp
        ]);

        return redirect()->route('chat.index', $chatId);
    }
}
