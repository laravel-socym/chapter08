<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ErrorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'error';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'エラー発生';

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
        throw new \Exception('error!');
    }
}
