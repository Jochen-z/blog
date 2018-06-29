<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\StoreArticlePost;
use App\Http\Requests\UpdateArticlePost;

class ArticleController extends ApiController
{
    /**
     * 文章列表
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $articles = ArticleResource::collection(Article::with('category')->recent()->paginate(15));

        return $this->success($articles);
    }

    /**
     * 查看文章
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $article = new ArticleResource(Article::findOrFail($id));

        return $this->success($article);
    }

    /**
     * 新增文章
     *
     * @param StoreArticlePost $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreArticlePost $request)
    {
        Article::create($request->all());

        return $this->created();
    }

    /**
     * 更新文章
     *
     * @param UpdateArticlePost $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateArticlePost $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        return $this->updated();
    }

    /**
     * 删除文章
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return $this->deleted();
    }
}
