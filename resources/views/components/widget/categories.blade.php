<div class="single-sidebar-widget post-category-widget">
    <h4 class="category-title">Категории</h4>
    <ul class="cat-list mt-20">
        @foreach($categories as $category)
            <li>
                <a href="{{ route('categories.detail', ['slug' => $category->slug]) }}" class="d-flex justify-content-between">
                    <p>{{ $category->title }}</p>
                    <p>{{ $category->posts_count }}</p>
                </a>
            </li>
        @endforeach
    </ul>
</div>
