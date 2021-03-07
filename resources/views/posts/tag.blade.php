@extends('layouts.blog')
@section('title', 'Блог')
@section('header-content')
    @include('posts.includes.blocks.header.header-img')
@endsection
@section('content-page')
    @if (count($posts))
        @include('posts.includes.list')
    @else
{{--        <h2 class="text-center">По категории {{ $category->title }} постов не найдено</h2>--}}
    @endif
@endsection
