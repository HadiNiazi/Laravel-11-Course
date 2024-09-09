<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Video;
use App\Models\Comment;
use App\Jobs\PostCreation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\PostStatusChanged;
use App\Models\Scopes\PublishedScope;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Posts\CreateRequest;
use App\Http\Requests\Posts\UpdateRequest;

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
        // $posts = Post::paginate(10);

        // dd($posts);



        // server side datatable

        if (request()->ajax()) {
            $data = Post::select('id', 'title', 'image', 'description', 'status');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '<a data-id="'.$row->id.'" href="javascript:void(0)" class="edit btn btn-danger btn-sm delBtn"><i class="fas fa-trash"></i></a>';

                            return $btn;
                    })
                    ->addColumn('id', function($row){
                        return $row->id;
                    })
                    ->editColumn('status', function($row){
                        return $row->status == 1 ? 'Yes': 'No';
                    })
                    ->editColumn('description', function($row){
                        return Str::limit($row->description, '15');
                    })
                    ->editColumn('title', function($row){
                        return Str::limit($row->title, '15');
                    })
                    ->editColumn('image', function($row){
                        $image = '<img src="'.'/storage/'.$row->image.'" style="width:50px">';

                        return $image;
                    })
                    ->rawColumns(['action', 'image'])
                    ->orderColumn('id', 'id $1')
                    ->make(true);
        }

        return view('posts.index');
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

                // dd(auth()->user());

                PostCreation::dispatch($title, $description);

                // $eventStatus = 2;
                // // fire event
                // PostStatusChanged::dispatch($post, $eventStatus);

                // session()->flash('success_msg', 'Post Saved Successfully!');

                return response()->json([
                    'message' => 'Post saved successfully!'
                ], 201);

            }

        }
        catch(\Exception $ex) {
            dd($ex->getMessage());
            return response()->json([
                'error' => 'Something went wrong, Please refresh the webpage and try again. If still problem persists contact with administrator!'
            ], 401);
        }


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

        return to_route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Post $post) // $post make sure that post must match with the route key {post}
    public function destroy(int $id)
    {

        $post = Post::find($id);

        if (! $post) {
            return response()->json([
                'error' => 'Record not found'
            ], 404);
            // abort('404', 'Record not found');
        }

        // file exists and then delete

        if ($post->image) {
            if (Storage::disk('public')->exists($post->image)) {
                // Storage::disk('public')->delete($post->image);
                unlink(public_path('storage/'. $post->image));

            }
        }

        $post->delete();

        // session()->flash('success_msg', 'Post Removed!');

        return response()->json([
            'message' => 'Post deleted successfully!'
        ], 201);
        // return to_route('admin.posts.index');
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

    public function openRegularPosts()
    {
        $posts = Post::all(); // lazy loading

        $posts = Post::with(['user'])->get();

        // foreach($posts as $post) {
        //     dd($post->user);
        // }

        return view('posts.regular', compact('posts'));
    }
}
