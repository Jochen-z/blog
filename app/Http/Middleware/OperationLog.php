<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\OperationLog as Log;

class OperationLog
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
        if (env('APP_ENV') == 'production') {
            $log = [
                'ip'       => $request->ip(),
                'username' => auth('api')->user()->email ?? '',
                'path'     => url_without_host(),
                'agent'    => $request->userAgent()
            ];
            if ($location = getIpLocation($log['ip'])) {
                $log['location'] = "{$location[0]} - {$location[1]} - {$location[2]}";
            }
            Log::create($log);
        }

        return $next($request);
    }
}
