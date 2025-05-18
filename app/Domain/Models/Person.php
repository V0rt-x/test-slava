<?php
declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Models\ValueObjects\DateTime;
use App\Domain\Models\ValueObjects\Id;
use App\Domain\Models\ValueObjects\Name;

class Person
{
    public function __construct(
        private Id       $id,
        private Name     $firstName,
        private Name     $lastName,
        private DateTime $date,
    )
    {
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getFirstName(): Name
    {
        return $this->firstName;
    }

    public function getLastName(): Name
    {
        return $this->lastName;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }
}
