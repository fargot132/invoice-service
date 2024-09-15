<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\ValueObjects;

use App\Domain\Enums\StatusEnum;
use InvalidArgumentException;
use JsonSerializable;
use Stringable;

final class Status implements Stringable, JsonSerializable
{
    public function __construct(private StatusEnum $status)
    {
    }

    public static function fromString(string $status): self
    {
        return match ($status) {
            StatusEnum::DRAFT->value => new self(StatusEnum::DRAFT),
            StatusEnum::APPROVED->value => new self(StatusEnum::APPROVED),
            StatusEnum::REJECTED->value => new self(StatusEnum::REJECTED),
            default => throw new InvalidArgumentException("Invalid status '{$status}'")
        };
    }

    public function equals(Status $other): bool
    {
        return $this->value() === $other->value();
    }

    public function value(): StatusEnum
    {
        return $this->status;
    }

    public function jsonSerialize(): string
    {
        return $this->status->value;
    }

    public function __toString(): string
    {
        return $this->status->value;
    }
}
