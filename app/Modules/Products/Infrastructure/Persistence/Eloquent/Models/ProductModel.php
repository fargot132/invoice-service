<?php

declare(strict_types=1);

namespace App\Modules\Products\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasUuids;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'currency',
    ];
}
