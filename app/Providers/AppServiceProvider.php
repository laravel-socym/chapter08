<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Connection;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /** @var Connection $connection */
        $connection = $this->app->make(Connection::class);

        $connection->listen(function (QueryExecuted $query) {
            /** @var LoggerInterface $logger */
            $logger = $this->app->make(LoggerInterface::class);
            $logger->debug(sprintf('%s %s %s', $query->sql, json_encode($query->bindings), $query->time));
        });
    }
}
