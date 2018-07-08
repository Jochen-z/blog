@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <main class="col-xs-10 col-md-10 col-xs-offset-1 col-md-offset-1 main">
                <div class="main-inner">
                    <div class="content-wrap">
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