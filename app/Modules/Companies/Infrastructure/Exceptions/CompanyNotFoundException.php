<?php

declare(strict_types=1);

namespace App\Modules\Companies\Infrastructure\Exceptions;

use DomainException;

class CompanyNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Company not found');
    }
}
