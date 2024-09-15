<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Persistence\Eloquent\Models;

use App\Modules\Products\Infrastructure\Persistence\Eloquent\Models\ProductModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceProductLineModel extends Model
{
    use HasUuids;

    public array $rules = [
        'invoice_id' => 'required|exists:invoices,id',
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer',
    ];

    protected $table = 'invoice_product_lines';

    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(InvoiceModel::class);
    }

    public function product(): BelongsTo
    {
        return $this->BelongsTo(ProductModel::class);
    }
}
