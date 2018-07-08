@if (count($articles))
    @foreach ($articles as $article)
        <article class="article-block">
            <header class="article-header">
                <h2 class="article-title">
                    <a class="article-title-link" href="{{ $article->link() }}" title="{{ $article->title }}">
                        {{ $article->title }}
                    </a>
                </h2>
            </header>

            <aside class="article-meta">
                <span class="article-time">
                    <span class="article-meta-item-icon"><i class="fa fa-calendar-o"></i></span>
                    <span class="article-meta-item-text">发表于:</span>
                    <time title="创建于" itemprop="dateCreated datePublished" datetime="{{ $article->created_at }}">
                        {{ $article->created_at->format('Y-m-d') }}
                    </time>

                    <span class="article-meta-divider">|</span>

                    <span class="article-meta-item-icon"><i class="fa fa-calendar-check-o"></i></span>
                    <span class="article-meta-item-text">更新于:</span>
                    <time title="更新于" itemprop="dateModified" datetime="{{ $article->updated_at }}">
                        {{ $article->updated_at->format('Y-m-d') }}
                    </time>
                </span>

                <span class="article-category">
                    <span class="article-meta-divider">|</span>

                    <span class="article-meta-item-icon"><i class="fa fa-folder-o"></i></span>
                    <span class="article-meta-item-text">分类于</span>
                    <span>
                        <a href="{{ route('categories.show', ['id' => $article->category->id]) }}" itemprop="url" rel="index">
                            <span itemprop="name">{{ $article->category->name }}</span>
                        </a>
                    </span>
                </span>

                <div class="article-wordcount">
                    <span class="article-meta-item-icon"><i class="fa fa-file-word-o"></i></span>
                    <span class="article-meta-item-text">字数统计:</span>
                    <span title="字数统计">{{ $article->word_count }}字</span>

                    <span class="article-meta-divider">|</span>

                    <span class="article-meta-item-icon"><i class="fa fa-clock-o"></i></span>
                    <span class="article-meta-item-text">阅读时长 ≈</span>
                    <span title="阅读时长">{{ $article->read_time }}分钟</span>
                </div>
            </aside>

            <div class="article-content" itemprop="articleBody">
                {{-- 文章概要--}}
                <p>{{ $article->excerpt }}</P>

                <div class="article-button text-center">
                    <a class="btn" href="{{ route('articles.show', [$article->id]) }}" rel="contents">
                        阅读全文 »
                    </a>
                </div>
            </div>

            <footer class="article-footer">
                <blockquote class="mt-2x"></blockquote>
            </footer>
        </article>
    @endforeach

@else
    <div class="empty-block">暂无文章 ~_~ </div>
@endif