<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Http\Requests\StoreTagPost;
use App\Http\Requests\UpdateTagPost;

class TagController extends ApiController
{
    /**
     * 标签列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
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
        $tags = empty($keyword) ?
            Tag::orderBy('created_at', $order)->paginate($limit) :
            Tag::search($keyword)->orderBy('created_at', $order)->paginate($limit);

        $tags = TagResource::collection($tags);

        return $this->responseWithPaginate($tags);
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
