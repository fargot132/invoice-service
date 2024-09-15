<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Services;

use App\Modules\Invoices\Domain\Repositories\InvoiceRepositoryInterface;

class InvoiceStatusService
{
    public function __construct(
        private InvoiceRepositoryInterface $invoiceRepository
    ) {
    }

    public function markAsApproved(string $invoiceId): void
    {
        $invoice = $this->invoiceRepository->findById($invoiceId);
        $invoice->approve();
        $this->invoiceRepository->save($invoice);
    }

    public function markAsRejected(string $invoiceId): void
    {
        $invoice = $this->invoiceRepository->findById($invoiceId);
        $invoice->reject();
        $this->invoiceRepository->save($invoice);
    }
}
