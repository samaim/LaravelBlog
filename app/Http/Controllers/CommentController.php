<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate(['body' => 'required']);

        $post->comments()->create([
            'content' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function reply(Request $request, Comment $comment)
    {
        $request->validate(['body' => 'required']);

        $comment->replies()->create([
            'content' => $request->body,
            'user_id' => auth()->id(),
            'post_id' => $comment->post_id,
        ]);

        return back();
    }
}
