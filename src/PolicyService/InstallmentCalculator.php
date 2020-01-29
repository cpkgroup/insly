<?php

namespace App\PolicyService;

use App\Entity\Installment;
use App\Entity\Invoice;

class InstallmentCalculator
{

    /**
     * @param Invoice $invoice
     * @param int $numberOfInstallments
     * @return Installment[]
     */
    public function calculateInstallments(Invoice $invoice, int $numberOfInstallments)
    {
        $installments = [];

        $basePriceInstallment = round($invoice->getBasePrice() / $numberOfInstallments, 2);
        $taxInstallment = round($invoice->getTax() / $numberOfInstallments, 2);
        $commissionInstallment = round($invoice->getCommission() / $numberOfInstallments, 2);

        for ($i = 0; $i < $numberOfInstallments - 1; $i++) {
            $installments[] = new Installment($basePriceInstallment, $commissionInstallment, $taxInstallment);
        }

        $installments[] = new Installment(
            $this->lastInstallmentPrice($invoice->getBasePrice(), $basePriceInstallment, $numberOfInstallments),
            $this->lastInstallmentPrice($invoice->getCommission(), $commissionInstallment, $numberOfInstallments),
            $this->lastInstallmentPrice($invoice->getTax(), $taxInstallment, $numberOfInstallments),
        );

        return $installments;
    }

    /**
     * @param $price
     * @param $installment
     * @param $number
     * @return float|int
     */
    protected function lastInstallmentPrice($price, $installment, $number)
    {
        return $price - $installment * ($number - 1);
    }
}
