<?php

namespace App\Entity;

/**
 * Class Installment
 * @package App\Entity
 */
class Installment extends BaseInvoice
{
    /**
     * Installment constructor.
     * @param float $basePrice
     * @param float $commission
     * @param float $tax
     */
    public function __construct(float $basePrice, float $commission, float $tax)
    {
        $this->basePrice = $basePrice;
        $this->commission = $commission;
        $this->tax = $tax;
    }
}
