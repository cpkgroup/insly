<?php

namespace App\PolicyService;

use App\Entity\Installment;
use App\Entity\Invoice;

class PolicyDecorator
{
    /**
     * @param Invoice $invoice
     * @param Installment[] $installments
     *
     * @return array
     */
    public function rawArray(Invoice $invoice, array $installments)
    {
        $result = [
            'Value' => $this->formatPrice($invoice->getCommodityValue()),
        ];
        $basePriceKey = 'Base Premium (' . $invoice->getBaseRate() . '%)';
        $commissionKey = 'Commission (' . $invoice->getCommissionRate() . '%)';
        $taxKey = 'Tax (' . $invoice->getTaxRate() . '%)';
        $totalKey = 'Total cost';

        $result['invoices'] = [
            $basePriceKey => $this->formatPrice($invoice->getBasePrice()),
            $commissionKey => $this->formatPrice($invoice->getCommission()),
            $taxKey => $this->formatPrice($invoice->getTax()),
            $totalKey => $this->formatPrice($invoice->getTotal()),
        ];

        if (count($installments) > 1) {
            foreach ($installments as $installment) {
                $result['installments'][] = [
                    $basePriceKey => $this->formatPrice($installment->getBasePrice()),
                    $commissionKey => $this->formatPrice($installment->getCommission()),
                    $taxKey => $this->formatPrice($installment->getTax()),
                    $totalKey => $this->formatPrice($installment->getTotal()),
                ];
            }
        }

        return $result;
    }

    /**
     * @param $price
     * @return string
     */
    public function formatPrice($price)
    {
        return number_format($price, 2, '.', '');
    }
}