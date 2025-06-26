<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;

class FirebaseController extends Controller
{
    protected FirebaseService $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function store()
    {
        $data = [
            'name' => 'Ujang',
            'email' => 'ujang@example.com',
        ];

        $result = $this->firebase->push('users', $data);

        return response()->json(['result' => $result]);
    }

    public function index()
    {
        $users = $this->firebase->get('users');
        return response()->json(['users' => $users]);
    }

    public function deleteUser($userId)
    {
        $this->firebase->delete("users/{$userId}");
        return response()->json(['message' => 'Deleted']);
    }
}
