<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $description = $request->description;

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:30000']
        ]);

        Post::create([
            'title' => $title,
            'description' => $description
        ]);

        return 'Post Saved';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if (! $post) {
            return response()->json([
                'error' => 'Unable to find the post'
            ], 404);
        }

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $title = $request->title;
        $description = $request->description;

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:30000']
        ]);

        $post = Post::find($id);

        if (! $post) {
            return response()->json([
                'error' => 'Unable to find the post'
            ], 404);
        }

        $post->update([
            'title' => $title,
            'description' => $description
        ]);

        return 'Post updated';

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (! $post) {
            return response()->json([
                'error' => 'Unable to find the post'
            ], 404);
        }

        $post->delete();

        return 'Post Deleted';
    }
}
