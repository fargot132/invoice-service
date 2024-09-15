<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Invoices\Domain\Invoice;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepositoryInterface;
use App\Modules\Invoices\Infrastructure\Exceptions\InvoiceNotFoundException;
use App\Modules\Invoices\Infrastructure\Mappers\InvoiceMapper;
use App\Modules\Invoices\Infrastructure\Persistence\Eloquent\Models\InvoiceModel;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function __construct(private InvoiceMapper $invoiceMapper)
    {
    }

    public function findById(string $id): Invoice
    {
        $invoiceModel = InvoiceModel::find($id);
        if (null === $invoiceModel) {
            throw new InvoiceNotFoundException();
        }
        return $this->invoiceMapper->toEntity($invoiceModel);
    }

    public function save(Invoice $invoice): void
    {
        $invoiceModel = $this->invoiceMapper->toModel($invoice);
        $invoiceModel->save();
    }
}
