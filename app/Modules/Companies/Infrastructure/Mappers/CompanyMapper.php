<?php

declare(strict_types=1);

namespace App\Modules\Companies\Infrastructure\Mappers;

use App\Modules\Companies\Domain\Company;
use App\Modules\Companies\Domain\ValueObjects\City;
use App\Modules\Companies\Domain\ValueObjects\CreatedAt;
use App\Modules\Companies\Domain\ValueObjects\Email;
use App\Modules\Companies\Domain\ValueObjects\Id;
use App\Modules\Companies\Domain\ValueObjects\Name;
use App\Modules\Companies\Domain\ValueObjects\Phone;
use App\Modules\Companies\Domain\ValueObjects\Street;
use App\Modules\Companies\Domain\ValueObjects\UpdatedAt;
use App\Modules\Companies\Domain\ValueObjects\Zip;
use App\Modules\Companies\Infrastructure\Persistence\Eloquent\Models\CompanyModel;

class CompanyMapper
{
    public function toEntity(CompanyModel $companyModel): Company
    {
        return new Company(
            new Id($companyModel->id),
            new Name($companyModel->name),
            new Street($companyModel->street),
            new City($companyModel->city),
            new Zip($companyModel->zip),
            new Phone($companyModel->phone),
            new Email($companyModel->email),
            CreatedAt::fromInterface($companyModel->created_at),
            UpdatedAt::fromInterface($companyModel->updated_at)
        );
    }

    public function toModel(Company $company): CompanyModel
    {
        if ($company->id()) {
            $companyModel = CompanyModel::find($company->id()->value());
        } else {
            $companyModel = new CompanyModel();
        }
        $companyModel->name = $company->name()->value();
        $companyModel->street = $company->street()->value();
        $companyModel->city = $company->city()->value();
        $companyModel->zip = $company->zip()->value();
        $companyModel->phone = $company->phone()->value();
        $companyModel->email = $company->email()->value();

        return $companyModel;
    }
}
