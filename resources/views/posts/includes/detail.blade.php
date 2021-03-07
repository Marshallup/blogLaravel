@section('title', $post->title)
<div class="main_blog_details">
        <img class="img-fluid" src="{{ $post->getImage() }}" alt="">
        <h4>{{ $post->title }}</h4>
        <div class="user_details">
            <div class="float-left">
                @foreach($post->tags as $tag)
                <a href="{{ route('tag.detail', ['slug' => $tag->slug]) }}">{{ $tag->title }}</a>
                @endforeach
            </div>
            <div class="float-right mt-sm-0 mt-3">
                <div class="media">
                    <div class="media-body">
                        <h5>{{ $post->user->name }}</h5>
                        <p>{{ $post->getPostDateDetail() }}</p>
                    </div>
                    <div class="d-flex">
                        <img style="max-width: 60px;" src="{{ asset($post->user->getImage()) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        {!! $post->content !!}
        <div class="news_d_footer flex-column flex-sm-row">
            <a class="like like-post" data-post="{{ $post->id }}" data-action="{{ route('like.post', ['slug' => $post->id]) }}" data-csrf="{!! csrf_token() !!}">
{{--                <form method="post" action="{{ route('like.post', ['slug' => $post->id]) }}">--}}
{{--                    @csrf--}}
{{--                    <i class="lnr lnr lnr-heart"></i>--}}
{{--                    @if(!empty($post->likes->last()))--}}
{{--                        {{ $post->likes->last()->user->name }} and {{ $post->likes->count() > 0 ? $post->likes->count() - 1 : $post->likes->count() }} people like this--}}
{{--                    @else--}}
{{--                        0--}}
{{--                    @endif--}}
{{--                    <button type="submit">Like!</button>--}}
{{--                </form>--}}
                <i class="lnr lnr lnr-heart"></i>
                @if(!empty($post->likes->last()))
                    <span class="last-user-like">{{ $post->likes->last()->user->name }}</span> и <span class="count-user-like">{{ $post->likes->count() > 0 ? $post->likes->count() - 1 : $post->likes->count() }}</span> человека нравится
                @else
                    0
                @endif
            </a>
            <a class="justify-content-sm-center ml-sm-auto mt-sm-0 mt-2" href="#"><i class="lnr lnr lnr-bubble"></i>{{ $post->setFormatComment($post->comments->count()) }} комментариев</a>
            <div class="news_socail ml-sm-auto mt-sm-0 mt-2">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-youtube-play"></i></a>
                <a href="#"><i class="fa fa-pinterest"></i></a>
                <a href="#"><i class="fa fa-rss"></i></a>
            </div>
        </div>
    </div>
<div class="navigation-area">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
{{--                {{ empty($prevPost) }}--}}
                @if(!empty($prevPost))
                    <div class="thumb">
                        <a href="{{ route('posts.detail', ['slug' => $prevPost->slug]) }}"><img style="max-width:80px;" class="img-fluid" src="{{ asset($prevPost->thumbnail) }}" alt=""></a>
                    </div>
                    <div class="arrow">
                        <a href="#"><span class="lnr text-white lnr-arrow-left"></span></a>
                    </div>
                    <div class="detials">
                        <p>Предыдущий пост</p>
                        <a href="{{ route('posts.detail', ['slug' => $prevPost->slug]) }}"><h4>{{ $prevPost->title }}</h4></a>
                    </div>
                @else
                    <div class="detials">
                        <p>Нет предыдущего поста</p>
                    </div>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                @if(!empty($nextPost))
                    <div class="detials">
                        <p>Следующий пост</p>
                        <a href="{{ route('posts.detail', ['slug' => $nextPost->slug]) }}"><h4>{{ $nextPost->title }}</h4></a>
                    </div>
                    <div class="arrow">
                        <a href="#"><span class="lnr text-white lnr-arrow-right"></span></a>
                    </div>
                    <div class="thumb">
                    <a href="{{ route('posts.detail', ['slug' => $nextPost->slug]) }}"><img style="max-width: 80px;" class="img-fluid" src="{{ asset($nextPost->thumbnail) }}" alt=""></a>
                </div>
                @else
                    <div class="detials">
                        <p>Нет следующего поста</p>
                    </div>
                @endif
            </div>
        </div>
</div>
<div class="comments-area">
    <h4>{{ $post->setFormatComment($post->comments->count()) }} комментариев</h4>
    @foreach($post->comments as $comment)
{{--        {{ dump($comment->user) }}--}}
            @if($comment->parent_id === 0)
                <div class="comment-list">
                    <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                            <div class="thumb">
{{--                                <img src="{{ asset('assets/base/img/blog/c1.jpg') }}" alt="">--}}
                                <img src="{{ asset($comment->user->getImage()) }}" alt="">
                            </div>
                            <div class="desc">
                                <h5>
                                    <a href="#">
                                        @if($post->user_id === $comment->user->id)
                                            {{ $comment->user->name }} - автор поста
                                        @else
                                            {{ $comment->user->name }}
                                        @endif
                                    </a>
                                </h5>
                                <p class="date">{{ $comment->getDate() }}</p>
                                <p class="comment">
                                    {{ $comment->message }}
                                </p>
                            </div>
                        </div>
                        <div class="reply-btn">
                            <span style="cursor: pointer;" data-comment-id="{{ $comment->id }}" class="btn-reply text-uppercase">Ответить</span>
                        </div>
                    </div>
                </div>
            @foreach($post->comments as $answer)
                @if($answer->parent_id == $comment->id)
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
{{--                                    <img src="{{ asset('assets/base/img/blog/c2.jpg') }}" alt="">--}}
                                    <img src="{{ asset($answer->user->thumbnail) }}" alt="">
                                </div>
                                <div class="desc">
                                    <h5>
                                        <a href="#">
                                            @if($post->user_id === $post->user->id)
                                                {{ $comment->user->name }} - автор поста
                                            @else
                                                {{ $comment->user->name }}
                                            @endif
                                        </a>
                                    </h5>
                                    <p class="date">{{ $answer->getDate() }}</p>
                                    <p class="comment">
                                        {{ $answer->message }}
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            @endif
    @endforeach
</div>
<div class="comment-form">
    @if(Auth::check())
        <h4>{{ Auth::user()->name }} оставьте свой комментарий</h4>
        <form method="post" action="{{ route('comments.store', ['slug' => $post->id]) }}">
        @csrf
        @method('post')
        <input name="post_id" type="hidden" value="{{ $post->id }}">
        <div class="form-group">
            <textarea class="form-control mb-10" rows="5" name="message" placeholder="Сообщение.." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
        </div>
        <button class="primary-btn submit_btn" type="submit">Оставить комментарий</button>
    </form>
    @else
        <h4><a href="{{ route('register.create') }}">Зарегистрируйтесь</a> или <a href="{{ route('login.create') }}">Авторизуйтесь</a>, чтобы оставлять комментарии</h4>
    @endif
</div>
