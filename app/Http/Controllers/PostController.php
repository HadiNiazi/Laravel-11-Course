<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreateRequest;
use App\Http\Requests\Posts\UpdateRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Scopes\PublishedScope;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // withoutGlobalScope(new PublishedScope)
        // ->toArray()
        // published()->
        $posts = Post::paginate(10);

        // dd($posts);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $title = $request->title;
        $description = $request->description;
        // dd($request->image);

        try {

            if ($file = $request->image) {

                $extension = $file->getClientOriginalExtension();

                $fileNameWithPath = Storage::disk('public')->put('/uploads/images', $file);

                Post::create([
                    'title' => $title,
                    'description' => $description,
                    'image' => $fileNameWithPath
                ]);

            }

        }
        catch(\Exception $ex) {
            return back()->withErrors('Something went wrong, Please refresh the webpage and try again. If still problem persists contact with administrator');
        }

        session()->flash('success_msg', 'Post Saved Successfully!');

        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $post = Post::find($id);

        if (! $post) {
            abort('404', 'Record not found');
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $post = Post::find($id);

        if (! $post) {
            abort('404', 'Record not found');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, int $id)
    {
        $post = Post::find($id);

        if (! $post) {
            abort('404', 'Record not found');
        }

        // update post

        try {
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status
            ]);
        }
        catch(\Exception $ex) {
            return back()->withErrors('Error is '.$ex->getMessage());
        }


        session()->flash('success_msg', 'Post Updated Successfully');

        return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $post = Post::find($id);

        if (! $post) {
            abort('404', 'Record not found');
        }

        // file exists and then delete

        if (Storage::disk('public')->exists($post->image)) {

            // Storage::disk('public')->delete($post->image);

            unlink(public_path('storage/'. $post->image));

        }

        $post->delete();

        session()->flash('success_msg', 'Post Removed!');

        return to_route('posts.index');
    }

    public function users()
    {
        // === hasOne relationship

        // $user = User::find(1)->post;

        // dd($user);

        // === inverse - belongsTo

        // $post = Post::find(1)->user;

        // dd($post);

        // === One to Many

        // $user = User::find(1);

        // dd($user->posts);

        // === One to Many - Inverse

        // $post = Post::find(1);

        // dd($post->user);

        // === Many to Many

        // $post = Post::find(1);

        // dd($post->users);


        // $user = User::find(1);

        // dd($user->posts);


        // === has One Through

        // $user = User::find(1);

        // dd($user->postComment);

        // === has One through inverse

        // $comment = Comment::find(1);

        // dd($comment->commentUser);

        // has Many Through

        // $user = User::find(1);

        // dd($user->postComments);

        // Polymorphic relationships

        // === One to One

        // $post = Post::find(1);

        // dd($post->image);

        // $user = User::find(1);

        // dd($user->image);

        // $image = Image::find(2);

        // dd($image->imageable);

        // One Many Polymorphic relationship


        // $post = Post::find(1);

        // dd($post->images);


        // $user = User::find(1);

        // dd($user->images);

        // === Many to Many polymorhphic

        // $post = Post::first();

        $video = Video::first();

        dd($video->tags);


    }
}
