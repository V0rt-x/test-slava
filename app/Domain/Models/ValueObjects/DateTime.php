<?php
declare(strict_types=1);

namespace App\Domain\Models\ValueObjects;

readonly class DateTime
{
    public function __construct(public \DateTime $value)
    {
    }

    public function __toString()
    {
        return $this->value->format('Y-m-d H:i:s');
    }

    public function format(string $format): string
    {
        return $this->value->format($format);
    }

    public static function fromFormat(string $format, string $value): DateTime
    {
        try {
            return new self(\DateTime::createFromFormat($format, $value));
        } catch (\Throwable $e) {
            throw new \InvalidArgumentException(sprintf('Неверный формат даты "%s" для значения "%s"', $format, $value), previous: $e);
        }
    }
}
