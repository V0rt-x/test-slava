<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Models\ValueObjects\DateTime;
use App\Domain\Repositories\PersonsRepositoryInterface;

class PersonsService
{
    public function __construct(
        private readonly PersonsRepositoryInterface $repository
    )
    {
    }

    public function listByDates(DateTime $dateFrom, DateTime $dateTo): array
    {
        $persons = $this->repository->listBetweenDates($dateFrom, $dateTo);

        $personsByDate = [];

        foreach ($persons as $person) {
            $personsByDate[$person->getDate()->format('Y-m-d')][] = $person;
        }

        return $personsByDate;
    }
}
