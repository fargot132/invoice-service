<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Queries;

readonly class FindInvoiceByIdQuery
{
    public function __construct(public string $invoiceId)
    {
    }
}
