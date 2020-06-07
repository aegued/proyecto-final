<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin'])->except('show');
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

    public function getPostsDataTable()
    {
        $posts = Post::all();

        $datatables = DataTables::of($posts)
            ->editColumn('user', function ($post){
                return "<a href='".route('users.show', $post->user->slug)."' class='btn btn-link btn-sm'>".$post->user->name."</a>";
            })->editColumn('comments', function ($post){
                return $post->comments->count();
            })->editColumn('created', function ($post){
                return $post->createdDate;
            })->editColumn('actions', function ($post){
                $output = "";
                $output .= "<a class='btn btn-info btn-sm' href='".route('posts.show',$post->slug)."' title='Mostrar'><i class='fas fa-eye'></i></a>";
                $output .= "<a class='btn btn-success btn-sm' href='".route('posts.edit',$post->slug)."' title='Editar'><i class='fas fa-edit'></i></a>";
                $output .= "<a class='btn btn-danger btn-sm' href='".route('posts.destroy',$post->slug)."' title='Eliminar' onclick='return confirm(\"¿Está seguro que desea eliminar el Artículo?\")'><i class='fas fa-trash'></i></a>";

                return $output;
            })->rawColumns(['except','user','comments','created','actions']);

        return $datatables->make(true);
    }
}
