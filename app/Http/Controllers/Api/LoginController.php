<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $data = $request->validated();
        
        if (!Auth::attempt($data)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = $request->user();

        $accessToken = $user->createToken('Personal Access Token')->accessToken;

        return response([
            'user' => $user,
            'token_type' => 'Bearer',
            'access_token' => $accessToken,
        ]);
    }
}
