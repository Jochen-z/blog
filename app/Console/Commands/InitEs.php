<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class InitEs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init Elasticsearch to create index';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        $this->createTemplate($client);
        $response = $this->createIndex($client);
        if ($response->getStatusCode() == 200) {
            echo 'Init Elasticsearch successfully!' . PHP_EOL;
        }

        return true;
    }

    /**
     * 创建索引
     *
     * @param Client $client
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function createIndex(Client $client)
    {
        $url = config('scout.elasticsearch.hosts')[0] . ':9200/' . config('scout.elasticsearch.index');

        return $client->put($url, [
            'json' => [
                'settings' => [
                    'refresh_interval' => '5s',
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0,
                ],
                'mappings' => [
                    '_default_' => [
                        '_all' => [
                            'enabled' => false
                        ]
                    ]
                ]
            ]
        ]);
    }

    /**
     * 创建模板
     *
     * @param Client $client
     */
    protected function createTemplate(Client $client)
    {
        $url = config('scout.elasticsearch.hosts')[0] . ':9200/' . '_template/rtf';

        $client->put($url, [
            'json' => [
                'template' => '*',
                'settings' => [
                    'number_of_shards' => 1
                ],
                'mappings' => [
                    '_default_' => [
                        '_all' => [
                            'enabled' => true
                        ],
                        'dynamic_templates' => [
                            [
                                'strings' => [
                                    'match_mapping_type' => 'string',
                                    'mapping' => [
                                        'type' => 'text',
                                        'analyzer' => 'ik_smart',
                                        'ignore_above' => 256,
                                        'fields' => [
                                            'keyword' => [
                                                'type' => 'keyword'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }
}
