<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RefreshToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            // 检查请求是否带有 token
            $this->checkForToken($request);

            // 检测用户的登录状态，若 token 已过期，则抛出 TokenExpiredException  异常
            if (! $this->auth->parseToken()->authenticate()) {
                return response('Unauthenticated.', 401);
            }

            return $next($request);
        }
        catch (UnauthorizedHttpException $exception) {
            // 参数异常
            return response($exception->getMessage(), 403);
        }
        catch (TokenExpiredException $exception) {
            // token 已过期
            try {
                // 刷新用户的 token
                $token = $this->auth->refresh();
                // 使用一次性登录以保证此次请求的成功
                $claim = $this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray();
                auth('api')->onceUsingId($claim['sub']);
                // 在响应头中返回新的 token
                return $this->setAuthenticationHeader($next($request), $token);
            } catch (JWTException $exception) {
                // refresh 已过期
                return response($exception->getMessage(), 401);
            }
        }
        catch (JWTException $exception) {
            // token 数据解析异常
            return response($exception->getMessage(), 400);
        }
    }
}
