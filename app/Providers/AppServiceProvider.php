<?php

namespace App\Providers;

use App\Domain\Tractor\Repositories\TractorRepositoryInterface;
use App\Infrastructure\Bus\CommandBusInterface;
use App\Infrastructure\Bus\QueryBusInterface;
use App\Infrastructure\Bus\SimpleCommandBus;
use App\Infrastructure\Bus\SimpleQueryBus;
use App\Infrastructure\Repositories\EloquentTractorRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind Repository Interface to Implementation (Dependency Inversion Principle)
        $this->app->bind(TractorRepositoryInterface::class, EloquentTractorRepository::class);

        // Bind CQRS Bus Interfaces to Implementations
        $this->app->bind(CommandBusInterface::class, SimpleCommandBus::class);
        $this->app->bind(QueryBusInterface::class, SimpleQueryBus::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
