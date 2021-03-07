<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
//        dump(session()->all());
        $posts = Post::with('category', 'comments', 'user')->orderBy('id', 'desc')->paginate(6);
        return view('posts.index', compact('posts'));
    }
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with('user', 'likes')->firstOrFail();
//        $comments = Post::with('comments')->get();
        $post->views += 1;
        $post->update();
        $nextPost = Post::where('created_at', '<', $post->created_at)->orderBy('created_at', 'DESC')->first();
        $prevPost = Post::where('created_at', '>', $post->created_at)->orderBy('created_at', 'ASC')->first();
        return view('posts.detail', compact('post', 'nextPost', 'prevPost'));
    }
}
