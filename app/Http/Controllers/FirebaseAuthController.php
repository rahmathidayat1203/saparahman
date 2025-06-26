<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Auth as FirebaseAuth;

class FirebaseAuthController extends Controller
{
    public function generateCustomToken(Request $request)
    {
        $uid = (string) Auth::user()->id;
        $firebaseAuth = app(FirebaseAuth::class);
        $customToken = $firebaseAuth->createCustomToken($uid);

        return response()->json(['token' => $customToken->toString()]);
    }
}
