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
        private bool                $imported
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPath(): FilePath
    {
        return $this->path;
    }
}
