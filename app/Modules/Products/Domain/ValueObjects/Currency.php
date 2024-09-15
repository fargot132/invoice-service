<?php

declare(strict_types=1);

namespace App\Modules\Products\Domain\ValueObjects;

use App\Domain\Enums\CurrencyEnum;
use InvalidArgumentException;
use JsonSerializable;
use Stringable;

class Currency implements Stringable, JsonSerializable
{
    private function __construct(private CurrencyEnum $currency)
    {
    }

    public function equals(Currency $other): bool
    {
        return $this->value() === $other->value();
    }

    public function value(): CurrencyEnum
    {
        return $this->currency;
    }

    public function jsonSerialize(): string
    {
        return $this->currency->value;
    }

    public static function fromString(string $currency): static
    {
        return match ($currency) {
            CurrencyEnum::USD->value => new static(CurrencyEnum::USD),
            default => throw new InvalidArgumentException("Invalid currency '{$currency}'"),
        };
    }

    public function __toString(): string
    {
        return $this->currency->value;
    }
}
