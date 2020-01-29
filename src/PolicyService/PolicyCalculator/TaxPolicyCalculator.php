<?php

namespace App\PolicyService\PolicyCalculator;

use App\Entity\Invoice;
use App\PolicyService\PolicyCalculatorInterface;

class TaxPolicyCalculator implements PolicyCalculatorInterface
{

    public function calculate(Invoice $invoice): void
    {
        $invoice->setTax($invoice->getBasePrice() * $invoice->getTaxRate() / 100);
    }
}
