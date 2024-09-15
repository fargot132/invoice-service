<?php

declare(strict_types=1);

namespace App\Modules\Products\Domain;

use App\Domain\AggregateRoot;
use App\Modules\Products\Domain\ValueObjects\CreatedAt;
use App\Modules\Products\Domain\ValueObjects\Currency;
use App\Modules\Products\Domain\ValueObjects\Id;
use App\Modules\Products\Domain\ValueObjects\Name;
use App\Modules\Products\Domain\ValueObjects\Price;
use App\Modules\Products\Domain\ValueObjects\UpdatedAt;

class Product extends AggregateRoot
{
    public function __construct(
        private Id $id,
        private Name $name,
        private Price $price,
        private Currency $currency,
        private CreatedAt $createdAt,
        private UpdatedAt $updatedAt
    ) {
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function currency(): Currency
    {
        return $this->currency;
    }

    public function createdAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): UpdatedAt
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
            'name' => $this->name,
            'price' => $this->price,
            'currency' => $this->currency,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
