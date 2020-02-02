<?php

namespace App\PolicyService;

use App\Entity\Installment;
use App\Entity\Invoice;

/**
 * Class InstallmentCalculator
 * @package App\PolicyService
 */
class InstallmentCalculator
{

    /**
     * Calculate the installments of the invoice.
     *
     * @param Invoice $invoice
     * @param int $numberOfInstallments
     * @return Installment[]
     */
    public function calculateInstallments(Invoice $invoice, int $numberOfInstallments)
    {
        $installments = [];

        // if number of installments isn't bigger that 1
        if ($numberOfInstallments <= 1) {
            return $installments;
        }

        $basePriceInstallment = round($invoice->getBasePrice() / $numberOfInstallments, 2);
        $taxInstallment = round($invoice->getTax() / $numberOfInstallments, 2);
        $commissionInstallment = round($invoice->getCommission() / $numberOfInstallments, 2);

        // we loop from 1 to n - 1 installment number.
        for ($i = 0; $i < $numberOfInstallments - 1; $i++) {
            $installments[] = new Installment($basePriceInstallment, $commissionInstallment, $taxInstallment);
        }

        // this the last one installment,
        // it should be cover the rounded value of prices if it's exist.
        $installments[] = new Installment(
            $this->lastInstallmentPrice($invoice->getBasePrice(), $basePriceInstallment, $numberOfInstallments),
            $this->lastInstallmentPrice($invoice->getCommission(), $commissionInstallment, $numberOfInstallments),
            $this->lastInstallmentPrice($invoice->getTax(), $taxInstallment, $numberOfInstallments),
        );

        return $installments;
    }

    /**
     * Calculate the last installment price.
     *
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
