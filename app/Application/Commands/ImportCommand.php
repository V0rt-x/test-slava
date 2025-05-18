<?php
declare(strict_types=1);

namespace App\Application\Commands;

use App\Domain\Enums\ImportingEntityType;

readonly class ImportCommand
{
    public function __construct(
        public ImportingEntityType $importingEntityType
    )
    {

    }
}
