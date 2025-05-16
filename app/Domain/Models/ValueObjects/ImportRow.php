<?php

namespace App\Domain\Models\ValueObjects;

use App\Domain\Enums\ImportingEntityType;

readonly class ImportRow
{
    public function __construct(public array $value, public ImportingEntityType $type)
    {

    }

    public function jsonValue(): string
    {
        return json_encode($this->value);
    }
}
