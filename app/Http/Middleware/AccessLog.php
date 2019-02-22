<?php

namespace App\Http\Middleware;

use Closure;
use App\Jobs\AccessLog as AccessLogJob;

class AccessLog
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
        if (env('ACCESS_LOG')) {
            $message = [
                'ip' => $request->getClientIp(),
                'uri' => $request->path(),
                'method' => $request->method(),
                'userAgent' => $request->userAgent(),
                'queryString' => http_build_query($request->query()),
            ];
            AccessLogJob::dispatch($message)->delay(now()->addMinutes(1));

//            $uri = $request->path();
//            $method = $request->method();
//            $userAgent = $request->userAgent();
//            $ip = $request->getClientIp();
//            $ipInfo = implode(' ', getIpLocation($ip));
//            $queryString = http_build_query($request->query());
//            $logMsg = join([$method . ' ' . $uri . ' ' . $queryString, $userAgent, $ip, $ipInfo], ' | ');
//
//            \Log::channel('access')->info($logMsg);
        }

        return $next($request);
    }
}
