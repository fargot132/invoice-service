<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use DateTimeImmutable;
use JsonSerializable;
use Stringable;

interface DateTimeValueObjectInterface extends Stringable, JsonSerializable
{
    public function equals(DateTimeValueObjectInterface $other): bool;

    public function value(): DateTimeImmutable;

    public static function fromString(string $datetime): static;

    public static function fromInterface(\DateTimeInterface $datetime): static;
}
