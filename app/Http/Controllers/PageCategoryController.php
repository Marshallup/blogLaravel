<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PageCategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::with('category', 'comments')->where('category_id', $category->id)->paginate(6);
        return view('posts.category', compact('posts' ));
    }
}
