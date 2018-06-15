<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>欢迎登录后台管理系统</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: #2d3a4b;
        }
        .container {
            display:table;
            height:100%;
        }
        .row {
            display: table-cell;
            vertical-align: middle;
        }
        .row-centered {
            text-align:center;
        }
        .col-centered {
            display:inline-block;
            float:none;
            text-align:left;
            margin-right:-4px;
        }
        .title {
            height: 54px;
            margin-bottom: 10px;
            text-align: center;
        }
        .title h2 {
            color: #555;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row row-centered">
            <div class="well col-md-4 col-centered">
                <div class="title">
                    <h2>后台管理系统</h2>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="用户名" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" placeholder="密码" required>
                            @if ($errors->has('password'))
                                <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember">记住我</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success form-control">登&nbsp;录</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>