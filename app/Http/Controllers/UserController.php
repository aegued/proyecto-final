<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function show($slug)
    {
        $user = User::findBySlugOrFail($slug);
        $comments = $user->comments()->orderByDesc('id')->paginate(10);

        return view('users.show')->with([
            'user'      =>  $user,
            'comments'  =>  $comments
        ]);
    }
}
