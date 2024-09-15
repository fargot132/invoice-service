<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Commands;

readonly class ApproveInvoiceCommand
{
    public function __construct(
        public string $invoiceId,
    ) {
    }
}
