<?php

if (! function_exists('route_class')) {
    function route_class() {
        return str_replace('.', '-', Route::currentRouteName());
    }
}

if (! function_exists('array_group')) {
    /**
     * 根据 key 给二维数组分组
     *
     * @param $arr
     * @param $key
     * @return array
     */
    function array_group($arr, $key) {
        $grouped = [];

        foreach ($arr as $value) {
            $grouped[$value[$key]][] = $value;
        }

        return $grouped;
    }
}