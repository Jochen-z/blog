@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{-- 归档列表 --}}
                <section class="posts-collapse">
                    @include('archives.list', ['count' => $count, 'archives' => $archives])
                </section>

                {{-- 分页 --}}
                <nav class="nav-pagination">
                    {!! $articles->appends(Request::except('page'))->render() !!}
                </nav>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script type="text/javascript" src="//cdn.jsdelivr.net/velocity/1.2.3/velocity.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/velocity/1.2.3/velocity.ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.archive-year').velocity('transition.slideLeftIn');
            $('.post').velocity('transition.slideDownIn', { stagger: 200 });
        });
    </script>
@endsection