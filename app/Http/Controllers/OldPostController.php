<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreateRequest;
use App\Http\Requests\Posts\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
        // 'select * from posts';

        $posts = Post::paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(CreateRequest $request)
    {
        $title = $request->title;
        $description = $request->description;

        // var_dump($title);
        // die();

        // dd($title, $description);

        // == Raq Queries == //
        // DB::insert('insert into posts (title, description, status) values (?, ?, ?)', [$title, $description, true]);

        // == Query Builder == //
        // DB::table('posts')->insert([
        //     'title' => $title,
        //     'description' => $description,
        //     'status' => true
        // ]);

        // return DB::table('posts')->get();

        // == Query builder with raw queries too == //
        // return DB::table('posts')
        //         ->whereRaw('status = false')
        //         ->get();


        // == Eloquent or ORM or Model == //
        // Post::create([
        //     'title' => $title,
        //     'description' => $description
        // ]);


        // Validting the user data

        try {

            // if ($request->hasFile('image')) {
            if ($file = $request->image) {

                $extension = $file->getClientOriginalExtension();
                // $fileName = time(). rand(10000, 1000000). '.'. $extension;

                // $file->move('dummy'. $fileName, $file);

                $fileNameWithPath = Storage::disk('public')->put('/uploads/images', $file);

                Post::create([
                    'title' => $title,
                    'description' => $description,
                    'image' => $fileNameWithPath
                ]);

            }



        }
        catch(\Exception $ex) {

            // return back()->withErrors('Error is '.$ex->getMessage());

            return back()->withErrors('Something went wrong, Please refresh the webpage and try again. If still problem persists contact with administrator');


        }




        // session()->put('user', 'User is saved');

        // session()->forget('user');

        // session()->flush();

        // session()->get('user');

        session()->flash('success_msg', 'Post Saved Successfully!');

        // return redirect()->route('posts.create');

        return to_route('posts.index');

        // return back();

    }

    public function show($id)
    {
        // $post = Post::findOrFail($id);

        $post = Post::find($id);

        if (! $post) {
            abort('404', 'Record not found');
        }

        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id);

        if (! $post) {
            abort('404', 'Record not found');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(UpdateRequest $request, $id)
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

    public function destroy($id)
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

}
