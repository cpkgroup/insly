<?php

namespace App\PolicyService\PolicyCalculator;

use App\Entity\Invoice;
use App\PolicyService\PolicyCalculatorInterface;

class CommissionPolicyCalculator implements PolicyCalculatorInterface
{

    public function calculate(Invoice $invoice): void
    {
        $invoice->setCommission($invoice->getBasePrice() * getenv('COMMISSION_RATE') / 100);
    }
}
