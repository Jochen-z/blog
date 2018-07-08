@extends('layouts.app')

@section('title', $article->title)
@section('description', $article->excerpt)

@section('style')
    <style>
        .affix {
            top: 200px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            {{-- 文章内容 --}}
            <div class="col-xs-9 col-md-9 main">
                <main class="main-inner">
                    <div class="content-wrap">
                        <div class="content">
                            <article class="article-block">
                                <div class="article-detail">
                                    <header class="article-header">
                                        <h2 class="article-title">{{ $article->title }}</h2>

                                        <div class="article-meta">
                                    <span class="article-time">
                                        <span class="article-meta-item-icon"><i class="fa fa-calendar-o"></i></span>
                                        <span class="article-meta-item-text">发表于</span>
                                        <time title="发表于" itemprop="dateCreated datePublished" datetime="{{ $article->created_at }}">
                                            {{ $article->created_at->format('Y-m-d') }}
                                        </time>

                                        <span class="article-meta-divider">|</span>
                                        <span class="article-meta-item-icon"><i class="fa fa-calendar-check-o"></i></span>
                                        <span class="article-meta-item-text">更新于:</span>
                                        <time title="更新于" itemprop="dateModified" datetime="{{ $article->updated_at }}">
                                            {{ $article->updated_at->format('Y-m-d') }}
                                        </time>
                                    </span>

                                            <span class="article-meta-divider">|</span>

                                            <span class="article-category">
                                        <span class="article-meta-item-icon"><i class="fa fa-folder-o"></i></span>
                                        <span class="article-meta-item-text">分类于</span>
                                        <span>
                                            <a href="{{ route('categories.show', ['id' => $article->category->id]) }}" itemprop="url" rel="index">
                                                <span itemprop="name">{{ $article->category->name }}</span>
                                            </a>
                                        </span>
                                    </span>

                                            <span class="article-meta-divider">|</span>

                                            <span class="page-pv">
                                        <i class="fa fa-file-o"></i> 浏览
                                        <span class="busuanzi-value" id="busuanzi_value_page_pv"> {{ $article->read_count }} </span>次
                                    </span>

                                            <div class="article-wordcount">
                                                <span class="article-meta-item-icon"><i class="fa fa-file-word-o"></i></span>
                                                <span class="article-meta-item-text">字数统计:</span>
                                                <span title="字数统计"> {{ $article->word_count }} 字</span>

                                                <span class="article-meta-divider">|</span>

                                                <span class="article-meta-item-icon"><i class="fa fa-clock-o"></i></span>
                                                <span class="article-meta-item-text">阅读时长 ≈</span>
                                                <span title="阅读时长"> {{ $article->read_time }} 分钟</span>
                                            </div>
                                        </div>
                                    </header>

                                    <section class="article-content">
                                        {!! $article->content !!}
                                    </section>

                                    <footer class="article-footer">
                                        <div class="article-tags">
                                            @foreach ($article->tags as $tag)
                                                <a href="{{ route('tags.show', ['id' => $tag->id]) }}" rel="tag"># {{ $tag->name }}</a>
                                            @endforeach
                                        </div>
                                    </footer>
                                </div>
                            </article>
                        </div>
                    </div>
                </main>
            </div>

            {{-- 侧边栏 --}}
            <nav class="col-xs-3 col-md-3">
                <ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="200">
                    <li class="active"><a href="#section1">Section 1</a></li>
                    <li><a href="#section2">Section 2</a></li>
                    <li><a href="#section3">Section 3</a></li>
                </ul>
            </nav>
            {{--<div class="col-xs-3 col-md-3 sidebar-offcanvas" style="margin-top: 0;" id="navbar-example">--}}
                {{--<ul class="nav nav-tabs" role="tablist" data-spy="affix" data-offset-top="200">--}}
                    {{--<li>a</li>--}}
                    {{--<li>b</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection