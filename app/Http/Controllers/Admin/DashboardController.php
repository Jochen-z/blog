<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Traffic;
use App\Http\Resources\TrafficResource;

class DashboardController extends ApiController
{
    /**
     * Dashboard 面板数据
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = [
            'visitor'   => Traffic::where('type', 'UV')->pluck('total')->sum(),
            'article'   => Article::count(),
            'category'  => Category::count(),
            'tag'       => Tag::count(),
        ];

        return $this->success($data);
    }

    /**
     * 流量统计数据
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function traffic(Request $request)
    {
        $dates = $request->get('dates', 7);

        $response = [];
        $pv = TrafficResource::collection(Traffic::pv($dates))->toArray($request);
        foreach($pv as $item) {
            $response['xAxis'][] = $item['created_at'];
            $response['yAxis']['pv'][] = $item['total'];
        }
        $response['xAxis'] = array_reverse($response['xAxis']);
        $response['yAxis']['pv'] = array_reverse($response['yAxis']['pv']);

        $uv = TrafficResource::collection(Traffic::uv($dates))->toArray($request);
        foreach($uv as $item) {
            $response['yAxis']['uv'][] = $item['total'];
        }
        $response['yAxis']['uv'] = array_reverse($response['yAxis']['uv']);

        return $this->success($response);
    }
}