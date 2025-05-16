<?php

namespace App\Application\Commands;


use App\Domain\Models\ValueObjects\UploadedImportFile;

readonly class PersonFileUploadCommand
{
    public function __construct(
        public UploadedImportFile $file
    )
    {

    }
}
