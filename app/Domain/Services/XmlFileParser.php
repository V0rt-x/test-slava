<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Models\ValueObjects\UploadedImportFile;
use Spatie\SimpleExcel\SimpleExcelReader;

class XmlFileParser
{
    public function readRows(UploadedImportFile $file, callable $callback): void
    {
        SimpleExcelReader::create($file->path->value, 'xlsx')->getRows()
            ->each($callback);
    }

    public function validate()
    {

    }
}
