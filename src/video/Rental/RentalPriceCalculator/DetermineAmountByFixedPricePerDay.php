<?php

namespace VideoStoreKata\video\Rental\RentalPriceCalculator;

use Exception;

/**
 * Class DetermineAmountByFixedPricePerDay.
 */
class DetermineAmountByFixedPricePerDay implements RentalPriceCalculatorInterface
{
    /** @var float */
    private $amountPerDay;

    /**
     * @param float $amountPerDay
     */
    private function __construct(float $amountPerDay)
    {
        $this->amountPerDay = $amountPerDay;
    }

    /**
     * @param float $amountPerDay
     *
     * @return DetermineAmountByFixedPricePerDay
     */
    public static function instance(float $amountPerDay): DetermineAmountByFixedPricePerDay
    {
        return new static($amountPerDay);
    }

    /**
     * @param int $days
     *
     * @return float
     *
     * @throws Exception
     */
    public function determineRentalAmount(int $days): float
    {
        if ($days <= 0) {
            throw new Exception('Days & Amount per day must be added');
        }

        return $days * $this->amountPerDay;
    }
}
