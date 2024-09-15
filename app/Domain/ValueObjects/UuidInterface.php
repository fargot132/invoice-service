<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use JsonSerializable;
use Ramsey\Uuid\UuidInterface as RamseyUuidInterface;
use Stringable;

interface UuidInterface extends Stringable, JsonSerializable
{
    public function equals(UuidInterface $other): bool;

    public function value(): RamseyUuidInterface;

    public static function generate(): static;

    public static function fromString(string $uuid): static;
}
