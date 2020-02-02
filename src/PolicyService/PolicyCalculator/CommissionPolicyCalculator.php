<?php

namespace App\PolicyService\PolicyCalculator;

use App\Entity\Invoice;
use App\PolicyService\PolicyCalculatorInterface;

/**
 * This class calculate commission price of policy.
 *
 * Class CommissionPolicyCalculator
 * @package App\PolicyService\PolicyCalculator
 */
class CommissionPolicyCalculator implements PolicyCalculatorInterface
{

    public function calculate(Invoice $invoice): void
    {
        $invoice->setCommission($invoice->getBasePrice() * getenv('COMMISSION_RATE') / 100);
    }
}
