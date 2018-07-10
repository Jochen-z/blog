<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <nav class="site-nav">
                    <ul class="menu">
                        <li class="{{ active_class(if_uri('/')) }}">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <i class="fa fa-fw fa-home" aria-hidden="true"></i> 首页
                            </a>
                        </li>
                        <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 1))) }}">
                            <a class="navbar-brand" href="{{ route('categories.show', ['id' => 1]) }}">
                                <i class="fa fa-fw fa-paper-plane-o" aria-hidden="true"></i> 后端
                            </a>
                        </li>
                        <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 2))) }}">
                            <a class="navbar-brand" href="{{ route('categories.show', ['id' => 2]) }}">
                                <i class="fa fa-fw fa-database" aria-hidden="true"></i> 数据库
                            </a>
                        </li>
                        <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 3))) }}">
                            <a class="navbar-brand" href="{{ route('categories.show', ['id' => 3]) }}">
                                <i class="fa fa-fw fa-server" aria-hidden="true"></i> 服务器端
                            </a>
                        </li>
                        <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 4))) }}">
                            <a class="navbar-brand" href="{{ route('categories.show', ['id' => 4]) }}">
                                <i class="fa fa-fw fa-desktop" aria-hidden="true"></i> 前端
                            </a>
                        </li>
                        <li class="{{ active_class((if_route('categories.show') && if_route_param('category', 5))) }}">
                            <a class="navbar-brand" href="{{ route('categories.show', ['id' => 5]) }}">
                                <i class="fa fa-fw fa-book" aria-hidden="true"></i> 其他
                            </a>
                        </li>
                        <li>
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <i class="fa fa-fw fa-search" aria-hidden="true"></i> 搜索
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>