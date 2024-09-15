<?php

declare(strict_types=1);

namespace App\Modules\Companies\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    use HasUuids;

    public array $rules = [
        'name' => 'required|string',
        'street' => 'required|string',
        'city' => 'required|string',
        'zip' => 'required|string',
        'phone' => 'required|string',
        'email' => 'required|email',
    ];

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'street',
        'city',
        'zip',
        'phone',
        'email',
    ];
}
