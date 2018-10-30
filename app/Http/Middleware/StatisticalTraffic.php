<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class StatisticalTraffic
{
    const PV = 'BLOG_PV_COUNT';
    const UV = 'BLOG_UV_COUNT';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Redis::pipeline(function ($redis) use ($request) {
            // 统计PV
            if ($redis->exists(self::PV)) {
                $redis->incr(self::PV);
            } else {
                $redis->set(self::PV, 1);
            }

            // 统计UV
            $redis->sadd(self::UV, $request->ip());
        });

        return $next($request);
    }
}
