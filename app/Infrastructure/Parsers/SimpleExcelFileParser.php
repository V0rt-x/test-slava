<?php
declare(strict_types=1);

namespace App\Infrastructure\Parsers;

use App\Domain\Models\ImportFile;
use App\Domain\Parsers\FileParserInterface;
use Spatie\SimpleExcel\SimpleExcelReader;

class SimpleExcelFileParser implements FileParserInterface
{
    public function readRows(ImportFile $file, callable $callback): void
    {
        SimpleExcelReader::create($file->getPath()->value, 'xlsx')->getRows()
            ->each($callback);
    }
}
