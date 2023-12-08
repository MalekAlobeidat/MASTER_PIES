<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        try {
            $users = User::with('role')->get();
            return response()->json(['users' => $users], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching users'], 500);
        }
    }

// app/Http/Controllers/UserController.php

    public function show(User $user)
    {
        try {
            $userWithRole = $user->load('role');
            return response()->json(['user' => $userWithRole], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching user'], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'role_id' => 'required'
            ]);
    
            DB::beginTransaction(); // Start a database transaction
    
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $image->store('images', 'public');
                $user->image = 'http://127.0.0.1:8000/storage' . '/' . str_replace('public/', '', $path);
            }

            $user->save();
    
            if ($user->role_id == 2) {
                $artisanData = [
                    'years_of_experience' => 0,
                    'user_id' => $user->id,
                ];
                $artisan = Artisan::create($artisanData);
            }
    
            DB::commit(); // Commit the transaction
    
            return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction in case of an exception
            return response()->json(['error' => 'Error creating user'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {    
            $user = User::findOrFail($id);
            $user->update($request->except('image'));
    
            if ($request->hasFile('image')) {
                // Delete the existing image if it exists
                if ($user->image) {
                    Storage::delete('public/' . $user->image);
                }
                // Store the new image
                $imagePath = $request->file('image')->store('public/images');
                $user->image = 'http://127.0.0.1:8000/storage' . '/' . str_replace('public/', '', $imagePath);
                $user->save();
            }
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating user'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
    
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
    
            // Delete user's image
            if ($user->image != null) {
                Storage::disk('public')->delete($user->image);
            }
    
            $user->delete();
    
            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting user'], 500);
        }
    }
}
