<?php

namespace video\Rental\RentalPriceCalculator;

use Exception;

/**
 * Class DetermineAmountByFixedPricePerDay
 */
class DetermineAmountByFixedPricePerDay implements RentalPriceCalculator
{
    /** @var  float */
    private $amountPerDay;

    /**
     * @param float $amountPerDay
     */
    public function __construct(float $amountPerDay)
    {
        $this->amountPerDay = $amountPerDay;
    }

    public function determineRentalAmount(int $days): float
    {
        if ($days<=0) {
            throw new Exception("Days & Amount per day must be added");
        }

        return $days * $this->amountPerDay;
    }
}
