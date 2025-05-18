<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObjects;

use Illuminate\Support\Carbon;

readonly class DateTime
{
    public \DateTime $value;

    public function __construct(string $value, string $format)
    {
        try {
            $this->value = Carbon::createFromFormat($format, $value);
        } catch (\Throwable $e) {
            throw new \InvalidArgumentException(sprintf('Неверный формат даты "%s" для значения "%s"', $format, $value), previous: $e);
        }
    }

    public function __toString()
    {
        return (string)$this->value;
    }

    public function format(string $format): string
    {
        return $this->value->format($format);
    }
}
