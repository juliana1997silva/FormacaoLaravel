<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signin(Request $request)
    {
        $credentials = $request->only("email", "password");
        if(Auth::attempt($credentials) === false) {
            return response()->json('Não autorizado', 401);
        }
        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('token')->plainTextToken;
        return response()->json($token,200);
    }

    public function register(Request $request)
    {
        User::create([
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'name' => $request->nome,
        ]);
        return response()->json('Usuario criado');
    }
}
