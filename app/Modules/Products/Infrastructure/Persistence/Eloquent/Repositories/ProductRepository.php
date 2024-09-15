<?php

declare(strict_types=1);

namespace App\Modules\Products\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Products\Domain\Product;
use App\Modules\Products\Domain\Repositories\ProductRepositoryInterface;
use App\Modules\Products\Infrastructure\Exceptions\ProductNotFoundException;
use App\Modules\Products\Infrastructure\Mappers\ProductMapper;
use App\Modules\Products\Infrastructure\Persistence\Eloquent\Models\ProductModel;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(private ProductMapper $productMapper)
    {
    }

    /**
     * @throws ProductNotFoundException
     */
    public function findById(string $id): Product
    {
        $productModel = ProductModel::find($id);
        if (null === $productModel) {
            throw new ProductNotFoundException();
        }
        return $this->productMapper->toEntity($productModel);
    }
}
