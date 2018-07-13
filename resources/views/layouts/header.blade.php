<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-xs-11 col-md-offset-1 col-xs-offset-1">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{ url('/') }}">Jochen's blog</a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/') }}">首页</a></li>
                        <li><a href="{{ route('categories.index') }}">分类</a></li>
                        <li><a href="{{ route('tags.index') }}">标签</a></li>
                        <li><a href="{{ route('archive.index') }}">日志</a></li>
                        <li><a href="{{ route('about') }}">关于我</a></li>
                    </ul>

                    <form action="/search" class="nav navbar-nav navbar-right header-search">
                        <button class="btn btn-link">
                            <span class="sr-only">搜索</span>
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                        <input id="searchBox" name="q" type="text" placeholder="搜索文章" class="form-control" value="">
                    </form>
                </div>
            </div>
        </div>

    </div>
</nav>