<div class="single-amenities">
    <div class="amenities-thumb">
        <img
            class="img-fluid w-100"
            src="{{ $post->getImage() }}"
            alt=""
        />
    </div>
    <div class="amenities-details">
        <h5>
            <a href="{{ route('posts.detail', ['slug' => $post->slug]) }}"
            >{{ $post->title }}
            </a>
        </h5>
        <div class="amenities-meta mb-10">
            <a href="#" class=""
            ><span class="ti-calendar"></span>
                {{ $post->getPostDate() }}
            </a
            >
            <a href="#" class="ml-10">
                <span class="ti-comment"></span>
                {{ $post->setFormatComment($post->comments->count()) }}
            </a>
            <span class="ml-10">
                <i class="fas fa-eye awesome"></i>
                {{ $post->views }}
            </span>
        </div>
        <p>
            {{ strip_tags($post->description) }}
        </p>

        <div class="d-flex justify-content-between mt-20">
            <div>
                <a href="{{ route('posts.detail', ['slug' => $post->slug]) }}" class="blog-post-btn">
                    Читать <span class="ti-arrow-right"></span>
                </a>
            </div>
            <div class="category">
                <a href="{{ route('categories.detail', ['slug' => $post->category->slug]) }}">
                    <span class="ti-folder mr-1"></span> {{ $post->category->title }}
                </a>
            </div>
        </div>
    </div>
</div>
