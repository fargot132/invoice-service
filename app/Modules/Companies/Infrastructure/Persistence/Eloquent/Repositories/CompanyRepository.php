<?php

declare(strict_types=1);

namespace App\Modules\Companies\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Companies\Domain\Company;
use App\Modules\Companies\Domain\Repositories\CompanyRepositoryInterface;
use App\Modules\Companies\Infrastructure\Exceptions\CompanyNotFoundException;
use App\Modules\Companies\Infrastructure\Mappers\CompanyMapper;
use App\Modules\Companies\Infrastructure\Persistence\Eloquent\Models\CompanyModel;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function __construct(private CompanyMapper $companyMapper)
    {
    }
    public function findById(string $id): Company
    {
        $companyModel = CompanyModel::find($id);
        if (null === $companyModel) {
            throw new CompanyNotFoundException();
        }
        return $this->companyMapper->toEntity($companyModel);
    }
}
