<?php

declare(strict_types=1);

namespace App\Modules\Products\Application\QueryHandlers;

use App\Modules\Products\Application\Queries\FindProductByIdQuery;
use App\Modules\Products\Domain\Product;
use App\Modules\Products\Domain\Repositories\ProductRepositoryInterface;

class FindProductByIdHandler
{
    public function __construct(private ProductRepositoryInterface $productRepository)
    {
    }
    public function handle(FindProductByIdQuery $query): Product
    {
        return $this->productRepository->findById($query->productId);
    }
}
