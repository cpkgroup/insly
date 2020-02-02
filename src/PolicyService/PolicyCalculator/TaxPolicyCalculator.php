<?php

namespace App\PolicyService\PolicyCalculator;

use App\Entity\Invoice;
use App\PolicyService\PolicyCalculatorInterface;

/**
 * This class calculate tax price of policy.
 *
 * Class TaxPolicyCalculator
 * @package App\PolicyService\PolicyCalculator
 */
class TaxPolicyCalculator implements PolicyCalculatorInterface
{

    public function calculate(Invoice $invoice): void
    {
        $invoice->setTax($invoice->getBasePrice() * $invoice->getTaxRate() / 100);
    }
}
