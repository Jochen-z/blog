<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="@yield('description', 'Jochen Blog,从事PHP开发,Laravel爱好者')" />
    <meta name="keyword" content="Jochen Blog,PHP,Laravel,Linux,CentOS,Nginx,MySQL,Redis,HTML,CSS,JavaScript,Vue">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Jochen Blog')</title>

    <link rel="Shortcut Icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>

<body data-spy="scroll" data-target="#myScrollspy">
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>