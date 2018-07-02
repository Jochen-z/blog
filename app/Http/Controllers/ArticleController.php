<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show(Request $request, Article $article)
    {
        if ( ! empty($article->slug) && $article->slug != $request->slug) {
            return redirect($article->link(), 301);
        }

        return view('articles.show', compact('article'));
    }
}
