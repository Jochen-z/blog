<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use App\Models\Traffic;

class RecordTraffic extends Command
{
    const PV = 'BLOG_PV_COUNT';
    const UV = 'BLOG_UV_COUNT';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'record:traffic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Record statistical traffic daily';

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
        $pv = $uv = 0;

        // 统计并重置PV、UV
        $redis = Redis::connection();
        if ($redis->exists(self::PV)) {
            $pv = $redis->get(self::PV);
            $redis->set(self::PV, 0);
        }

        $uv = $redis->scard(self::UV);
        $redis->del(self::UV);

        // 将PV、UV数据入库
        Traffic::create(['total' => $pv, 'type' => 'PV']);
        Traffic::create(['total' => $uv, 'type' => 'UV']);
    }
}
