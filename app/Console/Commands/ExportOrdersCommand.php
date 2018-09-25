<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\UseCases\ExportOrdersUseCase;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExportOrdersCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:export-orders {date} {--output=}'; // <---(1)

    /**
     * @var string
     */
    protected $description = '購入情報を出力する'; // <---(2)

    /** @var ExportOrdersUseCase */
    private $useCase; // <---(1)

    public function __construct(ExportOrdersUseCase $useCase) // <---(2)
    {
        parent::__construct();

        $this->useCase = $useCase;
    }

    public function handle()
    {
        $date = $this->argument('date');
        $targetDate = Carbon::createFromFormat('Ymd', $date);

        $tsv = $this->useCase->run($targetDate);

        // (1) outputオプションの値を取得
        $outputFilePath = $this->option('output');
        // (2) nullであれば未指定なので、標準出力に出力
        if (is_null($outputFilePath)) {
            echo $tsv;
            return;
        }

        // (3) ファイルに出力
        file_put_contents($outputFilePath, $tsv);
    }
}
