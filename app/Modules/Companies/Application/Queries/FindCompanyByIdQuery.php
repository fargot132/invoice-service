<?php

declare(strict_types=1);

namespace App\Modules\Companies\Application\Queries;

readonly class FindCompanyByIdQuery
{
    public function __construct(public string $companyId)
    {
    }

}
