<?php

declare(strict_types=1);

namespace App\Modules\Products\Infrastructure\Exceptions;

use DomainException;

class ProductNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Product not found');
    }
}
