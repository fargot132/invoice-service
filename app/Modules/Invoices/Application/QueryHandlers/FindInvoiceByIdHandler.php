<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\QueryHandlers;

use App\Modules\Invoices\Application\Queries\FindInvoiceByIdQuery;
use App\Modules\Invoices\Domain\Invoice;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepositoryInterface;

class FindInvoiceByIdHandler
{
    public function __construct(
        private InvoiceRepositoryInterface $invoiceRepository
    ) {
    }

    public function handle(FindInvoiceByIdQuery $query): Invoice
    {
        return $this->invoiceRepository->findById($query->invoiceId);
    }
}
