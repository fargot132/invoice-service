<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Persistence\Eloquent\Models;

use App\Modules\Companies\Infrastructure\Persistence\Eloquent\Models\CompanyModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvoiceModel extends Model
{
    use HasUuids;

    public array $rules = [
        'number' => 'required|string',
        'date' => 'required|date',
        'due_date' => 'required|date',
        'company_id' => 'required|exists:companies,id',
        'status' => 'required|string',
    ];

    protected $table = 'invoices';

    protected $fillable = [
        'number',
        'date',
        'due_date',
        'company_id',
        'status',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyModel::class);
    }

    public function invoiceProductLines(): HasMany
    {
        return $this->hasMany(InvoiceProductLineModel::class, 'invoice_id');
    }
}
