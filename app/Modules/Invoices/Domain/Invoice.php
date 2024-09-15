<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain;

use App\Domain\AggregateRoot;
use App\Domain\Enums\StatusEnum;
use App\Modules\Companies\Domain\Company;
use App\Modules\Invoices\Domain\ValueObjects\CreatedAt;
use App\Modules\Invoices\Domain\ValueObjects\Date;
use App\Modules\Invoices\Domain\ValueObjects\DueDate;
use App\Modules\Invoices\Domain\ValueObjects\Id;
use App\Modules\Invoices\Domain\ValueObjects\InvoiceProductLines;
use App\Modules\Invoices\Domain\ValueObjects\Number;
use App\Modules\Invoices\Domain\ValueObjects\Status;
use App\Modules\Invoices\Domain\ValueObjects\UpdatedAt;

final class Invoice extends AggregateRoot
{
    public function __construct(
        private Id $id,
        private Number $number,
        private Date $date,
        private DueDate $dueDate,
        private Company $company,
        private Status $status,
        private InvoiceProductLines $invoiceProductLines,
        private ?CreatedAt $createdAt,
        private ?UpdatedAt $updatedAt
    ) {
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function number(): Number
    {
        return $this->number;
    }

    public function date(): Date
    {
        return $this->date;
    }

    public function dueDate(): DueDate
    {
        return $this->dueDate;
    }

    public function company(): Company
    {
        return $this->company;
    }

    public function status(): Status
    {
        return $this->status;
    }

    public function invoiceProductLines(): InvoiceProductLines
    {
        return $this->invoiceProductLines;
    }

    public function createdAt(): ?CreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?UpdatedAt
    {
        return $this->updatedAt;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'date' => $this->date,
            'dueDate' => $this->dueDate,
            'company' => $this->company,
            'status' => $this->status,
            'invoiceProductLines' => $this->invoiceProductLines,
            'totalPrice' => $this->invoiceProductLines->totalPrice(),
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }

    public function approve(): void
    {
        $this->status = new Status(StatusEnum::APPROVED);
    }

    public function reject(): void
    {
        $this->status = new Status(StatusEnum::REJECTED);
    }
}
