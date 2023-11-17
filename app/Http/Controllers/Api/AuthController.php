<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use \Illuminate\Http\JsonResponse;
use Psy\Util\Json;

//use Nette\Schema\ValidationException;

class AuthController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = \App\Models\User::where('email',$request->email)->first();

        if(!$user){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }
        if(!Hash::check($request->password,$user->password)){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
