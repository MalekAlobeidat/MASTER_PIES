<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function sign_up(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|confirmed',
                'role_id' => 'required'
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role_id' => $data['role_id']
            ]);

            $artisan = null;

            if ($user->role_id == 2) {
                $artisanData = [
                    'years_of_experience' => 0,
                    'user_id' => $user->id,
                ];
                $artisan = Artisan::create($artisanData);
            }

            $res = [
                'user' => $user,
                'artisan' => $artisan,
            ];

            return response()->json($res, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating user or artisan'], 500);
        }
    }
    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);

            $user = User::where('email', $data['email'])->first();

            if (!$user || !Hash::check($data['password'], $user->password)) {
                return response(['msg' => 'Incorrect username or password'], 401);
            }

            $token = $user->createToken('apiToken')->plainTextToken;
            $user->load('artisan');

            $res = [
                'user' => $user,
                'token' => $token,
            ];

            return response()->json($res, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error during login'], 500);
        }
    }
    public function logout(Request $request)
    {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message' => 'User logged out'
            ]);
    }
}
