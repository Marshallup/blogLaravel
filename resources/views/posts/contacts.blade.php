@extends('layouts.blog')
@section('header-content')
    @include('posts.includes.blocks.header.header-img')
@endsection
@section('content')
    <!-- Start contact-page Area -->
    <section class="contact-page-area section-gap">
        <div class="container">
            <div class="row">
                <div class="map-wrap" id="contactMap"></div>
                <div class="col-lg-4 d-flex flex-column address-wrap">
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon"><span class="lnr lnr-home"></span></div>
                        <div class="contact-details">
                            <h5>Binghamton, New York</h5>
                            <p>4343 Hinkle Deegan Lake Road</p>
                        </div>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon">
                            <span class="lnr lnr-phone-handset"></span>
                        </div>
                        <div class="contact-details">
                            <h5>00 (958) 9865 562</h5>
                            <p>Mon to Fri 9am to 6 pm</p>
                        </div>
                    </div>
                    <div class="single-contact-address d-flex flex-row">
                        <div class="icon"><span class="lnr lnr-envelope"></span></div>
                        <div class="contact-details">
                            <h5>support@colorlib.com</h5>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
                @include('posts.includes.blocks.forms.contacts')
            </div>
        </div>
    </section>
    <!-- End contact-page Area -->
@endsection
