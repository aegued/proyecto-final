<?php

namespace App\Http\Controllers;

use App\Post;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::orderByDesc('id')->paginate(12);

        return view('home')->with([
            'posts' =>  $posts
        ]);
    }

    public function contact()
    {
        return view('contact');
    }
}
