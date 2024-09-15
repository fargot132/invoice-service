<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Invoices;


use App\Modules\Invoices\Infrastructure\Persistence\Eloquent\Models\InvoiceModel;
use App\Modules\Invoices\Infrastructure\Persistence\Eloquent\Models\InvoiceProductLineModel;
use Tests\FeatureTestCase;

class InvoiceHttpTest extends FeatureTestCase
{
    public function testShowOk(): void
    {
        $dateTimeFormat = 'Y-m-d H:i:s';

        $invoice = $this->getInvoice(2);
        $response = $this->get('/api/invoices/' . $invoice->id);

        $response
            ->assertStatus(200)
            ->assertJson([
                'id' => $invoice->id,
                'number' => $invoice->number,
                'date' => $invoice->date,
                'dueDate' => $invoice->due_date,
                'company' => [
                    'id' => $invoice->company->id,
                    'name' => $invoice->company->name,
                    'street' => $invoice->company->street,
                    'city' => $invoice->company->city,
                    'zip' => $invoice->company->zip,
                    'phone' => $invoice->company->phone,
                    'email' => $invoice->company->email,
                    'created_at' => $invoice->company->created_at->format($dateTimeFormat),
                    'updated_at' => $invoice->company->updated_at->format($dateTimeFormat),
                ],
                'status' => $invoice->status,
                'invoiceProductLines' => [
                    [
                        'id' => $invoice->invoiceProductLines[0]->id,
                        'product' => [
                            'id' => $invoice->invoiceProductLines[0]->product->id,
                            'name' => $invoice->invoiceProductLines[0]->product->name,
                            'price' => $invoice->invoiceProductLines[0]->product->price / 100,
                            'currency' => $invoice->invoiceProductLines[0]->product->currency,
                            'createdAt' => $invoice->invoiceProductLines[0]->product->created_at->format($dateTimeFormat),
                            'updatedAt' => $invoice->invoiceProductLines[0]->product->updated_at->format($dateTimeFormat),
                        ],
                        'quantity' => $invoice->invoiceProductLines[0]->quantity,
                        'total' => $this->getInvoiceProductLineTotal($invoice->invoiceProductLines[0]),
                        'currency' => $invoice->invoiceProductLines[0]->product->currency,
                        'createdAt' => $invoice->invoiceProductLines[0]->created_at->format($dateTimeFormat),
                        'updatedAt' => $invoice->invoiceProductLines[0]->updated_at->format($dateTimeFormat),
                    ],
                ],
                'totalPrice' => $this->getInvoiceTotalPrice($invoice),
                'createdAt' => $invoice->created_at->format($dateTimeFormat),
                'updatedAt' => $invoice->updated_at->format($dateTimeFormat),
            ])
        ;

    }

    public function testShowNotFound(): void
    {
        $response = $this->get('/api/invoices/1');

        $response->assertStatus(404);
    }

    public function testApproveOk(): void
    {
        $invoice = $this->getInvoiceWithStatus('draft');
        $response = $this->patch('/api/invoices/' . $invoice->id . '/approve');

        $response->assertStatus(200);
    }

    public function testApproveNotFound(): void
    {
        $response = $this->patch('/api/invoices/1/approve');

        $response->assertStatus(404);
    }

    public function testApproveBadRequest(): void
    {
        $invoice = $this->getInvoiceWithStatus('approved');
        $response = $this->patch('/api/invoices/' . $invoice->id . '/approve');

        $response->assertStatus(400);

        $invoice = $this->getInvoiceWithStatus('rejected');
        $response = $this->patch('/api/invoices/' . $invoice->id . '/approve');

        $response->assertStatus(400);
    }

    public function testRejectOk(): void
    {
        $invoice = $this->getInvoiceWithStatus('draft');
        $response = $this->patch('/api/invoices/' . $invoice->id . '/reject');

        $response->assertStatus(200);
    }

    public function testRejectNotFound(): void
    {
        $response = $this->patch('/api/invoices/1/reject');

        $response->assertStatus(404);
    }

    public function testRejectBadRequest(): void
    {
        $invoice = $this->getInvoiceWithStatus('approved');
        $response = $this->patch('/api/invoices/' . $invoice->id . '/reject');

        $response->assertStatus(400);

        $invoice = $this->getInvoiceWithStatus('rejected');
        $response = $this->patch('/api/invoices/' . $invoice->id . '/reject');

        $response->assertStatus(400);
    }

    private function getInvoice(int $index): InvoiceModel
    {
        return InvoiceModel::all()->get($index);
    }

    private function getInvoiceTotalPrice(InvoiceModel $invoice): float
    {
        $totalPrice = 0;
        foreach ($invoice->invoiceProductLines as $productLine) {
            $totalPrice += $productLine->quantity * $productLine->product->price;
        }
        return $totalPrice/100;
    }

    private function getInvoiceProductLineTotal(InvoiceProductLineModel $productLine): float
    {
        return $productLine->quantity * $productLine->product->price / 100;
    }

    private function getInvoiceWithStatus(string $status): InvoiceModel
    {
        return InvoiceModel::where('status', $status)->first();
    }

}
