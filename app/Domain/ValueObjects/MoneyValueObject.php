<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use JsonSerializable;
use Stringable;

class MoneyValueObject implements Stringable, JsonSerializable
{
    public function __construct(private int $value)
    {
    }

    public function value(): int
    {
        return $this->value;
    }

    public function toFloat(): float
    {
        return $this->value / 100;
    }

    public function equals(MoneyValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function add(MoneyValueObject $other): static
    {
        return new static($this->value() + $other->value());
    }

    public function substract(MoneyValueObject $other): static
    {
        return new static($this->value() - $other->value());
    }

    public function multiply(int $multiplier): static
    {
        return new static($this->value() * $multiplier);
    }

    public function jsonSerialize(): float
    {
        return $this->value / 100;
    }

    public static function fromFloat(float $value): static
    {
        return new static((int)($value * 100));
    }

    public static function fromString(string $value): static
    {
        return new static((int)($value * 100));
    }

    public function __toString(): string
    {
        return (string)$this->value / 100;
    }
}
