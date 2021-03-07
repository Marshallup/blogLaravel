<!DOCTYPE html>
<html lang="ru">
<head>
    @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
    @show
</head>
<body @if(isset($bodyClass)) class="{{ $bodyClass }}" @endif>

@yield('header')

@yield('content')

@yield('footer')

@yield('scripts')
</body>
</html>
