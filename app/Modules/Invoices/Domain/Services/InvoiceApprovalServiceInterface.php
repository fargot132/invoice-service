<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Services;

use App\Modules\Invoices\Domain\Invoice;

interface InvoiceApprovalServiceInterface
{
    public function approveInvoice(Invoice $invoice): void;
    public function rejectInvoice(Invoice $invoice): void;
}
