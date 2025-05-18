<?php
declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Commands\PersonsListByDateCommand;
use App\Domain\Models\ValueObjects\DateTime;
use App\Domain\Services\PersonsService;

class PersonsListByDateHandler
{
    public function __construct(
        private PersonsService $personsService
    )
    {

    }

    public function handle(PersonsListByDateCommand $command): array
    {
        return $this->personsService->listByDates(
            new DateTime($command->dateFrom),
            new DateTime($command->dateTo)
        );
    }
}
