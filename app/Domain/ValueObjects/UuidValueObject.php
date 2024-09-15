<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface as RamseyUuidInterface;

class UuidValueObject implements UuidInterface
{
    private RamseyUuidInterface $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = Uuid::fromString($uuid);
    }

    public function equals(UuidInterface $other): bool
    {
        return $this->uuid->equals($other);
    }

    public function value(): RamseyUuidInterface
    {
        return $this->uuid;
    }

    public function jsonSerialize(): string
    {
        return $this->uuid->toString();
    }

    public static function fromString(string $uuid): static
    {
        return new static($uuid);
    }

    public static function generate(): static
    {
        return new static(Uuid::uuid4()->toString());
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }
}
