<?php

namespace video\Rental\RentalFrequentPointsCalculator;

/**
 * Class DetermineFrequentPointsByFixedPoints
 */
class DetermineFrequentPointsByFixedPoints implements RentalFrequentPointsCalculatorInterface
{
    /** @var  int */
    private $fixedPoints;

    /**
     * @param int $fixedPoints
     */
    public function __construct(int $fixedPoints)
    {
        $this->fixedPoints = $fixedPoints;
    }

    public function determineFrequentRenterPoints(int $days): int
    {
        return $this->fixedPoints;
    }
}
