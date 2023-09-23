<?php

namespace App\Http\Controllers\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Users\CreateUserForm;
use App\Http\Requests\V1\Users\PatchUserForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        return response()->json($users);
    }

    public function store(CreateUserForm $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);

            \Log::info("Create user", $data);
            User::make($data)->save();
        } catch (\Throwable $th) {
            \Log::warning($th->getMessage(), $th->getTrace());

            return response()->json([
                'success' => false,
                'message' => 'Fail to insert user',
            ], 400);
        }

        return response()->json([], 201);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function patch(PatchUserForm $request, User $user)
    {
        try {
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
}
