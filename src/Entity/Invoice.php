<?php

namespace App\Entity;

class Invoice extends BaseInvoice
{
    protected float $commodityValue;

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
