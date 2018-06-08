<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * 标签列表
     *
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Tag $tag)
    {
        $count = $tag->count(); // 标签总数

        $tags = $tag->all(); // 标签

        $articles = $tag->withCount('articles')->get();
        foreach ($articles as $index => $article) {
            // 拥有该标签的文章总数
            $tags[$index]['count'] = $article->articles_count;
        }

        return view('tags.index', compact('count', 'tags'));
    }

    /**
     * 某个标签下的文章列表
     *
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Tag $tag)
    {
        $articles = $tag->articles()
            ->with('category')
            ->recent()
            ->paginate(10);

        return view('articles.index', compact('articles'));
    }
}
