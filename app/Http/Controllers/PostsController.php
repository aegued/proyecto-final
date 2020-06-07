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
            'content'   =>  'Descripción'
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
            $path = $image->storeAs('public/images','image_'.now()->timestamp.'.'.$image->extension());
            $post->image_url = $path;
        }

        $post->save();

        flash('El Artículo se ha creado correctamente.')->success();

        return redirect()->route('posts.edit',$post->slug);
    }

    public function show($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        $comments = $post->comments;

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

    public function update(Request $request, $slug)
    {
        $attributes = [
            'title'     =>  'Título',
            'content'   =>  'Descripción'
        ];

        $validator = Validator::make($request->all(),[
            'title'     =>  'required',
            'content'   =>  'required',
        ],[],$attributes);

        if ($validator->fails())
            return back()->withErrors($validator->errors());

        $post = Post::findBySlugOrFail($slug);

        $image = $request->file('image_url');

        if ($image)
        {
            if ($post->image_url)
                Storage::delete($post->image_url);

            $path = $image->storeAs('public/images','image_'.now()->timestamp.'.'.$image->extension());
            $post->image_url = $path;
        }

        $post->title = $request->title;
        $post->content = $request['content'];
        $post->excerpt = $request->excerpt;
        $post->save();

        flash('El Artículo se ha actualizado correctamente.')->success();

        return redirect()->route('posts.edit',$post->slug);
    }

    public function destroy($slug)
    {
        $post = Post::findBySlugOrFail($slug);

        if ($post->image_url)
            Storage::delete($post->image_url);

        $post->delete();

        flash('El Artículo se ha eliminado correctamente.')->warning();

        return redirect()->route('posts.index');
    }
}
