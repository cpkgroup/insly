<?php

namespace App\PolicyService;

use App\Entity\Invoice;

/**
 * Interface PolicyCalculatorInterface
 * @package App\PolicyService
 */
interface PolicyCalculatorInterface
{
    /**
     * This method will calculate the policy and update the invoice object
     * All classes which implements this method update the invoice.
     *
     * @param Invoice $invoice
     * @return mixed
     */
    public function calculate(Invoice $invoice): void;
}
