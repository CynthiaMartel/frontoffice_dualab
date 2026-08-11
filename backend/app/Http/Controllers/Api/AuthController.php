<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\AccountBlockedNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private const MAX_FAILED_ATTEMPTS = 5;

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json(['user' => new UserResource($user)], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user          = User::where('email', $request->email)->first();
        $validPassword = $user && Hash::check($request->password, $user->password);

        if (! $validPassword || $user->blocked) {
            if ($user && ! $validPassword && ! $user->blocked) {
                $user->increment('failed_login_attempts');

                if ($user->failed_login_attempts >= self::MAX_FAILED_ATTEMPTS) {
                    $user->forceFill(['blocked' => true])->save();
                    $user->notify(new AccountBlockedNotification());
                }
            }

            throw ValidationException::withMessages([
                'email' => ['Las credenciales no son correctas.'],
            ]);
        }

        $user->update(['failed_login_attempts' => 0]);

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json(['user' => new UserResource($user)]);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Sesión cerrada correctamente.']);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json(new UserResource($request->user()->load('inscripciones')));
    }
}
