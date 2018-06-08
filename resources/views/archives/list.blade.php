@if ($count > 0)
    <span class="archive-move-on"></span>
    <span class="archive-page-counter">非常好! 目前共计 {{ $count }} 篇日志。 继续努力。</span>

    @foreach ($archives as $year => $archive)
        <div class="collection-title">
            <h2 class="archive-year motion-element" style="opacity: 1; display: block; transform: translateX(0px);">
                {{ $year }}
            </h2>
        </div>

        @foreach($archive as $article)
            <article class="post post-type-normal" style="opacity: 1; display: block; transform: translateY(0px);">
                <header class="post-header">
                    <h1 class="post-title">
                        <a class="post-title-link" href="{{ route('articles.show', [$article->id]) }}" itemprop="url">
                            <span itemprop="name">{{ $article->title }}</span>
                        </a>
                    </h1>

                    <div class="post-meta">
                        <time class="post-time" itemprop="dateCreated" datetime="{{ $article->created_at }}"
                              content="{{ $article->created_at->format('Y-m-d') }}">
                            {{ $article->created_at->format('m-d') }}
                        </time>
                    </div>
                </header>
            </article>
        @endforeach
    @endforeach
@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif