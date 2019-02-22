<?php

namespace App\Jobs;

use Log;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AccessLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $log = join([
            $this->request['method'] . ' ' . $this->request['uri'] . ' ' . $this->request['queryString'],
            $this->request['userAgent'],
            $this->request['ip'],
            implode(' ', getIpLocation($this->request['ip'])),
        ], ' | ');

        Log::channel('access')->info($log);
    }
}
