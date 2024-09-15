<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use App\Domain\Exceptions\IncorrectEmailFormatException;

class EmailValueObject extends StringValueObject
{
    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new IncorrectEmailFormatException();
        }
        parent::__construct($value);
    }
}
