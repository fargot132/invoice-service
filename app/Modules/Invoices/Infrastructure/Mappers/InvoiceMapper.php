<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Mappers;

use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Modules\Companies\Infrastructure\Mappers\CompanyMapper;
use App\Modules\Invoices\Domain\Invoice;
use App\Modules\Invoices\Domain\ValueObjects\CreatedAt;
use App\Modules\Invoices\Domain\ValueObjects\Date;
use App\Modules\Invoices\Domain\ValueObjects\DueDate;
use App\Modules\Invoices\Domain\ValueObjects\Id;
use App\Modules\Invoices\Domain\ValueObjects\InvoiceProductLines;
use App\Modules\Invoices\Domain\ValueObjects\Number;
use App\Modules\Invoices\Domain\ValueObjects\Status;
use App\Modules\Invoices\Domain\ValueObjects\UpdatedAt;
use App\Modules\Invoices\Infrastructure\Persistence\Eloquent\Models\InvoiceModel;

class InvoiceMapper
{
    public function __construct(
        private CompanyMapper $companyMapper,
        private InvoiceProductLineMapper $invoiceProductLineMapper
    ) {
    }

    public function toEntity(InvoiceModel $invoiceModel): Invoice
    {
        $invoiceProductLines = [];
        foreach ($invoiceModel->invoiceProductLines as $productLine) {
            $invoiceProductLines[] = $this->invoiceProductLineMapper->toEntity($productLine);
        }

        return new Invoice(
            new Id($invoiceModel->id),
            new Number($invoiceModel->number),
            new Date($invoiceModel->date),
            new DueDate($invoiceModel->due_date),
            $this->companyMapper->toEntity($invoiceModel->company),
            Status::fromString($invoiceModel->status),
            new InvoiceProductLines($invoiceProductLines),
            CreatedAt::fromInterface($invoiceModel->created_at),
            UpdatedAt::fromInterface($invoiceModel->updated_at)
        );
    }

    public function toModel(Invoice $invoice): InvoiceModel
    {
        if ($invoice->id()) {
            $invoiceModel = InvoiceModel::find($invoice->id()->value());
        } else {
            $invoiceModel = new InvoiceModel();
        }

        $invoiceModel->number = (string)$invoice->number();
        $invoiceModel->date = $invoice->date()->value();
        $invoiceModel->due_date = $invoice->dueDate()->value();
        $invoiceModel->company_id = (string)$invoice->company()->id();
        $invoiceModel->status = (string)$invoice->status();

        return $invoiceModel;
    }
}
