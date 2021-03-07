<div class="col-lg-4 sidebar-widgets">
    <div class="widget-wrap">
        <div class="single-sidebar-widget search-widget">
            <form class="search-form" method="GET" action="{{ route('search') }}">
                <input required class="@error('search') is-invalid @enderror" placeholder="Search Posts" name="search" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Posts'">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <div class="single-sidebar-widget instafeed-widget">
            <h4 class="instafeed-title">Instagram</h4>
            <ul class="instafeed d-flex flex-wrap">
                <li><img src="assets/base/img/blog/instagram/i1.jpg" alt=""></li>
                <li><img src="assets/base/img/blog/instagram/i2.jpg" alt=""></li>
                <li><img src="assets/base/img/blog/instagram/i3.jpg" alt=""></li>
                <li><img src="assets/base/img/blog/instagram/i4.jpg" alt=""></li>
                <li><img src="assets/base/img/blog/instagram/i5.jpg" alt=""></li>
                <li><img src="assets/base/img/blog/instagram/i6.jpg" alt=""></li>
            </ul>
        </div>

        <x-widget.categories/>

        <x-widget.popular-posts/>

        <form method="POST" action="{{ route('subscribe') }}" class="single-sidebar-widget newsletter-widget">
            @error('email')
                <p>{{ $message }}</p>
            @enderror
            <h4 class="newsletter-title">Newsletter</h4>
            <div class="form-group mt-30">
                @csrf
                <div class="col-autos">
                    <input name="email" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Введите почту" onfocus="this.placeholder = ''"
                           onblur="this.placeholder = 'Введите почту'">
                </div>
            </div>
            <button class="bbtns d-block mt-20 w-100">Subcribe</button>
        </form>

        <div class="single-sidebar-widget share-widget">
            <h4 class="share-title">Share this post</h4>
            <div class="social-icons mt-20">
                <a href="#">
                    <span class="ti-facebook"></span>
                </a>
                <a href="#">
                    <span class="ti-twitter"></span>
                </a>
                <a href="#">
                    <span class="ti-pinterest"></span>
                </a>
                <a href="#">
                    <span class="ti-instagram"></span>
                </a>
            </div>
        </div>
    </div>
</div>
