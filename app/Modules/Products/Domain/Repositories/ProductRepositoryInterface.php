<?php

declare(strict_types=1);

namespace App\Modules\Products\Domain\Repositories;

use App\Modules\Products\Domain\Product;

interface ProductRepositoryInterface
{
    public function findById(string $id): Product;
}
