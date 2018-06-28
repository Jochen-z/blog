<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * 消息状态码
     * @var int
     */
    protected $code = Response::HTTP_OK;
    
    /**
     * 消息内容
     * @var string
     */
    protected $message = '操作成功';
    
    /**
     * 响应数据
     * @var array
     */
    protected $data = [];

    /**
     * 操作成功响应
     *
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data = [])
    {
        return $this->setData($data)->toJson();
    }

    /**
     * 资源创建成功响应
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function created($message = '资源创建成功')
    {
        return $this->setCode(Response::HTTP_CREATED)->setMessage($message)->toJson();
    }

    /**
     * 资源删除成功响应
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleted($message = '资源删除成功')
    {
        return $this->setCode(Response::HTTP_NO_CONTENT)->setMessage($message)->toJson();
    }

    /**
     * 资源更新成功响应
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function updated($message = '资源更新成功')
    {
        return $this->setCode(Response::HTTP_CREATED)->setMessage($message)->toJson();
    }

    /**
     * 表单验证错误响应
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function badRequest($message = '表单验证出错')
    {
        return $this->setCode(Response::HTTP_BAD_REQUEST)->setMessage($message)->toJson();
    }

    /**
     * 权限不足响应
     * 
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function forbidden($message = '权限不足')
    {
        return $this->setCode(Response::HTTP_FORBIDDEN)->setMessage($message)->toJson();
    }

    /**
     * 身份验证失败响应
     * 
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function unAuthorized($message = '身份验证失败')
    {
        return $this->setCode(Response::HTTP_UNAUTHORIZED)->setMessage($message)->toJson();
    }

    /**
     * 页面找不到响应
     * 
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFound($message = '请求页面找不到')
    {
        return $this->setCode(Response::HTTP_NOT_FOUND)->setMessage($message)->toJson();
    }

    /**
     * 请求方法不存在
     * 
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function methodNotAllow($message = '请求方法不允许')
    {
        return $this->setCode(Response::HTTP_METHOD_NOT_ALLOWED)->setMessage($message)->toJson();
    }

    /**
     * 服务器位置错误响应
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function serviceUnavailable($message = '服务器未知出错')
    {
        return $this->setCode(Response::HTTP_SERVICE_UNAVAILABLE)->setMessage($message)->toJson();
    }

    /**
     * 返回 JSON 响应数据
     * 
     * @param int $httpStatus
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function toJson($httpStatus = 200, $headers = [])
    {
        return response()->json(
            $this->formatResponse(),
            $httpStatus,
            $headers,
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * API 返回数据格式
     *
     * @return array
     */
    protected function formatResponse()
    {
        return [
            'code'    => $this->code,
            'message' => $this->message,
            'data'    => $this->data
        ];
    }

    /**
     * 设置响应状态码
     * 
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        
        return $this;
    }

    /**
     * 设置响应消息
     * 
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        
        return $this;
    }

    /**
     * 设置响应返回数据
     * 
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        
        return $this;
    }
}
