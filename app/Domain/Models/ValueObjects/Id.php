<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObjects;

readonly class Id
{
    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(public int $value)
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException(sprintf('Неверное значение для id: "%s"', $value));
        }
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
