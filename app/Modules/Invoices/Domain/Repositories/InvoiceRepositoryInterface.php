<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Repositories;

use App\Modules\Invoices\Domain\Invoice;
use App\Modules\Invoices\Infrastructure\Exceptions\InvoiceNotFoundException;

interface InvoiceRepositoryInterface
{
    /**
     * @throws InvoiceNotFoundException
     */
    public function findById(string $id): Invoice;
    public function save(Invoice $invoice): void;
}
