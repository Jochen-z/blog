<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Error 404 - Not Found</title>

    <link rel="Shortcut Icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <main class="container">
        <div class="row">
            <div class="col-md-12" style="min-height: 700px; margin-top: 150px;">
                <div class="col-md-5 col-md-offset-1">
                    <h1 class="">Oops!</h1>
                    <h3>We can't seem to find the page you're looking for.</h3>
                    <h3>Error code: 404</h3>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <img src="{{ asset('images/404.gif') }}" width="313" height="428" alt="Girl has dropped her ice cream.">
                </div>
            </div>
        </div>
    </main>
</body>
</html>