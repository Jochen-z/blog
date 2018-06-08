<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with('category')->recent()->paginate(10);

        return view('articles.index', compact('articles'));
    }
}
