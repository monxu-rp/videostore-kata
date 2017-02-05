<?php

namespace VideoStoreKata\video\Rental\RentalFrequentPointsCalculator;

/**
 * Interface RentalFrequentPointsCalculatorInterface.
 */
interface RentalFrequentPointsCalculatorInterface
{
    /**
     * @param int $days
     *
     * @return int
     */
    public function determineFrequentRenterPoints(int $days): int;
}
