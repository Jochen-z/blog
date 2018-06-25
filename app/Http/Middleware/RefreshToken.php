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
     * @throws JWTException
     */
    public function handle($request, Closure $next)
    {
        // 检查此次请求中是否带有 token，如果没有则抛出异常
        $this->checkForToken($request);

        try {
            // 检测用户的登录状态，如果正常则通过
            // 若 token 已过期，则抛出 TokenExpiredException  异常
            if ($this->auth->parseToken()->authenticate()) {
                return $next($request);
            }

            // token 是无效的，用户尚未认证
            throw new UnauthorizedHttpException('jwt-auth', 'Unauthenticated.');
        } catch (TokenExpiredException $exception) {
            // 刷新该用户的 token 并将它添加到响应头中
            try {
                // 刷新用户的 token
                $token = $this->auth->refresh();
                // 使用一次性登录以保证此次请求的成功
                $id = $this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub'];
                auth('api')->onceUsingId($id);
            } catch (JWTException $exception) {
                // 如果捕获到此异常，即代表 refresh 已过期，用户无法刷新令牌，需要重新登录
                throw new UnauthorizedHttpException('jwt-auth', 'Unauthenticated.');
            }
        }

        // 在响应头中返回新的 token
        return $this->setAuthenticationHeader($next($request), $token);
    }
}
