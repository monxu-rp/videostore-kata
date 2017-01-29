<?php

namespace video\Rental\RentalFrequentPointsCalculator;

/**
 * Interface RentalFrequentPointsCalculator
 */
interface RentalFrequentPointsCalculator
{
    /**
     * @param int $days
     *
     * @return int
     */
    public function determineFrequentRenterPoints(int $days): int;
}
