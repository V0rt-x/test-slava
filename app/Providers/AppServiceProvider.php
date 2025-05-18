<?php
declare(strict_types=1);

namespace App\Providers;

use App\Application\Loggers\ImportLoggerInterface;
use App\Domain\Parsers\FileParserInterface;
use App\Domain\Repositories\ImportFileRepositoryInterface;
use App\Domain\Repositories\PersonsRepositoryInterface;
use App\Infrastructure\Loggers\LaravelImportLogger;
use App\Infrastructure\Parsers\SimpleExcelFileParser;
use App\Infrastructure\Repositories\ImportFileRepository;
use App\Infrastructure\Repositories\PersonsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ImportFileRepositoryInterface::class => ImportFileRepository::class,
        PersonsRepositoryInterface::class => PersonsRepository::class,
        FileParserInterface::class => SimpleExcelFileParser::class,
        ImportLoggerInterface::class => LaravelImportLogger::class,
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
