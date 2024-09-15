<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use DomainException;

final class IncorrectEmailFormatException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Incorrect email format');
    }
}
