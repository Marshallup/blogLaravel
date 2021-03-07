@extends('layouts.blog')
@section('title', 'Блог')
@section('header-content')
    @include('posts.includes.blocks.header.header-slider')
@endsection
@section('content-page')
    @if($posts->count())
    @include('posts.includes.list', ['inputName' => 'search'])
    @else
        <h2>По запросу {{ $search }} ничего не найдено</h2>
    @endif
@endsection
