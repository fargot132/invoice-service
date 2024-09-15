<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\ValueObjects;

use App\Domain\ValueObjects\ArrayValueObject;
use App\Domain\ValueObjects\MoneyValueObject;
use App\Modules\Invoices\Domain\Entities\InvoiceProductLine;
use InvalidArgumentException;

class InvoiceProductLines extends ArrayValueObject
{
    public function __construct(array $array = [])
    {
        parent::__construct($array);

        foreach ($this as $invoiceProductLine) {
            if (!$invoiceProductLine instanceof InvoiceProductLine) {
                throw new InvalidArgumentException('Invalid type in array. Expected InvoiceProductLine.');
            }
        }
    }

    public function add(InvoiceProductLine $invoiceProductLine): void
    {
        $this->append($invoiceProductLine);
    }

    public function remove(InvoiceProductLine $invoiceProductLine): void
    {
        $index = $this->indexOf($invoiceProductLine);
        if (-1 === $index) {
            throw new InvalidArgumentException('InvoiceProductLine not found in array.');
        }
        $this->offsetUnset($index);
    }

    public function update(InvoiceProductLine $invoiceProductLine): void
    {
        $index = $this->indexOf($invoiceProductLine);
        if (-1 === $index) {
            throw new InvalidArgumentException('InvoiceProductLine not found in array.');
        }
        $this->offsetSet($index, $invoiceProductLine);
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function indexOf(InvoiceProductLine $invoiceProductLine): int
    {
        /** @var InvoiceProductLine $value */
        foreach ($this as $key => $value) {
            if ($value->id()?->equals($invoiceProductLine->id())) {
                return $key;
            }
        }
        return -1;
    }

    public function totalPrice(): MoneyValueObject
    {
        $total = new MoneyValueObject(0);
        /** @var InvoiceProductLine $invoiceProductLine */
        foreach ($this as $invoiceProductLine) {
            $total = $total->add($invoiceProductLine->total());
        }
        return $total;
    }
}
