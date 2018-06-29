<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Requests\StoreCategoryPost;
use App\Http\Requests\UpdateCategoryPost;
use App\Http\Resources\CategoryResource;

class CategoryController extends ApiController
{
    /**
     * 分类列表
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = CategoryResource::collection(Category::latest()->paginate(15));

        return $this->success($categories);
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
