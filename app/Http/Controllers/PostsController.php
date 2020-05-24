<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin'])->except('index','show');
    }

    public function index()
    {
        return view('posts.index');
    }

    public function store(Request $request)
    {

    }

    public function show($slug)
    {
        $post = Post::findBySlugOrFail($slug);

        return view('posts.show')->with([
            'post'  =>  $post,
        ]);
    }

    public function edit($slug)
    {
        $post = Post::findBySlugOrFail($slug);

        return view('posts.edit')->with([
            'post'  =>  $post,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function update()
    {

    }

    public function destroy($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
