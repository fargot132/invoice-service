<?php

declare(strict_types=1);

namespace App\Modules\Products\Infrastructure\Mappers;

use App\Modules\Products\Domain\Product;
use App\Modules\Products\Domain\ValueObjects\CreatedAt;
use App\Modules\Products\Domain\ValueObjects\Currency;
use App\Modules\Products\Domain\ValueObjects\Id;
use App\Modules\Products\Domain\ValueObjects\Name;
use App\Modules\Products\Domain\ValueObjects\Price;
use App\Modules\Products\Domain\ValueObjects\UpdatedAt;
use App\Modules\Products\Infrastructure\Persistence\Eloquent\Models\ProductModel;

class ProductMapper
{
    public function toEntity(ProductModel $model): Product
    {
        return new Product(
            new Id($model->id),
            new Name($model->name),
            new Price($model->price),
            Currency::fromString($model->currency),
            CreatedAt::fromInterface($model->created_at),
            UpdatedAt::fromInterface($model->updated_at)
        );
    }
}
