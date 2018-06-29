@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <h1>{{ $article->title }}</h1>
            <p>{{ $article->content }}</p>
        </div>
    </main>
@endsection