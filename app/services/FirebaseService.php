<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FirebaseService
{
    protected $databaseUrl;

    public function __construct()
    {
        $this->databaseUrl = rtrim(env('FIREBASE_DATABASE_URL'), '/');
    }

    public function sendMessage($chatId, $data)
    {
        $url = "{$this->databaseUrl}/chats/{$chatId}/messages.json";
        return Http::post($url, $data)->json();
    }

    public function getMessages($chatId)
    {
        $url = "{$this->databaseUrl}/chats/{$chatId}/messages.json";
        return Http::get($url)->json();
    }
}
