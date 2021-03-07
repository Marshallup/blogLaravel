@extends('layouts.blog')
@section('header-content')
    @include('posts.includes.blocks.header.header-img')
@endsection
@section('content-page')
    @include('posts.includes.detail')
@endsection
