<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::latest()->paginate(20);

        return $this->success($categories);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return $this->success($category);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Category::create($request->all());

        return $this->created();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return $this->updated();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Category::destroy($id);

        return $this->deleted();
    }
}
