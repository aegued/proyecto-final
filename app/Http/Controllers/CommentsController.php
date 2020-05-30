<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->only('destroy');
    }

    public function store(Request $request)
    {
        $messages = [
            'text.required'  =>  'El texto del comentario es obligatorio.',
        ];

        $validator = Validator::make($request->all(),[
            'text'  =>  'required'
        ], $messages);

        if ($validator->fails())
            return response()->json(['error' => $validator->errors()], 409);

        $comment = new Comment($request->all());
        $comment->save();

        return response()->json([
            'success' => 'Comentario enviado correctamente.',
            'comment' => $comment,
            'commentUser' => $comment->user()->get(['id', 'name']),
            'commentUserUrl' => route('users.show', $comment->user->id)
        ], 200);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back();
    }
}
