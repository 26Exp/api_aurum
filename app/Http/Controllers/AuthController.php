<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * @return array
     */
    public function authorized()
    {
        $token = auth()->user()->createToken('AppToken')->plainTextToken;

        return [
            'user' => auth()->user()->getUserProfile(),
            'token' => $token
        ];
    }

    /**
     * @param StoreUserRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|
     */
    public function register(StoreUserRequest $request){
        $fields = $request->validated();

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $request->get('phone'),
            'password' => bcrypt($fields['password']),
            'role' => 1,
            'locale' => $request->get('locale') ?? 'ru',
        ]);

        return response($this->authorized(), 201);
    }

    /**
     * @param AuthUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthUserRequest $request){
        $credentials = $request->validated();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response($this->authorized(), 200);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response(['message' => 'Successfully logged out'], 200);
    }

    public function user()
    {
        if (auth()->check()) {
            return response(Auth::user()->getUserProfile(), 200);
        } else {
            return response(['message' => 'Not logged in'], 401);
        }
    }
}


