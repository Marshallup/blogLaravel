<?php

namespace App\View\Components\Widget;

use App\Models\Post;
use Illuminate\View\Component;

class PopularPosts extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $posts = Post::orderBy('views', 'desc')->with('user')->limit(3)->get(['title', 'slug', 'thumbnail' ,'created_at', 'user_id']);
//        $thisClass = $this;
        return view('components.widget.popular-posts', compact('posts'));
    }

}
