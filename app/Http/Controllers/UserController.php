<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin'])->only('show');
    }

    public function show($slug)
    {
        $user = User::findBySlugOrFail($slug);

        return view('users.show')->with([
            'user'      =>  $user,
        ]);
    }

    public function getComments($slug)
    {
        $user = User::findBySlugOrFail($slug);
        $comments = $user->comments()->orderByDesc('id')->paginate(10);

        return view('users.comments')->with([
            'user'      =>  $user,
            'comments'  =>  $comments
        ]);
    }
}
