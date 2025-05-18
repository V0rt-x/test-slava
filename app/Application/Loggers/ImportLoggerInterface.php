<?php
declare(strict_types=1);

namespace App\Application\Loggers;

interface ImportLoggerInterface
{
    public function error(string $message, array $context = []): void;
}
