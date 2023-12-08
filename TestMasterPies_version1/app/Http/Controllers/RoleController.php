<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roles = Role::all();
            return response()->json($roles, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching roles'], 500);
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $role = Role::find($id);
    
            if (!$role) {
                return response()->json(['message' => 'Role not found'], 404);
            }
    
            $request->validate([
                'name' => ['required', Rule::unique('roles')->ignore($role->id), 'max:255'],
            ]);
    
            $role->update($request->all());
            return response()->json($role, 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating role'], 500);
        }
    }


}
