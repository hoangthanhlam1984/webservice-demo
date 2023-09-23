<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginForm;
use App\Http\Requests\V1\Users\PatchUserForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginForm $request)
    {
        try {
            /** @var User **/
            $user = User::where('email', $request->email)->firstOrFail();

            if ($user->verifyPassword($request->password)) {
                /** @var \Laravel\Sanctum\NewAccessToken **/
                $token = $user->createToken('login-' . $user->email);

                return response()->json([
                    'id'    => $user->id,
                    'email' => $user->email,
                    'token' => $token->plainTextToken,
                ]);
            }
        } catch (\Throwable $th) {
            report($th);
        }

        return response()->json([
            'message'    => 'Fail to login'
        ], 401);
    }

    public function show(Request $request)
    {
        try {
            /** @var User **/
            $user = $request->user();

            return response()->json($user->toArray());
        } catch (\Throwable $th) {
            report($th);
        }

        return response()->json([
            'message'    => 'Fail to get info'
        ], 401);
    }

    public function patch(PatchUserForm $request)
    {
        try {
            $user = $request->user();
            $data = $request->validated();

            $user->update($data);
        } catch (\Throwable $th) {
            report($th);
            return response()->json([
                'success' => false,
                'message' => 'Fail to update the user',
            ], 400);
        }

        return response()->json($user);
    }

    public function logout(Request $request)
    {
        try {
            /** @var User **/
            $user = $request->user();
            $user->tokens()->delete();

            return response()->json();
        } catch (\Throwable $th) {
            report($th);
            return response()->json([
                'message' => 'Fail to logout'
            ], 400);
        }
    }
}
