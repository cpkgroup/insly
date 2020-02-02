<?php

namespace App\Entity;

/**
 * This class created for using in Invoice and Installment.
 *
 * Class BaseInvoice
 * @package App\Entity
 */
abstract class BaseInvoice
{
    protected float $basePrice;

    protected float $commission;

    protected float $tax;

    /**
     * @return float
     */
    public function getBasePrice(): float
    {
        return $this->basePrice;
    }

    /**
     * @param float $basePrice
     */
    public function setBasePrice(float $basePrice): void
    {
        $this->basePrice = $basePrice;
    }

    /**
     * @return float
     */
    public function getCommission(): float
    {
        return $this->commission;
    }

    /**
     * @param float $commission
     */
    public function setCommission(float $commission): void
    {
        $this->commission = $commission;
    }

    /**
     * @return float
     */
    public function getTax(): float
    {
        return $this->tax;
    }

    /**
     * @param float $tax
     */
    public function setTax(float $tax): void
    {
        $this->tax = $tax;
    }

    /**
     * Calculate sum of the invoice.
     *
     * @return float
     */
    public function getTotal(): float
    {
        return $this->basePrice + $this->commission + $this->tax;
    }
}
