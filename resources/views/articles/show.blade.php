<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="{{ $article->excerpt }}">
    <meta name="keyword" content="Jochen Blog,PHP,Laravel,Linux,CentOS,Nginx,MySQL,Redis,HTML,CSS,JavaScript,Vue">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $article->title }}</title>

    <link href="{{ asset('/favicon.ico') }}" rel="Shortcut Icon" type="image/x-icon">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/semantic.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body class="pushable">
    @include('layouts.header')

    <div class="pusher">
        <div class="container">
            {{-- 文章内容 --}}
            <main class="col-xs-9 col-md-9 main-inner">
                <article class="article-block">
                    <div class="article-detail">
                        <header class="article-header">
                            <h1 class="article-title">{{ $article->title }}</h1>

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

                        <section class="markdown">
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

                <div class="article-divider">
                    <div class="container">
                        <div class="label label--divider">
                            <span>JOCHEN</span>
                        </div>
                    </div>
                </div>
            </main>

            {{-- 侧边栏 --}}
            <nav class="col-xs-3 col-md-3" id="myScrollspy" style="margin-top: 40px;">
                <ul class="nav nav-tabs nav-stacked" style="border-left: 1px solid #eee;width: 262px;"
                    data-spy="affix" id="scrollspy">
                </ul>
            </nav>
        </div>
    </div>

    @include('layouts.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/semantic.min.js') }}"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("h2,h3,h4,h5,h6").each(function(i, item) {
                $(item).attr("id", "section-" + i);

                let nav = $(item).get(0).localName;
                let li = '<li><a class="section-' + nav +'" href="#section-' + i + '">' + $(this).text() + '</a></li>';
                $("#scrollspy").append(li);
            });
        });
    </script>
</body>
</html>
