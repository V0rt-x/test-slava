<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObjects;

readonly class FilePath
{
    public function __construct(public string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
