<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Stringable;

class IntegerValueObject implements Stringable, \JsonSerializable
{
    public function __construct(private int $value)
    {
    }

    public static function fromInt(int $value): self
    {
        return new self($value);
    }

    public function equals(IntegerValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function value(): int
    {
        return $this->value;
    }

    public function jsonSerialize(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
