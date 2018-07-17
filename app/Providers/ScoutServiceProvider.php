<?php

namespace App\Providers;

use App\Tools\TokenizerHandler;
use TeamTNT\TNTSearch\TNTSearch;
use Laravel\Scout\EngineManager;
use TeamTNT\Scout\Console\ImportCommand;
use TeamTNT\Scout\Engines\TNTSearchEngine;
use TeamTNT\Scout\TNTSearchScoutServiceProvider;

class ScoutServiceProvider extends TNTSearchScoutServiceProvider
{
    public function boot()
    {
        $this->app[EngineManager::class]->extend('tntsearch', function ($app) {
            $driver = config('database.default');
            $config = config('scout.tntsearch') + config("database.connections.{$driver}");

            $tnt = new TNTSearch();
            $tnt->loadConfig($config);

            # 注入中文分词服务
            $tnt->setTokenizer(new TokenizerHandler(config('scout.tntsearch.tokenizer.jieba')));

            $tnt->setDatabaseHandle(app('db')->connection()->getPdo());
            $this->setFuzziness($tnt);
            $this->setAsYouType($tnt);

            return new TNTSearchEngine($tnt);
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                ImportCommand::class,
            ]);
        }
    }
}