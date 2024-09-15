<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Entities;

use App\Domain\Entity;
use App\Domain\ValueObjects\MoneyValueObject;
use App\Modules\Invoices\Domain\ValueObjects\CreatedAt;
use App\Modules\Invoices\Domain\ValueObjects\Id;
use App\Modules\Invoices\Domain\ValueObjects\Quantity;
use App\Modules\Invoices\Domain\ValueObjects\UpdatedAt;
use App\Modules\Products\Domain\Product;

class InvoiceProductLine extends Entity
{
    public function __construct(
        private ?Id $id,
        private Product $product,
        private Quantity $quantity,
        private CreatedAt $createdAt,
        private UpdatedAt $updatedAt
    ) {
    }

    public function id(): ?Id
    {
        return $this->id;
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function quantity(): Quantity
    {
        return $this->quantity;
    }

    public function createdAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): UpdatedAt
    {
        return $this->updatedAt;
    }

    public function total(): MoneyValueObject
    {
        return $this->product->price()->multiply($this->quantity->value());
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'product' => $this->product,
            'quantity' => $this->quantity,
            'total' => $this->total(),
            'currency' => $this->product->currency(),
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
