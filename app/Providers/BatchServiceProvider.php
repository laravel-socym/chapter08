<?php
declare(strict_types=1);

namespace App\Providers;

use App\Console\Commands\SendOrdersCommand;
use App\Services\ChatWorkService;
use App\Services\ExportOrdersService;
use App\UseCases\SendOrdersUseCase;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Support\ServiceProvider;

class BatchServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(SendOrdersCommand::class, function () {
            $useCase = app(SendOrdersUseCase::class);
            /** @var Writer $logger */
            $logger = app(Writer::class);
            $logger->useFiles(storage_path() . '/logs/send-orders.log');
            $chatwork = app(ChatWorkService::class);

            return new SendOrdersCommand($useCase, $logger, $chatwork);
        });

        $this->app->bind(SendOrdersUseCase::class, function () {
            $service = $this->app->make(ExportOrdersService::class);
            $guzzle = new Client([
                'handler' => tap(HandlerStack::create(), function (HandlerStack $v) {
                    /** @var Writer $logger */
                    $logger = $this->app->make(Writer::class);

                    $v->push(Middleware::log(
                        $logger->getMonolog(),
                        new MessageFormatter(">>>\n{req_headers}\n<<<\n{res_headers}\n\n{res_body}")
                    ));
                })
            ]);

            return new SendOrdersUseCase($service, $guzzle);
        });

        $this->app->bind(ChatWorkService::class, function () {
            $config = app(Repository::class);
            $apiKey = $config->get('batch.chatwork_api_key');
            $roomId = $config->get('batch.chatwork_room_id');

            return new ChatWorkService($apiKey, $roomId, new Client());
        });
    }
}
