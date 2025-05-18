<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObjects;

use InvalidArgumentException;

readonly class FullName
{
    public function __construct(
        private Name $firstName,
        private Name $lastName
    )
    {

    }

    /**
     * @param string $value
     * @return FullName
     * @throws InvalidArgumentException
     */
    public static function make(string $value): FullName
    {
        if (!preg_match('/^([A-Z][a-zA-Z]*) ([A-Z][a-zA-Z]*)$/', $value, $matches)) {
            throw new InvalidArgumentException(sprintf('Неверное имя: "%s"', $value));
        }

        return new self(
            new Name($matches[1]),
            new Name($matches[2]),
        );
    }

    public function getFirstName(): Name
    {
        return $this->firstName;
    }

    public function getLastName(): Name
    {
        return $this->lastName;
    }
}
