<?php

namespace App\PolicyService;

class BasePolicyRateStrategy
{

    /**
     * @param int $timestamp
     * @return int
     */
    public function compute(int $timestamp)
    {
        switch (date('w', $timestamp)) {
            // on Fridays
            case 5:
                $hour = date('H', $timestamp);
                if ($hour >= 15 && $hour < 20) {
                    return 13;
                }
        }
        return getenv('BASE_POLICY_RATE');
    }
}
