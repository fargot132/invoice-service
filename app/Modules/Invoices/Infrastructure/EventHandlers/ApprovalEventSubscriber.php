<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\EventHandlers;

use App\Modules\Approval\Api\Events\EntityApproved;
use App\Modules\Approval\Api\Events\EntityRejected;
use App\Modules\Invoices\Domain\Invoice;
use App\Modules\Invoices\Domain\Services\InvoiceStatusService;
use Illuminate\Events\Dispatcher;

class ApprovalEventSubscriber
{
    public function __construct(private InvoiceStatusService $invoiceStatusService)
    {
    }

    public function handleInvoiceApproved(EntityApproved $event): void
    {
        $approvalDto = $event->approvalDto;
        if ($approvalDto->entity !== Invoice::class) {
            return;
        }
        $this->invoiceStatusService->markAsApproved($approvalDto->id->toString());
    }

    public function handleInvoiceRejected(EntityRejected $event): void
    {
        $approvalDto = $event->approvalDto;
        if ($approvalDto->entity !== Invoice::class) {
            return;
        }
        $this->invoiceStatusService->markAsRejected($approvalDto->id->toString());
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            EntityApproved::class => 'handleInvoiceApproved',
            EntityRejected::class => 'handleInvoiceRejected',
        ];
    }
}
