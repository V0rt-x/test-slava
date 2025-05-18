<?php
declare(strict_types=1);

namespace App\Infrastructure\Loggers;

use App\Application\Loggers\ImportLoggerInterface;
use Illuminate\Support\Facades\Log;

class LaravelImportLogger implements ImportLoggerInterface
{
    public function error(string $message, array $context = []): void
    {
        Log::channel('import')->error($message, $context);
    }
}
