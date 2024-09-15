<?php

declare(strict_types=1);

namespace App\Modules\Companies\Domain;

use App\Domain\AggregateRoot;
use App\Modules\Companies\Domain\ValueObjects\City;
use App\Modules\Companies\Domain\ValueObjects\CreatedAt;
use App\Modules\Companies\Domain\ValueObjects\Email;
use App\Modules\Companies\Domain\ValueObjects\Id;
use App\Modules\Companies\Domain\ValueObjects\Name;
use App\Modules\Companies\Domain\ValueObjects\Phone;
use App\Modules\Companies\Domain\ValueObjects\Street;
use App\Modules\Companies\Domain\ValueObjects\UpdatedAt;
use App\Modules\Companies\Domain\ValueObjects\Zip;

class Company extends AggregateRoot
{
    public function __construct(
        private ?Id $id,
        private Name $name,
        private Street $street,
        private City $city,
        private Zip $zip,
        private Phone $phone,
        private Email $email,
        private ?CreatedAt $createdAt,
        private ?UpdatedAt $updatedAt
    ) {
    }

    public function id(): ?Id
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function street(): Street
    {
        return $this->street;
    }

    public function city(): City
    {
        return $this->city;
    }

    public function zip(): Zip
    {
        return $this->zip;
    }

    public function phone(): Phone
    {
        return $this->phone;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function createdAt(): ?CreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?UpdatedAt
    {
        return $this->updatedAt;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'street' => $this->street,
            'city' => $this->city,
            'zip' => $this->zip,
            'phone' => $this->phone,
            'email' => $this->email,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
