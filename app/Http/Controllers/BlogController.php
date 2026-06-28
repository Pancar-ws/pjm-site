<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $recent_posts = Post::where('id', '!=', $post->id)->orderBy('created_at', 'desc')->take(3)->get();
        return view('blog.show', compact('post', 'recent_posts'));
    }
}
