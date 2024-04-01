<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $title = $request->title;
        $description = $request->description;

        // var_dump($title);
        // die();

        // dd($title, $description);

        DB::insert('insert into posts (title, description, status) values (?, ?, ?)', [$title, $description, true]);

        return 'Saved';

    }

    public function show($id)
    {
        return view('posts.show', compact('id'));
    }

}
