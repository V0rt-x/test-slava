<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Person;
use App\Domain\Models\ValueObjects\DateTime;

interface PersonsRepositoryInterface
{
    /**
     * @param array<Person> $persons
     * @return void
     */
    public function saveMany(array $persons): void;

    /**
     * @param DateTime $dateFrom
     * @param DateTime $dateTo
     * @return Person[]
     */
    public function listBetweenDates(DateTime $dateFrom, DateTime $dateTo): array;
}
