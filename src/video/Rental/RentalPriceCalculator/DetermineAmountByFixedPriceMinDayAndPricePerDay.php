<?php

namespace video\Rental\RentalPriceCalculator;

/**
 * Class DetermineAmountByFixedPriceMinDayAndPricePerDay
 */
class DetermineAmountByFixedPriceMinDayAndPricePerDay implements RentalPriceCalculator
{
    /** @var  float */
    private $fixedPrice;
    /** @var  int */
    private $minDay;
    /** @var  float */
    private $pricePerDay;

    /**
     * @param float $fixedPrice
     * @param int $minDay
     * @param float $pricePerDay
     */
    public function __construct(float $fixedPrice, int $minDay, float $pricePerDay)
    {
        $this->fixedPrice = $fixedPrice;
        $this->minDay = $minDay;
        $this->pricePerDay = $pricePerDay;
    }


    public function determineRentalAmount(int $days): float
    {
        $thisAmount = $this->fixedPrice;

        if ($days > $this->minDay) {
            $thisAmount += ($days - $this->minDay) * $this->pricePerDay;
        }

        return $thisAmount;
    }
}