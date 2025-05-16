<?php
declare(strict_types=1);

namespace App\Providers;

use App\Domain\Repositories\ImportFileRepositoryInterface;
use App\Infrastructure\Repositories\ImportFileRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ImportFileRepositoryInterface::class => ImportFileRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
