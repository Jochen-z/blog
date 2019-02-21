<?php

/**
 * 统计字数
 *
 * @param $str
 * @return int
 */
function countWords($str)
{
    $symbolPattern  = '/[\x{ff00}-\x{ffef}\x{2000}-\x{206F}]/u';
    $chinesePattern = '/[\x{4e00}-\x{9fff}\x{f900}-\x{faff}]/u';

    $chineseLength = preg_match_all($chinesePattern, preg_replace($symbolPattern, '', $str), $arr);
    $englishLength = str_word_count(preg_replace($chinesePattern, '', $str));

    return (int)($chineseLength + $englishLength);
}

/**
 * 获取当前控制器与方法
 *
 * @return array
 */
function currentAction()
{
    $action = \Route::current()->getActionName();
    list($class, $method) = explode('@', $action);

    return ['controller' => $class, 'method' => $method];
}

/**
 * 获取IP地理位置
 *
 * @param $ip
 * @return array|mixed
 */
function getIpLocation($ip)
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

/**
 * 获取不带域名的URL
 *
 * @return mixed
 */
function url_without_host()
{
    return ltrim(str_replace($_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"], '', request()->fullUrl()), '/');
}