<?php
declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Commands\PersonFileUploadCommand;
use App\Domain\Models\ImportFile;
use App\Domain\Repositories\ImportFileRepositoryInterface;

class PersonFileUploadHandler
{
    public function __construct(
        private readonly ImportFileRepositoryInterface $importFileRepository
    )
    {

    }

    public function handle(PersonFileUploadCommand $command): ?ImportFile
    {
        return $this->importFileRepository->store($command->file);
    }
}
