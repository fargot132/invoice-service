<?php

declare(strict_types=1);

namespace App\Modules\Companies\Infrastructure\Providers;

use App\Modules\Companies\Domain\Repositories\CompanyRepositoryInterface;
use App\Modules\Companies\Infrastructure\Persistence\Eloquent\Repositories\CompanyRepository;
use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
        );
    }
}
