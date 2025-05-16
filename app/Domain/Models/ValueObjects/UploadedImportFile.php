<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObjects;

use App\Domain\Enums\ImportingEntityType;

readonly class UploadedImportFile
{
    public function __construct(
        public string              $originalName,
        public string              $extension,
        public FilePath            $path,
        public ImportingEntityType $importingEntityType
    )
    {
    }
}
