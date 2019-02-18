<?php

namespace App\Http\Controllers;

use Parsedown;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * 文章列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::with('category')->recent()->paginate(10);

        return view('articles.index', compact('articles'));
    }

    /**
     * 查看文章
     *
     * @param Request $request
     * @param Article $article
     * @param Parsedown $parsedown
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Request $request, Article $article, Parsedown $parsedown)
    {
        if ( ! empty($article->slug) && $article->slug != $request->slug) {
            return redirect($article->link(), 301);
        }

        $article->content = $parsedown->text($article->content);

        // 文章阅读数+1
        $article->increment('read_count');

        return view('articles.show', compact('article'));
    }

    /**
     * 搜索文章
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function search(Request $request)
    {
        $this->validate($request, ['query' => 'required|string']);

        $query = trim($request->get('query'));
        $articles = Article::search($query)->paginate(10);

        return view('articles.index', compact('articles', 'query'));
    }
}
