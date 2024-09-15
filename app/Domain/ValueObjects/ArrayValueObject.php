<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use ArrayIterator;
use JsonSerializable;

abstract class ArrayValueObject extends ArrayIterator implements JsonSerializable
{
    /**
     * @return array<mixed>
     */
    abstract public function jsonSerialize(): array;
}
