<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Mappers;

use App\Modules\Invoices\Domain\Entities\InvoiceProductLine;
use App\Modules\Invoices\Domain\ValueObjects\CreatedAt;
use App\Modules\Invoices\Domain\ValueObjects\Id;
use App\Modules\Invoices\Domain\ValueObjects\Quantity;
use App\Modules\Invoices\Domain\ValueObjects\UpdatedAt;
use App\Modules\Invoices\Infrastructure\Persistence\Eloquent\Models\InvoiceProductLineModel;
use App\Modules\Products\Infrastructure\Mappers\ProductMapper;

class InvoiceProductLineMapper
{
    public function __construct(private ProductMapper $productMapper)
    {
    }

    public function toEntity(InvoiceProductLineModel $model): InvoiceProductLine
    {
        return new InvoiceProductLine(
            new Id($model->id),
            $this->productMapper->toEntity($model->product),
            new Quantity($model->quantity),
            CreatedAt::fromInterface($model->created_at),
            UpdatedAt::fromInterface($model->updated_at)
        );
    }
}
