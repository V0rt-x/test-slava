<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Person;

interface PersonsRepositoryInterface
{
    /**
     * @param array<Person> $persons
     * @return void
     */
    public function saveMany(array $persons): void;
}
