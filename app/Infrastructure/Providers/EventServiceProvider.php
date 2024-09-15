<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Modules\Companies\Application\Queries\FindCompanyByIdQuery;
use App\Modules\Companies\Application\QueryHandlers\FindCompanyByIdHandler;
use App\Modules\Invoices\Application\CommandHandlers\ApproveInvoiceHandler;
use App\Modules\Invoices\Application\CommandHandlers\RejectInvoiceHandler;
use App\Modules\Invoices\Application\Commands\ApproveInvoiceCommand;
use App\Modules\Invoices\Application\Commands\RejectInvoiceCommand;
use App\Modules\Invoices\Application\Queries\FindInvoiceByIdQuery;
use App\Modules\Invoices\Application\QueryHandlers\FindInvoiceByIdHandler;
use App\Modules\Invoices\Infrastructure\EventHandlers\ApprovalEventSubscriber;
use App\Modules\Products\Application\Queries\FindProductByIdQuery;
use App\Modules\Products\Application\QueryHandlers\FindProductByIdHandler;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ApproveInvoiceCommand::class => [
            ApproveInvoiceHandler::class,
        ],
        RejectInvoiceCommand::class => [
            RejectInvoiceHandler::class,
        ],
        FindInvoiceByIdQuery::class => [
            FindInvoiceByIdHandler::class,
        ],
        FindCompanyByIdQuery::class => [
            FindCompanyByIdHandler::class,
        ],
        FindProductByIdQuery::class => [
            FindProductByIdHandler::class,
        ],
    ];

    protected $subscribe = [
        ApprovalEventSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
