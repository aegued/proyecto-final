<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $attributes = [
            'title'     =>  'Título',
            'content'   =>  'Descripción',
            'image_url' =>  'Imagen'
        ];

        $validator = Validator::make($request->all(),[
            'title'     =>  'required',
            'content'   =>  'required',
        ],[],$attributes);

        if ($validator->fails())
            return back()->withErrors($validator->errors());

        $post = new Post($request->except('image_url'));

        $image = $request->file('image_url');

            if ($image)
        {
            $path = $image->storeAs('images','image_'.now()->timestamp.'.'.$image->extension());
            $post->image_url = $path;
        }

        $post->save();

        return redirect()->route('posts.show',$post->slug);
    }

    public function show($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        $comments = $post->comments;

//        dd(Storage::url($post->image_url));

        return view('posts.show')->with([
            'post'      =>  $post,
            'comments'  =>  $comments,
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
