<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Http\Resources\VisitorResource;

class VisitorController extends ApiController
{
    /**
     * 访客列表
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
        $visitors = Visitor::orderBy('created_at', $order)->paginate($limit);

        $visitors = VisitorResource::collection($visitors);

        return $this->responseWithPaginate($visitors);
    }
}
