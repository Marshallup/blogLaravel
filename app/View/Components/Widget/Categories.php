<?php

namespace App\View\Components\Widget;

use App\Models\Category;
use Illuminate\View\Component;

class Categories extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();
        return view('components.widget.categories', compact('categories'));
    }
}
