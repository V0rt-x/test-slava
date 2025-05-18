<?php
declare(strict_types=1);

namespace App\Domain\Parsers;

use App\Domain\Models\ImportFile;

interface FileParserInterface
{
    public function readRows(ImportFile $file, callable $callback): void;
}
