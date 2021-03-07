<div class="single-sidebar-widget popular-post-widget">
    <h4 class="popular-title">Популярные посты</h4>
    <div class="popular-post-list">
{{--        {{ dump($posts) }}--}}
        @foreach ($posts as $post)
            <div class="single-post-list">
            <div class="thumb">
                <img class="img-fluid" src="{{ asset($post->thumbnail) }}" alt="">
            </div>
            <div class="details mt-20">
                <a href="{{ route('posts.detail', ['slug' => $post->slug]) }}">
                    <h6>{{ $post->title }}</h6>
                </a>
{{--                <p>Mate Winston | Dec 15</p>--}}
                <p> {{ $post->user->name . ' ' .$post->user->surname }} | {{ $post->getWidgetDate() }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
