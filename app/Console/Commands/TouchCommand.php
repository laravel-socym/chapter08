<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TouchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'touch {arg} {--switch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ファイル生成';

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
        $message = '';
        $message .= $this->argument('arg') . "\n";
        $message .= $this->option('switch') ? 'ON' : 'OFF' . "\n";
        file_put_contents('/tmp/hoge', $message);
    }
}
