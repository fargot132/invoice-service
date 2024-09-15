<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Exceptions;

use DomainException;

class InvoiceNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Invoice not found');
    }
}
