<?php

namespace App\PolicyService\PolicyCalculator;

use App\Entity\Invoice;
use App\PolicyService\BasePolicyRateStrategy;
use App\PolicyService\PolicyCalculatorInterface;

class BasePolicyCalculator implements PolicyCalculatorInterface
{

    protected BasePolicyRateStrategy $basePolicyRateStrategy;

    /**
     * BasePolicyCalculator constructor.
     * @param BasePolicyRateStrategy $basePolicyRateStrategy
     */
    public function __construct(BasePolicyRateStrategy $basePolicyRateStrategy)
    {
        $this->basePolicyRateStrategy = $basePolicyRateStrategy;
    }

    public function calculate(Invoice $invoice): void
    {
        $policyRate = $this->basePolicyRateStrategy->compute(time());
        $invoice->setBasePrice($invoice->getCommodityValue() * $policyRate / 100);
    }
}
