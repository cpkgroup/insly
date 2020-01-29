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
        $result = [];
        $result['invoice'] = [
            'commodityValue' => $invoice->getCommodityValue(),
            'basePrice' => $invoice->getBasePrice(),
            'commission' => $invoice->getCommission(),
            'tax' => $invoice->getTax(),
            'total' => $invoice->getTotal(),
        ];
        foreach ($installments as $installment) {
            $result['installments'][] = [
                'basePrice' => $installment->getBasePrice(),
                'commission' => $installment->getCommission(),
                'tax' => $installment->getTax(),
                'total' => $installment->getTotal(),
            ];
        }

        return $result;
    }
}