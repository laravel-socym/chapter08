<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NoArgsCommand extends Command
{
    const PATH = '/tmp/no-args-command';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'no-args-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '引数無しコマンド';

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
        file_put_contents(self::PATH, 'no-args');
    }
}
