@extends('layouts.app')

@section('title', $article->title)
@section('description', $article->excerpt)

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 article-body">
                <h1 class="text-center">
                    {{ $article->title }}
                </h1>

                <div class="article-meta text-center">
                    {{ $article->created_at->diffForHumans() }}
                    ⋅
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                    {{ $article->read_count }}
                </div>

                <div class="topic-body">
                    {!! $article->content !!}
                </div>
            </div>
        </div>
    </main>
@endsection