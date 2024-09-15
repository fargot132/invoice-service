<?php

declare(strict_types=1);

namespace App\Modules\Products\Application\Queries;

use App\Modules\Products\Domain\Product;
use App\Modules\Products\Domain\Repositories\ProductRepositoryInterface;

readonly class FindProductByIdQuery
{
    public function __construct(public string $productId)
    {
    }
}
