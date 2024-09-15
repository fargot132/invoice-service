<?php

declare(strict_types=1);

namespace App\Modules\Companies\Domain\Repositories;

use App\Modules\Companies\Domain\Company;

interface CompanyRepositoryInterface
{
    public function findById(string $id): Company;
}
