<?php

declare(strict_types=1);

namespace App\Modules\Products\Infrastructure\Providers;

use App\Modules\Products\Domain\Repositories\ProductRepositoryInterface;
use App\Modules\Products\Infrastructure\Persistence\Eloquent\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
    }
}
