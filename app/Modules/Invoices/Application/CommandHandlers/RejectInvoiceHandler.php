<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\CommandHandlers;

use App\Modules\Invoices\Application\Commands\RejectInvoiceCommand;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepositoryInterface;
use App\Modules\Invoices\Domain\Services\InvoiceApprovalServiceInterface;
use App\Modules\Invoices\Infrastructure\Exceptions\InvoiceNotFoundException;
use LogicException;

class RejectInvoiceHandler
{
    public function __construct(
        private InvoiceApprovalServiceInterface $invoiceApprovalService,
        private InvoiceRepositoryInterface $invoiceRepository,
    ) {
    }

    /**
     * @throws InvoiceNotFoundException
     * @throws LogicException
     */
    public function handle(RejectInvoiceCommand $command): void
    {
        $invoice = $this->invoiceRepository->findById($command->invoiceId);
        $this->invoiceApprovalService->rejectInvoice($invoice);
    }
}
