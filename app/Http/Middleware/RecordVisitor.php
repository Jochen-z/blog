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
        if (env('APP_ENV') == 'production') {
            $visitor = [
                'ip'    => $request->ip(),
                'path'  => $request->path(),
                'agent' => $request->userAgent()
            ];
            if ($location = getIpLocation($visitor['ip'])) {
                $visitor['location'] = "{$location[0]} - {$location[1]} - {$location[2]}";
            }
            Visitor::create($visitor);
        }

        return $next($request);
    }
}
