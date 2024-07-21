<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->simplePaginate(9); // Adjust the number of posts per page
        return view('frontEnd.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['comments' => function ($query) {
            $query->with('replies')
                ->orderBy('created_at', 'desc');
        }]);
        return view('frontEnd.post-detail', compact('post'));
    }
}
