@extends('layouts.app')

@section('title', '关于我')
@section('description', 'about,关于我,我的介绍')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <article class="markdown">
                    {!! $introduction !!}
                </article>
            </div>
        </div>
    </main>
@endsection