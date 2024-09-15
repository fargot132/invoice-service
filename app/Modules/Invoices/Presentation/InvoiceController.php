<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Presentation;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Application\Commands\ApproveInvoiceCommand;
use App\Modules\Invoices\Application\Commands\RejectInvoiceCommand;
use App\Modules\Invoices\Application\Queries\FindInvoiceByIdQuery;
use App\Modules\Invoices\Infrastructure\Exceptions\InvoiceNotFoundException;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\JsonResponse;
use LogicException;

class InvoiceController extends Controller
{
    public function __construct(
        private Dispatcher $dispatcher
    ) {
    }

    public function show(string $id): JsonResponse
    {
        try {
            $invoice = $this->dispatcher->until(new FindInvoiceByIdQuery($id));

            return response()->json($invoice);
        } catch (InvoiceNotFoundException $e) {
            return response()->json(['error' => 'Invoice not found for id: ' . $id], 404);
        }
    }

    public function approve(string $id): JsonResponse
    {
        try {
            $this->dispatcher->dispatch(new ApproveInvoiceCommand($id));

            return response()->json(['message' => 'Invoice approved']);
        } catch (InvoiceNotFoundException $e) {
            return response()->json(['error' => 'Invoice not found for id: ' . $id], 404);
        } catch (LogicException $e) {
            return response()->json(['error' => 'Invoice could not be approved'], 400);
        }
    }

    public function reject(string $id): JsonResponse
    {
        try {
            $this->dispatcher->dispatch(new RejectInvoiceCommand($id));

            return response()->json(['message' => 'Invoice rejected']);
        } catch (InvoiceNotFoundException $e) {
            return response()->json(['error' => 'Invoice not found for id: ' . $id], 404);
        } catch (LogicException $e) {
            return response()->json(['error' => 'Invoice could not be rejected'], 400);
        }
    }
}
