<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WithArgsCommand extends Command
{
    const PATH = '/tmp/some-command';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'with-args-command {arg?} {--switch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '引数ありコマンド';

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
        $message .= $this->option('switch') ? 'ON' : 'OFF';
        file_put_contents(self::PATH, $message);
    }
}
