<?php

declare(strict_types=1);

namespace App\Modules\Companies\Application\QueryHandlers;

use App\Modules\Companies\Application\Queries\FindCompanyByIdQuery;
use App\Modules\Companies\Domain\Company;
use App\Modules\Companies\Domain\Repositories\CompanyRepositoryInterface;

class FindCompanyByIdHandler
{
    public function __construct(private CompanyRepositoryInterface $companyRepository)
    {
    }

    public function handle(FindCompanyByIdQuery $query): Company
    {
        return $this->companyRepository->findById($query->companyId);
    }
}
