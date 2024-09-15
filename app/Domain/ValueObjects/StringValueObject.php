<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use JsonSerializable;
use Stringable;

class StringValueObject implements Stringable, JsonSerializable
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function equals(StringValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function empty(): bool
    {
        return empty($this->value());
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }

    public static function fromString(string $value): static
    {
        return new static($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
