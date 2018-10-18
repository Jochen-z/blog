@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <main class="col-xs-10 col-md-10 col-xs-offset-1 col-md-offset-1 main">
                <div class="main-inner">
                    <div class="content-wrap">
                        @if(isset($query))
                            {{-- 搜索结果 --}}
                            <section class="search-results">
                                <div class="panel-heading">
                                    <h3 class="panel-title ">
                                        <i class="fa fa-search"></i> 关于 “<span class="highlight">{{ $query }}</span>” 的搜索结果, 共 {{ $articles->total() }} 条
                                    </h3>
                                </div>
                            </section>
                        @endif

                        {{-- 文章列表 --}}
                        <section class="content">
                            @include('articles.list', ['articles' => $articles])
                        </section>

                        {{-- 分页 --}}
                        <nav class="nav-pagination">
                            {!! $articles->appends(Request::except('page'))->render() !!}
                        </nav>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection