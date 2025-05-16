<?php
declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Enums\ImportingEntityType;
use App\Domain\Models\ValueObjects\FilePath;

class ImportFile
{
    public function __construct(
        private int                 $id,
        private FilePath            $path,
        private ImportingEntityType $type,
    )
    {
    }
}
