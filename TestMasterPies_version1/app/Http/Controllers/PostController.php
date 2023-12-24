<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('service')->get();

        return response()->json(['posts' => $posts], 200);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'service_id' => 'required|exists:services,id',
            ]);
    
            $post = new Post([
                'title' => $request->title,
                'service_id' => $request->service_id,
            ]);
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $image->store('images', 'public');
                $post->image = $path;
            }
   
            $post->save();
    
            return response()->json(['post' => $post], 201);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::with('service')->findOrFail($id);

        return response()->json(['post' => $post], 200);
    }

    /**
     * Update the specified resource in storage.
     */

public function update(Request $request, $id)
{
    try {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'service_id' => 'required|exists:services,id',
        ]);

        $post->update($request->except('image'));

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }

            // Upload the new image
            $imagePath = $request->file('image')->store('public/images');
            $post->image = str_replace('public/', '', $imagePath);
            $post->save();
        }

        return response()->json(['post' => $post], 200);
    } catch (\Exception $e) {
        // Handle exceptions
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }

    public function getServisePosts($id)
    {
        $post = Service::with('services')->findOrFail($id);

        return response()->json(['post' => $post], 200);
    }
}
