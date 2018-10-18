<?php

namespace App\Tools;

trait EsSearchable
{
    public $searchSettings = [
        'attributesToHighlight' => ['*']
    ];

    public $highlight = [];
}