<?php

namespace App\Entity;

/**
 * Class Invoice
 * @package App\Entity
 */
class Invoice extends BaseInvoice
{
    /**
     * This commodity value in this case we use it as car Value.
     *
     * @var float
     */
    protected float $commodityValue;

    /**
     * @var float
     */
    protected float $taxRate;

    /**
     * Invoice constructor.
     * @param float $commodityValue
     * @param float $taxRate
     */
    public function __construct(float $commodityValue, float $taxRate)
    {
        $this->commodityValue = $commodityValue;
        $this->taxRate = $taxRate;
    }

    /**
     * @return float
     */
    public function getCommodityValue(): float
    {
        return $this->commodityValue;
    }

    /**
     * @param float $commodityValue
     */
    public function setCommodityValue(float $commodityValue): void
    {
        $this->commodityValue = $commodityValue;
    }

    /**
     * @return float
     */
    public function getTaxRate(): float
    {
        return $this->taxRate;
    }

    /**
     * @param float $taxRate
     */
    public function setTaxRate(float $taxRate): void
    {
        $this->taxRate = $taxRate;
    }

    /**
     * Calculate base rate from existing invoice.
     *
     * @return float|int
     */
    public function getBaseRate()
    {
        if (!$this->getCommodityValue()) {
            return 0;
        }
        return (100 * $this->getBasePrice()) / $this->getCommodityValue();
    }

    /**
     * Calculate commission rate from existing invoice.
     *
     * @return float|int
     */
    public function getCommissionRate()
    {
        if (!$this->getBasePrice()) {
            return 0;
        }
        return (100 * $this->getCommission()) / $this->getBasePrice();
    }
}
