<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Http\Controllers\Admin\ApiController;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if (! $request->header('X-Requested-With')) {
            return parent::render($request, $exception);
        }

        $api = new ApiController;

        if ($exception instanceof UnauthorizedException) {
            // token 不存在、token 找不到用户
            $response = $api->unAuthorized($exception->getMessage());
        } elseif ($exception instanceof JWTException) {
            // refresh_token 已过期、token 数据解析异常
            $response = $api->unAuthorized($exception->getMessage());
        } elseif ($exception instanceof ValidationException) {
            // 表单验证错误
            $response = $api->badRequest(
                $exception->validator->errors()->first()
            );
        } elseif ($exception instanceof ModelNotFoundException) {
            // 模型找不到
            $response = $api->notFound('数据不存在');
        } elseif ($exception instanceof NotFoundHttpException) {
            // 404 页面
            $response = $api->notFound();
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            // 请求方法不允许
            $response = $api->methodNotAllow();
        } else {
            // 其他异常
            $response = $api->serviceUnavailable($exception->getTraceAsString());
        }

        return $response;
    }
}
