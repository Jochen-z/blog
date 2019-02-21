<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\OperationLog;
use App\Http\Resources\OperationLogResource;

class OperationLogController extends ApiController
{
    /**
     * 操作日志
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
        $logs = OperationLogResource::collection(OperationLog::orderBy('created_at', $order)->paginate($limit));

        return $this->responseWithPaginate($logs);
    }
}
