<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="Jochen Blog,从事PHP开发,Laravel爱好者" />
    <meta name="keyword" content="Jochen Blog,PHP,Laravel,CentOS,Linux,Nginx,MySQL,Redis,HTML,CSS,JavaScript,Vue" />

    <title>@yield('title', 'Jochen Blog')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @include('layouts.header')

        @yield('content')

        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>