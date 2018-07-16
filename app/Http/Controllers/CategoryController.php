<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * 某个分类下的文章列表
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        $articles = $category->articles()->with('category')->recent()->paginate(10);

        return view('articles.index', compact('articles'));
    }
}
