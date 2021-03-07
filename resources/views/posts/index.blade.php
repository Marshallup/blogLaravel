@extends('layouts.blog')
@section('title', 'Блог')
@section('header-content')
    @include('posts.includes.blocks.header.header-slider')
@endsection
@section('content-page')
    @include('posts.includes.list')
@endsection
