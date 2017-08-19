<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class makeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建一个Repository和相应的Interface文件, 用于数据库操作, 默认为Eloquent';

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
        $this->info('这是一个测试命令');
    }
}
