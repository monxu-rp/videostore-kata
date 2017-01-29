<?php

namespace video\Rental\RentalPriceCalculator;

use Symfony\Component\Config\Definition\Exception\Exception;

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
        if ($days<=0 || !isset($this->amountPerDay)) {
            throw new Exception("Days & Amount per day must be added");
        }

        return $days * $this->amountPerDay;
    }
}
