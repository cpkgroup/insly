<?php

namespace App\PolicyService;

use App\Entity\Invoice;

interface PolicyCalculatorInterface
{
    /**
     * This method will calculate the policy and update the invoice object.
     *
     * @param Invoice $invoice
     * @return mixed
     */
    public function calculate(Invoice $invoice): void;
}
