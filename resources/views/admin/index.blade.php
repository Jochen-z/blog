<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="管理后台" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '管理后台')</title>

    {{--<link rel="Shortcut Icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">--}}
</head>

<body>
    <div id="app" class="container">
        <router-view class="view"></router-view>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>