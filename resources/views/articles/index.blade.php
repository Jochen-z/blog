@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {{-- 文章列表 --}}
                <section class="article-list">
                    @include('articles.list', ['articles' => $articles])
                </section>

                {{-- 分页 --}}
                <nav class="nav-pagination">
                    {!! $articles->appends(Request::except('page'))->render() !!}
                </nav>
            </div>
        </div>
    </main>
@endsection