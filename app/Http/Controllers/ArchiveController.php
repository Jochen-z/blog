<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArchiveController extends Controller
{
    /**
     * 文章归档
     *
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Article $article)
    {
        $count = $article->count(); // 文章总数

        $archives = [];
        $articles = $article->recent()->paginate(10);
        foreach ($articles as $article) {
            $year = $article->created_at->format('Y');
            $archives[$year][] = $article;
        }

        return view('archives.index', compact('articles', 'count', 'archives'));
    }
}
