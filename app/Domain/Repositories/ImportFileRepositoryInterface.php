<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Enums\ImportingEntityType;
use App\Domain\Models\ImportFile;
use App\Domain\Models\ValueObjects\UploadedImportFile;

interface ImportFileRepositoryInterface
{
    public function store(UploadedImportFile $file): ?ImportFile;

    public function getOldest(ImportingEntityType $importingEntityType): ?ImportFile;

    public function checkAsImported(ImportFile $importFile): bool;
}
