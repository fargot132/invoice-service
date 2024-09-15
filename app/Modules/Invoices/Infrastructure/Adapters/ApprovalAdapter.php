<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Adapters;

use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Modules\Invoices\Domain\Invoice;
use App\Modules\Invoices\Domain\Services\InvoiceApprovalServiceInterface;

class ApprovalAdapter implements InvoiceApprovalServiceInterface
{
    public function __construct(private ApprovalFacadeInterface $approvalFacade)
    {
    }

    public function approveInvoice(Invoice $invoice): void
    {
        $approvalDto = new ApprovalDto($invoice->id()->value(), $invoice->status()->value(), Invoice::class);
        $this->approvalFacade->approve($approvalDto);
    }

    public function rejectInvoice(Invoice $invoice): void
    {
        $approvalDto = new ApprovalDto($invoice->id()->value(), $invoice->status()->value(), Invoice::class);
        $this->approvalFacade->reject($approvalDto);
    }
}
