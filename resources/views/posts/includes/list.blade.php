<div class="row">
    <div class="col-lg-6 col-md-6">
        @foreach($posts as $post)
            @if($loop->odd)
                @include('posts.includes.elements.card')
            @endif
        @endforeach
    </div>
    <div class="col-lg-6 col-md-6">
        @foreach($posts as $post)
            @if($loop->even)
                @include('posts.includes.elements.card')
            @endif
        @endforeach
    </div>
</div>
    @if( !empty($search))
        {{ $posts->appends([$inputName => request()->search])->links('vendor.pagination.blog') }}
    @else
        {{ $posts->links('vendor.pagination.blog') }}
    @endif
