<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\StoreArticlePost;
use App\Http\Requests\UpdateArticlePost;

class ArticleController extends ApiController
{
    /**
     * 文章列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'limit'   => 'integer',
            'order'   => 'in:asc,desc',
            'keyword' => 'string'
        ]);

        $order = $request->get('order', 'asc');
        $limit = $request->get('limit', 15);
        $keyword = trim($request->get('keyword'));
        $articles = empty($keyword) ?
            Article::orderBy('created_at', $order)->paginate($limit) :
            Article::search($keyword)->orderBy('created_at', $order)->paginate($limit);

        $articles = ArticleResource::collection($articles);

        return $this->responseWithPaginate($articles);
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
