<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginForm;
use App\Http\Requests\V1\Users\PatchUserForm;
use App\Models\User;
use Illuminate\Http\Request;

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
            \Log::warning('Fail to login ' . $th->getMessage(), $th->getTrace());
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
            \Log::warning('Fail to get info ' . $th->getMessage(), $th->getTrace());
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
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            \Log::info("Change user", $data);
            $user->update($data);
        } catch (\Throwable $th) {
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
            \Log::warning('fail to logout ' . $th->getMessage(), $th->getTrace());
            return response()->json([
                'message' => 'Fail to logout'
            ], 400);
        }
    }
}
