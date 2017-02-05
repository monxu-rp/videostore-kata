<?php

namespace VideoStoreKata\video\Rental\RentalPriceCalculator;

use Exception;

/**
 * Class DetermineAmountByFixedPriceMinDayAndPricePerDay.
 */
class DetermineAmountByFixedPriceMinDayAndPricePerDay implements RentalPriceCalculatorInterface
{
    /** @var float */
    private $fixedPrice;
    /** @var int */
    private $minDay;
    /** @var float */
    private $pricePerDay;

    /**
     * @param float $fixedPrice
     * @param int   $minDay
     * @param float $pricePerDay
     */
    private function __construct(float $fixedPrice, int $minDay, float $pricePerDay)
    {
        $this->fixedPrice = $fixedPrice;
        $this->minDay = $minDay;
        $this->pricePerDay = $pricePerDay;
    }

    /**
     * @param float $fixedPrice
     * @param int   $minDay
     * @param float $pricePerDay
     *
     * @return DetermineAmountByFixedPriceMinDayAndPricePerDay
     */
    public static function instance(
        float $fixedPrice,
        int $minDay,
        float $pricePerDay
    ):DetermineAmountByFixedPriceMinDayAndPricePerDay {
        return new static($fixedPrice, $minDay, $pricePerDay);
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
        $thisAmount = $this->fixedPrice;

        if ($days <= 0) {
            throw new Exception('Days & Amount per day must be added');
        }

        if ($days > $this->minDay) {
            $thisAmount += ($days - $this->minDay) * $this->pricePerDay;
        }

        return $thisAmount;
    }
}
