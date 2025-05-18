<?php
declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Models\Person;
use App\Domain\Models\ValueObjects\DateTime;
use App\Domain\Models\ValueObjects\FullName;
use App\Domain\Models\ValueObjects\Id;

class PersonImportService
{
    /**
     * @param array $row
     * @return Person
     * @throws \InvalidArgumentException
     */
    public function rowToPerson(array $row): Person
    {
        $fullName = FullName::make($row['name']);

        return new Person(
            new Id(intval($row['id'])),
            $fullName->getFirstName(),
            $fullName->getLastName(),
            DateTime::fromFormat('d.m.Y', $row['date'])
        );
    }
}
