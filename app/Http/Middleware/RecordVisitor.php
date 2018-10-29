<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;

class RecordVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $visitor = [
            'path' => $request->path(),
            'ip' => $request->ip(),
            'agent' => $request->userAgent()
        ];
        if ($location = $this->getLocation($visitor['ip'])) {
            $visitor['location'] = "{$location[0]} - {$location[1]} - {$location[2]}";
        }
        Visitor::create($visitor);

        return $next($request);
    }

    /**
     * 获取IP地理位置
     *
     * @param $ip
     * @return array|mixed
     */
    protected function getLocation($ip)
    {
        $url = "http://freeapi.ipip.net/{$ip}";

        try {
            $response = file_get_contents($url);
            if (!empty($response) && $location = json_decode($response, true)) {
                return $location;
            }
            return [];
        } catch (\Exception $exception) {
            return [];
        }
    }
}
