<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Http\Resources\TagResource;
use App\Http\Requests\StoreTagPost;
use App\Http\Requests\UpdateTagPost;

class TagController extends ApiController
{
    /**
     * 标签列表
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tags = TagResource::collection(Tag::latest()->paginate(15));

        return $this->success($tags);
    }

    /**
     * 查看标签信息
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $tag = new TagResource(Tag::findOrFail($id));

        return $this->success($tag);
    }

    /**
     * 新增标签
     *
     * @param StoreTagPost $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTagPost $request)
    {
        Tag::create($request->all());

        return $this->created();
    }

    /**
     * 更新标签
     *
     * @param UpdateTagPost $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTagPost $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());

        return $this->updated();
    }

    /**
     * 删除标签
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return $this->deleted();
    }
}
