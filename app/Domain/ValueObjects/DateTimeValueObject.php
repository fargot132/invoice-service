<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use InvalidArgumentException;

class DateTimeValueObject extends DateTimeImmutable implements DateTimeValueObjectInterface
{
    public const DATETIME_FORMAT = 'Y-m-d H:i:s';
    public const DATETIME_ZONE = 'UTC';

    public function equals(DateTimeValueObjectInterface $other): bool
    {
        return $this === $other;
    }

    public function value(): DateTimeImmutable
    {
        return $this;
    }

    public function jsonSerialize(): string
    {
        return $this->__toString();
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function fromString(string $datetime): static
    {
        try {
            return new static($datetime);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Invalid datetime string provided');
        }
    }

    /**
     * @throws Exception
     */
    public static function fromInterface(DateTimeInterface $datetime): static
    {
        return new static($datetime->format(static::DATETIME_FORMAT));
    }

    public function __toString(): string
    {
        return $this->setTimezone(new DateTimeZone(static::DATETIME_ZONE))->format(static::DATETIME_FORMAT);
    }
}
