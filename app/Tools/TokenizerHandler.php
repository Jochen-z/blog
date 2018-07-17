<?php

namespace App\Tools;

use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
use TeamTNT\TNTSearch\Support\TokenizerInterface;

class TokenizerHandler implements TokenizerInterface
{
    public function __construct(array $options = [])
    {
        Jieba::init($options);
        Finalseg::init($options);
    }

    public function tokenize($text, $stopwords = [])
    {
        return is_numeric($text) ? [] : $this->getTokens($text, $stopwords);
    }

    public function getTokens($text, $stopwords = [])
    {
        return Jieba::cutForSearch($text);
    }
}