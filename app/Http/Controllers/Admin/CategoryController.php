<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryPost;
use App\Http\Requests\UpdateCategoryPost;
use App\Http\Resources\CategoryResource;

class CategoryController extends ApiController
{
    /**
     * 分类列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'order' => 'in:asc,desc',
            'limit' => 'integer',
        ]);

        $order = $request->get('order', 'asc');
        $limit = $request->get('limit', 15);
        $categories = Category::orderBy('created_at', $order)->paginate($limit);
        $categories = CategoryResource::collection($categories);

        return $this->responseWithPaginate($categories);
    }

    /**
     * 查看分类信息
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $category = new CategoryResource(Category::findOrFail($id));

        return $this->success($category);
    }

    /**
     * 新增分类
     *
     * @param StoreCategoryPost $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCategoryPost $request)
    {
        Category::create($request->all());

        return $this->created();
    }

    /**
     * 更新分类
     *
     * @param UpdateCategoryPost $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryPost $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return $this->updated();
    }

    /**
     * 删除分类
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return $this->deleted();
    }
}
