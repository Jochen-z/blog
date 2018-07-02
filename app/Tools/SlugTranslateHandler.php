<?php

namespace App\Tools;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    /**
     * 生成 SEO 友好 URL
     *
     * @param $text
     * @return string
     */
    public function translate($text)
    {
        $key = config('services.translate.key');
        $appId = config('services.translate.app_id');
        if (empty($key) || empty($appId)) {
            return $this->pinyin($text);
        }

        $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $salt = time();
        $sign = md5($appId. $text . $salt . $key);

        // 构建请求参数
        $query = http_build_query([
            "q"     =>  $text,
            "from"  => "zh",
            "to"    => "en",
            "appid" => $appId,
            "salt"  => $salt,
            "sign"  => $sign,
        ]);

        // 发送 HTTP 请求
        $http = new Client();
        $response = $http->get($api.$query);
        $result = json_decode($response->getBody(), true);
        if (isset($result['trans_result'][0]['dst'])) {
            // 获取百度翻译结果
            return str_slug($result['trans_result'][0]['dst']);
        }

        // 使用拼音
        return $this->pinyin($text);
    }

    /**
     * 将中文转为拼音字符
     *
     * @param $text
     * @return string
     */
    public function pinyin($text)
    {
        return str_slug(app(Pinyin::class)->permalink($text));
    }
}
