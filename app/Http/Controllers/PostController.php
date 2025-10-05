<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $posts = Post::with('user:id,name')->get();

        return response()->json(
            $posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'created_by' => $post->user->name ?? 'Unknown',
                    'created_at' => $post->created_at,
                ];
            })
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $post = Post::create($validated);

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string', 
            'category_id' => 'nullable|exists:categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);
        $validated['user_id'] = $request->user()->id;  
        $validated['slug'] = Str::slug($validated['title']);

        $post = Post::create($validated);

        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::with('user:id,name')->find($id); 
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        // Return JSON with user name
        return response()->json([
            'id' => $post->id,
            'title' => $post->title,
            'body' => $post->body,
            'created_by' => $post->user->name ?? 'Unknown', // show name
            'created_at' => $post->created_at,
            'meta_description' => $post->meta_description,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body'  => 'sometimes|required|string',
            'user_id' => 'sometimes|required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'status' => ['sometimes', Rule::in(['draft', 'published'])],
        ]);

        if (isset($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post->update($validated);

        return response()->json(['message' => 'Post updated', 'post' => $post], 200);
    }


    /**
     * Remove the specified resource from storage.
     */ 
    // DELETE /api/posts/{id}
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}


