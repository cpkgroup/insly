<?php

namespace App\Controller;

use App\PolicyService\PolicyCalculator\BasePolicyCalculator;
use App\PolicyService\BasePolicyRateStrategy;
use App\PolicyService\PolicyCalculatorInterface;
use App\PolicyService\PolicyCalculator\CommissionPolicyCalculator;
use App\PolicyService\PolicyCalculator\TaxPolicyCalculator;
use App\PolicyService\InstallmentCalculator;
use App\Entity\Invoice;
use App\PolicyService\PolicyDecorator;

/**
 * This is the main class for getting calculated data as json.
 *
 * Class PolicyController
 * @package App\Controller
 */
class PolicyController
{

    /**
     * @var PolicyCalculatorInterface[]
     */
    protected array $policyCalculators;

    /**
     * @var InstallmentCalculator
     */
    protected InstallmentCalculator $installment;

    /**
     * @var PolicyDecorator
     */
    private PolicyDecorator $policyDecorator;

    /**
     * PolicyApp constructor.
     */
    public function __construct()
    {
        $this->policyCalculators = [
            new BasePolicyCalculator(new BasePolicyRateStrategy()),
            new CommissionPolicyCalculator(),
            new TaxPolicyCalculator(),
        ];

        $this->installment = new InstallmentCalculator();
        $this->policyDecorator = new PolicyDecorator();
    }

    /**
     * @param float $carValue
     * @param float $tax
     * @param int $numberOfInstallments
     *
     * @return array
     */
    public function calculateAction(float $carValue, float $tax, int $numberOfInstallments)
    {
        $invoice = new Invoice($carValue, $tax);
        foreach ($this->policyCalculators as $policyCalculator) {
            $policyCalculator->calculate($invoice);
        }
        $installments = $this->installment->calculateInstallments($invoice, $numberOfInstallments);

        return $this->policyDecorator->rawArray($invoice, $installments);
    }
}
