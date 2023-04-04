<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class FlushRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flush:redis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpa o banco de dados redis';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Redis::command('flushdb');
    }
}