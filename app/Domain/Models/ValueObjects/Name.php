<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObjects;

use InvalidArgumentException;

readonly class Name
{
    public function __construct(
        public string $value,
    )
    {
        if (!preg_match('/^[A-Z][a-zA-Z]*$/', $value)) {
            throw new InvalidArgumentException(sprintf('Неверное имя: "%s"', $value));
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
