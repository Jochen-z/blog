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