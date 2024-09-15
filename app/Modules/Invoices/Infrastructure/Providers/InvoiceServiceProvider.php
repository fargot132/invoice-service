<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Providers;

use App\Modules\Invoices\Domain\Repositories\InvoiceRepositoryInterface;
use App\Modules\Invoices\Domain\Services\InvoiceApprovalServiceInterface;
use App\Modules\Invoices\Infrastructure\Adapters\ApprovalAdapter;
use App\Modules\Invoices\Infrastructure\Persistence\Eloquent\Repositories\InvoiceRepository;
use Illuminate\Support\ServiceProvider;

class InvoiceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            InvoiceRepositoryInterface::class,
            InvoiceRepository::class
        );
        $this->app->bind(
            InvoiceApprovalServiceInterface::class,
            ApprovalAdapter::class
        );
    }
}
